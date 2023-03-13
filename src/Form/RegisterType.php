<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // création input
            ->add('pseudo',TextType::class, [
                'constraints' => [
                    new Length(['min' => 4]),
                    new Regex([
                        'pattern' => '/^[a-z0-9]+$/',
                        'match'   => True,
                        'message' => 'Les carractères spéciaux ne sont pas autorisés.'
                    ])]
            ])
            ->add('email',EmailType::class) 
            ->add('password', PasswordType::class,[
                'constraints' => [new Length(['min' => 4, 'max' => 25])],
            ])
            // ->add('inscription', SubmitType::class)
            ->setMethod('POST')
            ->getForm()
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
