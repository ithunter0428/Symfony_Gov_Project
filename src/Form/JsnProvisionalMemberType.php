<?php

namespace App\Form;

use App\Entity\JsnProvisionalMember;
use App\Service\AffiliationCategory;
use App\Service\BusinessCategory;
use App\Service\SecretQuestion;
use Doctrine\Persistence\ManagerRegistry;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class JsnProvisionalMemberType extends AbstractType
{
    public function __construct(AffiliationCategory $affiliationCategory, BusinessCategory $businessCategory, SecretQuestion $secretQuestion, ManagerRegistry $doctrine)
    {
        $this->affiliationCategory = $affiliationCategory;
        $this->businessCategory = $businessCategory;
        $this->secretQuestion = $secretQuestion;
        $this->doctrine = $doctrine;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $affiliationCategoryOption = $this->affiliationCategory->getOption();
        $businessCategoryOption = $this->businessCategory->getOption();
        $secretQuestionOption = $this->secretQuestion->getOption();
        $questionnaireAnswer = array('はい' => '1', 'いいえ' => '0');

        $builder
            ->add('name', TextType::class, [
                'label' => '氏名',
                'trim' => true,
                'constraints' => [
                    new NotNull
                ]
            ])
            ->add('affiliation_category', ChoiceType::class, [
                'label' => '所属種別',
                'choices' => ["所属種別を選択してください。" => null] + $affiliationCategoryOption,
                'constraints' => [
                    new NotBlank,
                ]
            ])
            ->add('business_category', ChoiceType::class, [
                'label' => '業種',
                'choices' => ["業種を選択してください。" => null] + $businessCategoryOption,
                'constraints' => [
                ]
            ])
            ->add('affiliation', TextType::class, [
                'label' => '所属機関の名称',
                'trim' => true,
                'constraints' => [
                    new NotNull,
                    new Length([
                        'max' => 128,
                    ]),
                ]
            ])
            ->add('email', TextType::class, [
                'label' => 'メールアドレス',
                'trim' => true,
                'constraints' => [
                    new NotNull,
                    new Length([
                        'max' => 128,
                    ]),
                ]
            ])
            ->add('reEmail', TextType::class, [
                'trim' => true,
                'mapped' => false,
                'constraints' => [
                    new NotNull,
                    new Callback([$this, 'validatorEmail']),
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'パスワード',
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
                'choices' => ["選択してください。" => null] + $secretQuestionOption,
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
            ->add('q01', ChoiceType::class, [
                'choices' => $questionnaireAnswer,
                'mapped' => false,
                'expanded' => true,
                'constraints' => [
                    new NotBlank,
                ]
            ])
            ->add('q02', ChoiceType::class, [
                'choices' => $questionnaireAnswer,
                'mapped' => false,
                'expanded' => true,
                'constraints' => [
                    new NotBlank,
                ]
            ])
             ->add('isReceiveMail', ChoiceType::class, [
                'choices' => $questionnaireAnswer,
                'expanded' => true,
                'trim' => true,
                'constraints' => [
                    new NotBlank,
                ]
            ])
            ->add('captcha', CaptchaType::class, [
                'label' => 'セキュリティコードの入力',
                'mapped' => false,
            ])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $affiliationCategory = $event->getData()->getAffiliationCategory();
                $businessCategory = $event->getData()->getBusinessCategory();
                $form = $event->getForm();
                if ('1' == $affiliationCategory && is_null($businessCategory)) {
                    $form->get('business_category')->addError(new FormError('必須項目です。'));
                }
                if (isset($affiliationCategory) && '1' !== $affiliationCategory) {
                    $data = $event->getData();
                    $data->setBusinessCategory(0);
                    $event->setData($data);
                }

                $q01 = $event->getForm()->get('q01');
                $q02 = $event->getForm()->get('q02');
                $questionnaireAnswer = array(
                  'q01' => $q01->getData(),
                  'q02' => $q02->getData(),
                );
                $questionnaireAnswer = serialize($questionnaireAnswer);
                $data = $event->getData();
                $data->setQuestionnaireAnswer($questionnaireAnswer);
                $event->setData($data);
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JsnProvisionalMember::class,
        ]);
    }

      /**
       * メールアドレスのポストバリデータ
       *
       * @param sfValidatorBase $validator
       * @param array $values
       * @return array
       * @throws sfValidatorErrorSchema
       */
      public function validatorEmail($value, ExecutionContextInterface $context)
      {
        $form = $context->getRoot();
        $email = isset($form['email']) ? $form['email']->getData() : null;
        $reEmail = isset($value) ? $value : null;

        if ($email === $reEmail) {
            return;
        } else {
            $context
                ->buildViolation('メールアドレスが一致していません。')
                ->addViolation();
            return;
        }
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
}
