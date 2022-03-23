<?php

namespace App\Form;

use App\Entity\Zestawienie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ZestawienieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('wartoscRokZestawieniowy', TextType::class, [
                'label' => false,
                'required'   => false,
                'attr' => [
                    'class' => 'valuemask',
                    'placeholder' => '0,00'
                ],
                'row_attr' => [
                    'class' => 'reset-form-group'
                ]
            ])
            ->add('wartoscRokPoprzedni', TextType::class,[
                'label' => false,
                'required'   => false,
                'attr' => [
                    'class' => 'valuemask',
                    'placeholder' => '0,00'
                ],
                'row_attr' => [
                    'class' => 'reset-form-group'
                ]
            ])
            ->add('wartoscRoznicaKwot', TextType::class, [
                'required'   => false,
                'label' => false,
                'attr' => [
                    'class' => 'valuemask',
                    'placeholder' => '0,00',
                    'readonly' => true
                ],
                'row_attr' => [
                    'class' => 'reset-form-group'
                ]
            ])
            ->add('wartoscProcentowa', TextType::class, [
                'required'   => false,
                'label' => false,
                'attr' => [
                    'class' => 'valuemask',
                    'placeholder' => '0,00',
                    'readonly' => true
                ],
                'row_attr' => [
                    'class' => 'reset-form-group'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Zestawienie::class,
        ]);
    }
}
