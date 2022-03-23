<?php

namespace App\Form;

use App\Entity\Builder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuilderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('zestawienia', CollectionType::class, array(
                'entry_type' => ZestawienieType::class,
                'entry_options' => ['label' => false],
            ))
            ->add('podsumowanie', CollectionType::class, array(
                'entry_type' => PodsumowanieType::class,
                'entry_options' => ['label' => false],
            ))
            ->add('save', SubmitType::class, array(
                'label' => "Zapisz zestawienie",
                'attr' => [
                    'icon' => " fas fa fa-home",
                    'disabled' => true,
                    "title" => "Aby móc zapisać, proszę najpierw przeliczyć zestawienie!",
                    'class' => 'btn btn-primary float-right builder_save'
                    ],
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Builder::class,
        ]);
    }
}
