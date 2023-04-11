<?php
// src/Form/TestType.php
namespace App\Form;

use App\Entity\Test;
use App\Entity\Quiz;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', TextType::class, [
                'label' => 'Question',
                'help' => 'Le champ question ne peut pas être vide.',
            ])
            ->add('answer1', TextType::class, [
                'label' => 'Réponse 1',
                'help' => 'Le champ answer1 ne peut pas être vide.',
            ])
            ->add('score1', IntegerType::class, [
                'label' => 'Score 1',
                'help' => 'Le champ score1 ne peut pas être vide. Le score1 doit être un nombre.',
            ])
            ->add('answer2', TextType::class, [
                'label' => 'Réponse 2',
                'help' => 'Le champ answer2 ne peut pas être vide.',
            ])
            ->add('score2', IntegerType::class, [
                'label' => 'Score 2',
                'help' => 'Le champ score2 ne peut pas être vide. Le score2 doit être un nombre.',
            ])
            ->add('answer3', TextType::class, [
                'label' => 'Réponse 3',
                'help' => 'Le champ answer3 ne peut pas être vide.',
            ])
            ->add('score3', IntegerType::class, [
                'label' => 'Score 3',
                'help' => 'Le champ score3 ne peut pas être vide. Le score3 doit être un nombre.',
            ])
            ->add('answer4', TextType::class, [
                'label' => 'Réponse 4',
                'help' => 'Le champ answer4 ne peut pas être vide.',
            ])
            ->add('score4', IntegerType::class, [
                'label' => 'Score 4',
                'help' => 'Le champ score4 ne peut pas être vide. Le score4 doit être un nombre.',
            ])
            ->add('quiz', EntityType::class, [
                'class' => Quiz::class,
                'choice_label' => 'name',
                'label' => 'Quiz',
                'help' => 'Sélectionnez le quiz associé à cette question.',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Test::class,
        ]);
    }
}
