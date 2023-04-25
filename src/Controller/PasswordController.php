<?php

namespace App\Controller;

use App\Entity\JsnMember;
use App\Entity\JsnMemberMeta;
use App\Form\JsnPasswordType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Routing\Annotation\Route;

class PasswordController extends AbstractController
{
    #[Route('/reset', name: 'app_password')]
    public function index(Request $request): Response
    {
        $member = new JsnMember();

        $form = $this->createForm(JsnPasswordType::class, $member);

        if ($request->isMethod('POST')) {
            $session = $request->getSession();
            $session->set('password_reset', null);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $session->set('password_reset', $form->getData());
                return $this->redirectToRoute('app_password_complete');
            }
        }

        return $this->render('password/index.html.twig', [
            'controller_name' => 'PasswordController',
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/reset/complete', name: 'app_password_complete')]
    public function complete(Request $request, ManagerRegistry $doctrine, MailerInterface $mailer): Response
    {
        // 入力チェック通過の確認
        $session = $request->getSession();
        $values = $session->get('password_reset');
        if (null == $values) {
          return $this->redirectToRoute('app_password');
        }
        $entityManager = $doctrine->getManager();
        $member = $entityManager->getRepository(JsnMember::class)->findOneBy(['email' => $values->getEmail()]);

        $member->setPassword($values->getPassword(), false);
        $member->setPasswordSalt($values->getPasswordSalt());
        $entityManager->flush();

        $memberMeta = $entityManager->getRepository(JsnMemberMeta::class)->find($member->getId());

        $email = (new TemplatedEmail())
            ->from(new Address('dtox@env.go.jp', '除染技術探索サイト　運営事務局'))
            ->to($values->getEmail())
            ->subject('【除染技術探索サイト】パスワード変更のお知らせ')
            ->textTemplate('emails/mail_body_reset.html.twig')
            ->context([
                'name' => $memberMeta->getName()
            ]);
        $mailer->send($email);

        return $this->render('password/complete.html.twig', [
            'controller_name' => 'PasswordController',
        ]);
    }
}
