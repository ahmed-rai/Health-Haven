<?php

namespace App\Form;

use App\Entity\Prescription;
use http\Env\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrescriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomMed', ChoiceType
            ::class, [
                'choices' =>$medicaments = [
                    'Aspirine' => 'aspirine',
                    'Paracétamol' => 'paracetamol',
                    'Ibuprofène' => 'ibuprofene',
                    'Amoxicilline' => 'amoxicilline',
                    'Panadole' => 'Panadole:',
                ]])
            ->add('dosage')
            ->add('signature')
            ->add('iduser')

        ;



    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prescription::class,
        ]);
    }
}
