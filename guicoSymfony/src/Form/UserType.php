<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'attr' => [
                    'style' => "display: flex; margin-left: auto; margin-right: auto;"
                ]
            ])
            ->add('prenom', null, [
                'attr' => [
                    'style' => "display: flex; margin-left: auto; margin-right: auto;"
                ]
            ])
            ->add('mail', null, [
                'attr' => [
                    'style' => "display: flex; margin-left: auto; margin-right: auto;"
                ]
            ])
            ->add('age', null, [
                'attr' => [
                    'style' => "display: flex; margin-left: auto; margin-right: auto;"
                ]
            ])
            ->add('motDePasse', null, [
                'attr' => [
                    'style' => "display: flex; margin-left: auto; margin-right: auto;"
                ]
            ])
            ->add('role', null, [
                'attr' => [
                    'style' => "display: flex; margin-left: auto; margin-right: auto;"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
