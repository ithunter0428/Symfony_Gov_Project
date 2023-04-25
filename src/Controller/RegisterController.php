<?php

namespace App\Controller;

use App\Entity\JsnMember;
use App\Entity\JsnMemberMeta;
use App\Entity\JsnProvisionalMember;
use App\Form\JsnProvisionalMemberType;
use App\Service\AffiliationCategory;
use App\Service\BusinessCategory;
use App\Service\SecretQuestion;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    public function __construct(AffiliationCategory $affiliationCategory, BusinessCategory $businessCategory, SecretQuestion $secretQuestion)
    {
        $this->affiliationCategory = $affiliationCategory;
        $this->businessCategory = $businessCategory;
        $this->secretQuestion = $secretQuestion;
    }

    #[Route('/register', name: 'app_register')]
    public function index(Request $request): Response
    {
        $uniqueId = uniqid();
        $session = $request->getSession();
        $session->set('register_check_plolicy_unique_id', $uniqueId);

        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'uniqueId' => $uniqueId,
        ]);
    }

    #[Route('/register/form', name: 'app_register_form')]
    public function form(Request $request): Response
    {
        $session = $request->getSession();
        $values = $session->get('register_check_plolicy_unique_id');
        if (null == $values) {
          return $this->redirectToRoute('app_register');
        }

        $provisionalMember = new JsnProvisionalMember();

        $form = $this->createForm(JsnProvisionalMemberType::class, $provisionalMember);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $session = $request->getSession();
            $session->set('provisional_member', null);
            if ($form->isSubmitted() && $form->isValid()) {
                $session->set('provisional_member', $form->getData(),);
                return $this->redirectToRoute('app_register_confirm');
            }
        }

        // 確認画面から戻りのケース
        if ('confirm' === $session->get('back')) {
          $values = $session->get('provisional_member');
        }

        return $this->render('register/form.html.twig', [
            'controller_name' => 'RegisterController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/register/confirm', name: 'app_register_confirm')]
    public function confirm(Request $request): Response
    {
        // 入力チェック通過の確認
        $session = $request->getSession();
        $values = $session->get('provisional_member');
        if (null == $values) {
          return $this->redirectToRoute('app_register_form');
        }

        $questionnaireAnswer = unserialize($values->getQuestionnaireAnswer());
        $password = str_repeat('*', mb_strlen($values->getpassword()));
        $secretAnswer = str_repeat('*', mb_strlen($values->getSecretAnswer()));

        $affiliationCategoryOption = $this->affiliationCategory->getOption();
        $affiliationCategoryOption = array_flip($affiliationCategoryOption);
        $businessCategoryOption = $this->businessCategory->getOption();
        $businessCategoryOption = array_flip($businessCategoryOption);
        $secretQuestionOption = $this->secretQuestion->getOption();
        $secretQuestionOption = array_flip($secretQuestionOption);

        $provisionalMember = new JsnProvisionalMember();

        $form = $this->createForm(JsnProvisionalMemberType::class, $provisionalMember);

        return $this->render('register/confirm.html.twig', [
            'controller_name' => 'RegisterController',
            'values' => $values,
            'form' => $form->createView(),
            'password' => $password,
            'secretAnswer' => $secretAnswer,
            'affiliationCategoryOption' => $affiliationCategoryOption,
            'businessCategoryOption' => $businessCategoryOption,
            'secretQuestionOption' => $secretQuestionOption,
            'questionnaireAnswer' => $questionnaireAnswer
        ]);
    }

    #[Route('/register/mail', name: 'app_register_mail')]
    public function mail(Request $request, ManagerRegistry $doctrine, MailerInterface $mailer): Response
    {
        // 入力チェック通過の確認
        $session = $request->getSession();
        $values = $session->get('provisional_member');
        if (null == $values) {
          return $this->redirectToRoute('app_register_form');
        }
        
        $entityManager = $doctrine->getManager();
        $entityManager->beginTransaction();
        $validHour = 2;

        try {
            $createdProvisionalMember = $entityManager->getRepository(JsnProvisionalMember::class)->findOneBy(['email' => $values->getEmail()]);
            if (null !== $createdProvisionalMember) {
                $entityManager->remove($createdProvisionalMember);
            }
            $provisionalMember = new JsnProvisionalMember();
            $provisionalMember->setName($values->getName());
            $provisionalMember->setAffiliationCategory($values->getAffiliationCategory());
            $provisionalMember->setBusinessCategory($values->getBusinessCategory());
            $provisionalMember->setAffiliation($values->getAffiliation());
            $provisionalMember->setEmail($values->getEmail());
            $provisionalMember->setPassword($values->getPassword());
            $provisionalMember->setPasswordSalt($values->getPasswordSalt());
            $provisionalMember->setSecretQuestion($values->getSecretQuestion());
            $provisionalMember->setSecretAnswer($values->getSecretAnswer());
            $provisionalMember->setSecretAnswerSalt($values->getSecretAnswerSalt());
            $provisionalMember->setQuestionnaireAnswer(serialize($values->getQuestionnaireAnswer()));
            $provisionalMember->setIsReceiveMail($values->getIsReceiveMail());
            $entityManager->persist($provisionalMember);
            dump($provisionalMember->getEmail());
            $email = (new TemplatedEmail())
                ->from(new Address('dtox@env.go.jp', '除染技術探索サイト　運営事務局'))
                ->to($provisionalMember->getEmail())
                ->subject('【除染技術探索サイト】会員登録のお手続き')
                ->textTemplate('emails/mail_body_preregister.html.twig')
                ->context([
                    'id' => $provisionalMember->getId(),
                    'name' => $provisionalMember->getName(),
                    'validHour' => 2
                ]);
            $mailer->send($email);

            $entityManager->flush();
            $entityManager->commit();

        } catch (Exception $e) {
            $entityManager->rollback();
            throw $e;
        }

        return $this->render('register/mail.html.twig', [
            'controller_name' => 'RegisterController',
            'validHour' => $validHour,
        ]);
    }

    #[Route('/register/finish', name: 'app_register_finish')]
    public function finish(Request $request, ManagerRegistry $doctrine): Response
    {
        $id = $request->query->get('id');
        if (null == $id) {
          return new Response('Error', Response::HTTP_BAD_REQUEST);
        }

        $entityManager = $doctrine->getManager();
        $entityManager->beginTransaction();
        $now = new \DateTime('now');
        $provisionalMember = $entityManager->getRepository(JsnProvisionalMember::class)->findOneBy(['id' => $id]);

        if (null == $provisionalMember) {
            return new Response('Error', Response::HTTP_BAD_REQUEST);
        }

        try {
            $member = new JsnMember();
            $member->setEmail($provisionalMember->getEmail());
            $member->setPassword($provisionalMember->getPassword(), false);
            $member->setPasswordSalt($provisionalMember->getPasswordSalt());
            $member->setSecretQuestion($provisionalMember->getSecretQuestion());
            $member->setSecretAnswer($provisionalMember->getSecretAnswer(), false);
            $member->setSecretAnswerSalt($provisionalMember->getSecretAnswerSalt());

            $memberMeta = new JsnMemberMeta();
            $memberMeta->setName($provisionalMember->getName());
            $memberMeta->setAffiliationCategory($provisionalMember->getAffiliationCategory());
            $memberMeta->setBusinessCategory($provisionalMember->getBusinessCategory());
            $memberMeta->setAffiliation($provisionalMember->getAffiliation());
            $memberMeta->setQuestionnaireAnswer($provisionalMember->getQuestionnaireAnswer());
            $memberMeta->setIsReceiveMail($provisionalMember->getIsReceiveMail());

            // $memberMeta->setMember($memberMeta);
            $member->setMeta($memberMeta);
            dump($member);
            $entityManager->persist($member);
            $entityManager->flush();
            $entityManager->remove($provisionalMember);
            $entityManager->commit();
        } catch (Exception $e) {
            $entityManager->rollback();
            throw $e;
        }

        return $this->render('register/finish.html.twig', [
            'controller_name' => 'RegisterController',
        ]);
    }
}
