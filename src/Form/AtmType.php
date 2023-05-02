<?php

namespace App\Form;

use App\Entity\Atm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;

class AtmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Test Covid' => 'Test covid',
                    'Test tension' => 'Test tension',
                    'Test sang' => 'Test sang',
                    'Test urine' => 'Test urine',
                    'Analyse sur les celles' => 'Analyse sur les celles',
                ],
                'constraints' => [
                    new NotBlank(['message' => "Le champ 'Type' ne doit pas être vide."])
                ]
            ])
            ->add('dtetest');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Atm::class,
        ]);
    }
}
