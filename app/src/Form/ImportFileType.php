<?php

namespace App\Form;

use App\Entity\ImportFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImportFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plik', FileType::class,[
                // 'label' => 'Zaimportuj plik (CSV)',
                'mapped' => false,
                'required' => false
            ])
            ->add('save', SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-success float-right import-file'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ImportFile::class,
        ]);
    }
}
