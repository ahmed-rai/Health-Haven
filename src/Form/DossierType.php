<?php

namespace App\Form;

use App\Entity\Dossier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DossierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextareaType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder' => 'Entrez le nom du patient',
                ],
                'required' => true,
            ])
            ->add('medicaments', TextareaType::class, [
                'label' => 'Médicaments',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder' => 'Entrez les médicaments prescrits',
                ],
                'required' => false,
            ])
            ->add('consultations', TextareaType::class, [
                'label' => 'Consultations',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder' => 'Entrez les informations sur les consultations',
                ],
                'required' => false,
            ])
            ->add('phobies', TextareaType::class, [
                'label' => 'Phobies',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder' => 'Entrez les phobies éventuelles',
                ],
                'required' => false,
            ])
            ->add('resultats', TextareaType::class, [
                'label' => 'Résultats',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder' => 'Entrez les résultats des analyses et des examens',
                ],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dossier::class,
        ]);
    }
}
