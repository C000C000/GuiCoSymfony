<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'attr' => [
                    'style' => "display: flex; margin-left: auto; margin-right: auto; width: 30%;"
                ]
            ])
            ->add('prenom', null, [
                'attr' => [
                    'style' => "display: flex; margin-left: auto; margin-right: auto; width: 30%;"
                ]
            ])
            ->add('mail', null, [
                'attr' => [
                    'style' => "display: flex; margin-left: auto; margin-right: auto; width: 30%;"
                ]
            ])
            ->add('age', null, [
                'attr' => [
                    'style' => "display: flex; margin-left: auto; margin-right: auto; width: 30%;"
                ]
            ])
            ->add('motDePasse', null, [
                'attr' => [
                    'style' => "display: flex; margin-left: auto; margin-right: auto; width: 30%;"
                ]
            ])
            //->add('role')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
