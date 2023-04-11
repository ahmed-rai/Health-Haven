<?php

namespace App\Form;

use App\Entity\Dossier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

use Symfony\Component\Validator\Constraints\GreaterThan;

class Dossier1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Entrez le nom du patient',
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Le nom ne peut pas être vide.']),
                ],
            ])
            ->add('medicaments', TextareaType::class, [
                'label' => 'Médicaments prescrits',
                'attr' => [
                    'placeholder' => 'Listez les médicaments prescrits',
                    'class' => 'form-control'
                ],
                'required' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Les médicaments ne peuvent pas être vides.']),
                ],
            ])
            ->add('datecreation', DateType::class, [
                'label' => 'Date de création',
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'Sélectionnez la date de création',
                    'class' => 'form-control'
                ],
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'constraints' => [
                    new NotBlank(['message' => 'La date de création ne peut pas être vide.']),
                    new Date(['message' => 'La date de création doit être une date valide.']),
                    new GreaterThanOrEqual(['value' => 'today', 'message' => 'La date de création ne peut pas être dans le passé.']),
                ],
            ])
            
            ->add('phobies', TextareaType::class, [
                'label' => 'Phobies',
                'attr' => [
                    'placeholder' => 'Listez les phobies du patient',
                    'class' => 'form-control'
                ],
                'required' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Les phobies ne peuvent pas être vides.']),
                ],
            ])
            ->add('resultats', TextareaType::class, [
                'label' => 'Résultats des tests',
                'attr' => [
                    'placeholder' => 'Entrez les résultats des tests',
                    'class' => 'form-control'
                ],
                'required' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Les résultats ne peuvent pas être vides.']),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dossier::class,
        ]);
    }
}

