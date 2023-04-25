<?php

namespace App\Form;

use App\Entity\JsnTechnology;
use App\Form\JsnTechnologyType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JsnTechnologyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isEnglish')
            ->add('receiptId')
            ->add('name')
            ->add('applicantUserEmail')
            ->add('applicantOrganName')
            ->add('applicantOrganNameKana')
            ->add('applicantOrganWebUrl')
            ->add('summary')
            ->add('existRestriction')
            ->add('phase')
            ->add('referenceWebUrl')
            ->add('referenceWebName')
            ->add('existVerificationTest')
            ->add('existAchievement')
            ->add('existExpertEvaluation')
            ->add('wishExpertEvaluation')
            ->add('contactAffiliation')
            ->add('contactPost')
            ->add('contactTel')
            ->add('contactZipCode')
            ->add('contactAddress')
            ->add('keyword')
            ->add('password')
            ->add('passwordSalt')
            ->add('status')
            ->add('publishedAt')
            ->add('contentUpdatedAt')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('englishVersion')
            ->add('meansSubClass')
            ->add('objectSubClass')
            ->add('sceneSubClass')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JsnTechnology::class,
        ]);
    }
}
