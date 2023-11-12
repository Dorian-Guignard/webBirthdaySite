<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\GuestQuestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\DependencyInjection\Loader\Configurator\security;

class GuestQuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('pax', null, [
            'label' => 'Nombre de personnes',
            'attr' => [
                'placeholder' => 'Nombre de personnes'
            ]
        ])
            ->add('night', null, [
                'label' => 'Nombre de nuits',
                'attr' => [
                    'placeholder' => 'Nombre de places'
                ]
            ])
            ->add('allergie', null, [
                'label' => 'Allergie alimentaire',
                'attr' => [
                    'placeholder' => 'Allergies alimentaires'
                ]
            ])
            ->add('regime', null, [
                'label' => 'Régime alimentaire spécial',
                'attr' => [
                    'placeholder' => 'Régime alimentaire spécial'
                ]
            ])
            ->add('playlist', null, [
                'label' => 'Playlist musicale préférée',
                'attr' => [
                    'placeholder' => 'Playlist musicale préférée'
                ]
            ]);
    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GuestQuestion::class,
        ]);
    }
}
