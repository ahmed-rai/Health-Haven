<?php

namespace App\Form;

use App\Entity\Medicaments;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicamentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dci', TextType::class, [
                'label' => 'Nom Medicament',
            ])
            ->add('disponibilite',ChoiceType
            ::class, [
                'choices' =>$medicaments = [
                    'Disponible' => 'disponible',
                    'Nondisponible' => 'nondisponible',


                ]])
            ->add('prix')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medicaments::class,
        ]);
    }
}
