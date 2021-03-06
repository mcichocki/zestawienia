<?php

namespace App\Form;

use App\Entity\Podsumowanie;
use App\Repository\PodgrupaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PodsumowanieType extends AbstractType
{

    private PodgrupaRepository $podgrupaRepository;

    public function __construct(PodgrupaRepository $podgrupaRepository)
    {
        $this->podgrupaRepository = $podgrupaRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $podgrupy = $this->podgrupaRepository->findByPodgrupaActivated();

        $builder
            ->add('sumaRokPoprzedni', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'valuemask suma_rok_poprzedni',
                    'placeholder' => '0,00',
                    'readonly' => true
                ],
                'row_attr' => [
                    'class' => 'reset-form-group'
                ]
            ])

            ->add('sumaRokBiezacy', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'valuemask suma_rok_aktualny',
                    'placeholder' => '0,00',
                    'readonly' => true
                ],
                'row_attr' => [
                    'class' => 'reset-form-group',
                ]
            ])

            // Suma Grunty rok poprzedni
            ->add('sumaGruntyRokPoprzedni', HiddenType::class, [
                'label' => false,
                'attr' => [
                    'class' => "suma_grunty_rok_poprzedni"
                ]
            ])

            // Suma Grunty
            ->add('sumaGrunty', HiddenType::class, [
                'label' => false,
                'attr' => [
                    'class' => "suma_grunty"
                ]
            ])

            // Budynki, lokale i obiekty in??ynierii l??dowej i wodnej
            ->add('sumaBudynki', HiddenType::class, [
                'label' => false,
                'attr' => [
                    'class' => $podgrupy[0]->getRobocza()
                ]
            ])

            // Grunty przekazane w u??ytkowanie wieczyste
            ->add('sumaGruntyPrzekazaneUzytkowanieWieczyste', HiddenType::class, [
                'label' => false,
                'attr' => [
                    'class' => $podgrupy[1]->getRobocza()
                ]
            ])

            // Grunty inne ni?? przekazane w u??ytkowanie wieczyste
            ->add('sumaGruntyInneNizPrzekazaneUzytkowanieWieczyste', HiddenType::class, [
                'label' => false,
                'attr' => [
                    'class' => $podgrupy[2]->getRobocza()
                ]
            ])

            // Nieruchomo??ci inwestycyjne
            ->add('sumaNieruchomosciInwestycyjne', HiddenType::class, [
                'label' => false,
                'attr' => [
                    'class' => $podgrupy[3]->getRobocza()
                ]
            ])

            // Nale??no??ci d??ugoterminowe
            ->add('sumaNaleznosciDlugoterminowe', HiddenType::class, [
                'label' => false,
                'attr' => [
                    'class' => $podgrupy[4]->getRobocza()
                ]
            ])

            // D??ugoterminowe aktywa finansowe
            ->add('sumaDlugoterminoweAktywaFinansowe', HiddenType::class, [
                'label' => false,
                'attr' => [
                    'class' => $podgrupy[5]->getRobocza()
                ]
            ])

            // Pozosta??e ??rodki trwa??e
            ->add('sumaPozostaleSrodkiTrwale', HiddenType::class, [
                'label' => false,
                'attr' => [
                    'class' => $podgrupy[6]->getRobocza()
                ]
            ])

            // ??rodki trwa??e w budowie i zaliczki na ich poczet
            ->add('sumaSrodkiTrwale', HiddenType::class, [
                'label' => false,
                'attr' => [
                    'class' => $podgrupy[7]->getRobocza()
                ]
            ])

            // Warto??ci niematerialne i prawne
            ->add('sumaWartosciNiematerialne', HiddenType::class, [
                'label' => false,
                'attr' => [
                    'class' => $podgrupy[8]->getRobocza()
                ]
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Podsumowanie::class,
        ]);
    }
}
