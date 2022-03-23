<?php

namespace App\Form;

use App\Entity\Dzielnica;
use App\Entity\Uzytkownik;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UzytkownikType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $state = $options['state'];

        $builder
            ->add('imie', TextType::class, [
                'label' => "Imię",
                'required' => false
            ])
            ->add('nazwisko', TextType::class, [
                'label' => "Nazwisko",
                'required' => false
            ])
            ->add('email', EmailType::class, [
                'label' => "Adres e-mail",
                'required' => false
            ])
            ->add('czyDomenowy', ChoiceType::class, [
                'label' => "Czy użytkownik jest domenowy?",
                'required' => true,
                'choices' => [
                    'Tak' => true,
                    'Nie' => false,
                ], 
            ])
            ->add('status', ChoiceType::class, [
                'label' => "Czy aktywny?",
                'choices' => [
                    'Tak' => true,
                    'Nie' => false,
                ], 
            ])
            ->add('login', TextType::class, [
                'label' => 'Login',
                'required' => true
            ])
            ->add('roles', ChoiceType::class, [
                'label' => "Wybierz rolę",
                'required' => true,
                'multiple' => false, 
                'expanded' => false, 
                'choices' => [
                    'Pracownik' => 'ROLE_WORKER',
                    'Przełożony' => 'ROLE_SUPERVISOR',
                    'BPB' => 'ROLE_MANAGER'
                ]
            ])
            
            // ->add('password', PasswordType::class, [
            //     'label' => "Hasło *",
            //     'required' => false,
                //'mapped' => false,
                // 'constraints' => [
                //     new NotBlank([
                //         'message' => 'Proszę wprowadzić hasło'
                //     ]),
                //     new Length([
                //         'min' => 6,
                //         'minMessage' => 'Twoje hasło powinno mieć przynajmniej {{ limit }} znaków',
                //         'max' => 4096
                //     ])
                // ]
            // ])

            ->add('dzielnica', EntityType::class, [
                'class' => Dzielnica::class,
                'choice_label' => 'nazwa',
            ])
            ->add('save', SubmitType::class, [
                'label' =>  ($state == "create") ? "Utwórz użytkownika" : "Zapisz edycję",
                'attr' => [
                    'class' => "btn btn-primary float-right"
                ]
            ]);

        // Data Transformer
        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function($rolesArray) {
                    return count($rolesArray) ? $rolesArray[0] : null;
                },
                function($rolesString) {
                    return [$rolesString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Uzytkownik::class,
        ]);
        $resolver->setRequired('state');
    }
}
