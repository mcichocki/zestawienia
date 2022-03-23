<?php

namespace App\Form;

use App\Entity\Dzielnica;
use App\Entity\FormaOrganizacyjna;
use App\Entity\Jednostka;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JednostkaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwa', TextType::class, [
                'label' => "Nazwa jednostki"
            ])
            ->add('ulica', TextType::class)
            ->add('numer', TextType::class)
            ->add('kodPocztowy', TextType::class)
            ->add('miasto', TextType::class)
            ->add('nazwaPelna', TextType::class, [
                'label' => "Nazwa pełna"
            ])
            ->add('symbol')
            ->add('dzielnica', EntityType::class, [
                'class' => Dzielnica::class,
                'choice_label' => 'nazwa',
            ])
            ->add('formaOrganizacyjna', EntityType::class, [
                'class' => FormaOrganizacyjna::class,
                'choice_label' => 'nazwa',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Jednostka::class,
        ]);
    }
}
