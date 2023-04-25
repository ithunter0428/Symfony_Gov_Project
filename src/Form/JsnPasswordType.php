<?php

namespace App\Form;

use App\Entity\JsnMember;
use App\Service\SecretQuestion;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class JsnPasswordType extends AbstractType
{

    public function __construct(SecretQuestion $secretQuestion, ManagerRegistry $doctrine)
    {
        $this->secretQuestion = $secretQuestion;
        $this->doctrine = $doctrine;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $option = $this->secretQuestion->getOption();

        $builder
            ->add('email', TextType::class, [
                'label' => 'メールアドレス',
                'trim' => true,
                'constraints' => [
                    new NotNull,
                    new Callback([$this, 'validatorMember'])
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => '新パスワード',
                'trim' => true,
                'constraints' => [
                    new NotNull,
                    new Length([
                        'min' => 8,
                        'max' => 32,
                    ]),
                ]
            ])
            ->add('rePassword', PasswordType::class, [
                'trim' => true,
                'mapped' => false,
                'constraints' => [
                    new NotNull,
                    new Callback([$this, 'validatorPassword']),
                ]
            ])
            ->add('secretQuestion', ChoiceType::class, [
                'label' => '秘密の質問',
                'choices' => ["選択してください。" => ""] + $option,
                'constraints' => [
                    new NotBlank,
                ]
            ])
            ->add('secretAnswer', TextType::class, [
                'label' => '秘密の答え',
                'trim' => true,
                'constraints' => [
                    new NotNull,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JsnMember::class,
            // 'constraints' => [
            //     new Callback([
            //         'callback' => function ($object, ExecutionContextInterface $context) {
            //             $form = $context->getRoot();
            //             $data = $form->getData();
            //             $roles = $form->get("rePassword")->getData();
            //             dump($roles);
            //         },
            //     ]),
            // ],
        ]);
    }


    public function validatorPassword($value, ExecutionContextInterface $context)
    {
        $form = $context->getRoot();
        $password = isset($form['password']) ? $form['password']->getData() : null;
        $rePassword = isset($value) ? $value : null;

        if ($password === $rePassword) {
            return;
        } else {
            $context
                ->buildViolation('パスワードが一致していません。')
                ->addViolation();
            return;
        }
    }

    public function validatorMember($value, ExecutionContextInterface $context)
    {
        $memberFunc = new JsnMember();
        $form = $context->getRoot();

        $email = isset($value) ? $value : null;
        $secretQestion = isset($form['secretQuestion']) ? $form['secretQuestion']->getData() : null;
        $secretAnswer = isset($form['secretAnswer']) ? $form['secretAnswer']->getData() : null;

        if (is_null($email) || is_null($secretQestion) || is_null($secretAnswer)) {
          return;
        }

        $member = $this->doctrine->getRepository(JsnMember::class)->findOneBy(['email' => $email]);

        if (false == $member) {
            $context
                ->buildViolation('メールアドレス、もしくは秘密の質問、答えが間違っています。')
                ->addViolation();
            return;
        }

        if ($secretQestion === $member->getSecretQuestion() && $member->getSecretAnswer() === $memberFunc->hash($secretAnswer, $member->getSecretAnswerSalt())) {
            return;
        }

        $context
            ->buildViolation('メールアドレス、もしくは秘密の質問、答えが間違っています。')
            ->addViolation();
        return;
    }
}
