<?php

namespace App\Form;

use App\Entity\FormaOrganizacyjna;
use App\Entity\Formularz;
use App\Entity\Jednostka;
use App\Entity\RokZestawieniowy;
use App\Repository\RokZestawieniowyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class FormularzType extends AbstractType
{
    private $em;
    private Security $security;
    private RokZestawieniowyRepository $rokZestawieniowy;

    public function __construct(EntityManagerInterface $em, Security $security, RokZestawieniowyRepository $rokZestawieniowy)
    {
        $this->em = $em;
        $this->security = $security;
        $this->rokZestawieniowy = $rokZestawieniowy;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        if(!is_null($this->rokZestawieniowy->getRokZestawieniowy()))
        {

            $dzielnica = $this->security->getUser()->getDzielnica();
            $jednostki = $this->em->getRepository(Formularz::class)->findBy(array(
                'rokZestawieniowy' => $this->rokZestawieniowy->getRokZestawieniowy()
            ));

            if ($dzielnica != null) {

                $query = $this->em->createQuery(
                    'SELECT j
                    FROM App\Entity\Jednostka j
                    WHERE j.dzielnica = :id
                    ORDER BY j.nazwa ASC'
                )->setParameter('id', $dzielnica);

                $q = $query->getResult();

                $dzielniceChoices = array();

                foreach ($jednostki as &$jednostka) {
                    foreach ($q as $key => &$qJednostka) {
                        if ($qJednostka->getId() == $jednostka->getJednostka()->getId()) {
                            unset($q[$key]);
                            break;
                        }
                    }
                }

                foreach ($q as $dzielnica) {
                    $dzielniceChoices[$dzielnica->getNazwa()] = $dzielnica;
                }
            }

            $builder
                ->add('jednostka', EntityType::class, [
                    'class' => Jednostka::class,
                    'label' => "Jednostka do zestawienia:",
                    'disabled' => (!empty($dzielniceChoices)) ? false : true,
                    'choice_label' => 'nazwa',
                    'choices' => (!empty($dzielniceChoices)) ? $dzielniceChoices : null
                ])
                ->add('formaOrganizacyjnaRokPoprzedni', EntityType::class, [
                    'label' => "Forma organizacyjna w roku poprzednim:",
                    'class' => FormaOrganizacyjna::class,
                    'disabled' => (!empty($dzielniceChoices)) ? false : true,
                    'choice_label' => 'nazwa',
                ])
                ->add('formaOrganizacyjnaRokAktualny', EntityType::class, [
                    'label' => "Forma organizacyjna w roku aktualnym:",
                    'class' => FormaOrganizacyjna::class,
                    'disabled' => (!empty($dzielniceChoices)) ? false : true,
                    'choice_label' => 'nazwa',
                ])
                ->add('notatka', TextType::class, [
                    'required' => false,
                    'label' => "Dodaj krótką notatkę (opcjonalne):",
                ])
                ->add('save', SubmitType::class, [
                    'label' => "Generuj zestawienie",
                    'disabled' => (!empty($dzielniceChoices)) ? false : true,
                    'attr' => [
                        'class' => 'btn btn-primary float-right'
                    ],
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formularz::class,
        ]);
    }
}
