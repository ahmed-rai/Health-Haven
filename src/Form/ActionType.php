<?php

namespace App\Form;

use App\Entity\Action;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ActionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('lieuact', TextType::class, [
                'label' => 'Lieu Action',
            ])
            ->add('dteact', TextType::class, [
                'label' => 'Date Action',
            ])
            
            ->add('hract', TextType::class, [
                'label' => 'Heure Action'
            ])
            ->add('descract', TextType::class, [
                'label' => 'Description Action',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Action::class,
        ]);
    }
}
