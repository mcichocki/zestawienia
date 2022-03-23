<?php

namespace App\Form;

use App\Entity\Wiadomosc;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WiadomoscType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tytul')
            ->add('tresc', TextareaType::class, [
                'label' => false
            ])
            ->add('czyOdczytano')
            ->add('dataWyslania')
            ->add('odKogo')
            ->add('doKogo', ChoiceType::class,  [
                'choices' => [
                    'Pracownicy Biura/Dzielnicy:' => [
                        'Jacek Smolak' => 'stock_yes',
                        'Tadeusz Juszkiewicz' => 'stock_no',
                    ],
                    'Pracownicy BPB:' => [
                        'Michał Kulak' => 'stock_backordered',
                        'Anna Zawacka' => 'stock_discontinued',
                    ],
                ]])
            ->add('formularz')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Wiadomosc::class,
        ]);
    }
}
