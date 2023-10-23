<?php
// src/Form/LoginType.php

namespace App\Form;


use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginType extends AbstractType
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }



    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $entityManager = $this->entityManager;

        $builder
            ->add('username', ChoiceType::class, [
                'choices' => $entityManager->getRepository(User::class)->findAll(),
                'choice_label' => 'username', // Remplacez 'email' par la propriété correspondante dans votre entité User
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                ],
            ])
            ->add(
                'password',
                PasswordType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                    ],
                ]
            )
            ->add('_token', HiddenType::class) // Ajoutez le champ du jeton CSRF

            ->add('submit', SubmitType::class, [
                'label' => 'Login',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class, // Spécifiez la classe User ici
        ]);
    }
}
