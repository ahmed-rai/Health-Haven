<?php
// src/Form/TestType.php
/* namespace App\Form;

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
            'attr' => [
            'class' => 'form-control',
            'placeholder' => 'Entrez la question'
            ],
            'required' => true,
            ])
            ->add('answer1', TextType::class, [
                'label' => 'Réponse 1',
                'attr' => [
                    'class' => 'form-control col-6',
                    'placeholder' => 'Entrez la réponse 1'
                ],
                'required' => true,
            ])
            ->add('score1', IntegerType::class, [
            'label' => 'Score 1',
            'attr' => [
            'class' => 'form-control col-6',
            'placeholder' => 'Entrez le score 1'
            ],
            'required' => true,
            ])
            ->add('answer2', TextType::class, [
            'label' => 'Réponse 2',
            'attr' => [
            'class' => 'form-control',
            'placeholder' => 'Entrez la réponse 2'
            ],
            'required' => true,
            ])
            ->add('score2', IntegerType::class, [
            'label' => 'Score 2',
            'attr' => [
            'class' => 'form-control',
            'placeholder' => 'Entrez le score 2'
            ],
            'required' => true,
            ])
            ->add('answer3', TextType::class, [
            'label' => 'Réponse 3',
            'attr' => [
            'class' => 'form-control',
            'placeholder' => 'Entrez la réponse 3'
            ],
            'required' => true,
            ])
            ->add('score3', IntegerType::class, [
            'label' => 'Score 3',
            'attr' => [
            'class' => 'form-control',
            'placeholder' => 'Entrez le score 3'
            ],
            'required' => true,
            ])
            ->add('answer4', TextType::class, [
            'label' => 'Réponse 4',
            'attr' => [
            'class' => 'form-control',
            'placeholder' => 'Entrez la réponse 4'
            ],
            'required' => true,
            ])
            ->add('score4', IntegerType::class, [
            'label' => 'Score 4',
            'attr' => [
            'class' => 'form-control',
            'placeholder' => 'Entrez le score 4'
            ],
            'required' => true,
            ])
            ->add('quiz', EntityType::class, [
            'class' => Quiz::class,
            'choice_label' => 'name',
            'label' => 'Quiz',
            'attr' => [
            'class' => 'form-control'
            ],
            'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Test::class,
        ]);
    }
}
 */


namespace App\Form;

use App\Entity\Test;
use App\Entity\Quiz;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\AbstractType;



use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('question', TextType::class, [
            'label' => 'Question',
            'attr' => [
                'placeholder' => 'Entrez la question',
                'class' => 'form-control'
            ],
            'constraints' => [
                new NotBlank(['message' => 'Le champ question ne peut pas être vide.']),
            ],
        ])
        ->add('answer1', TextType::class, [
            'label' => 'Réponse 1',
            'attr' => [
                'placeholder' => 'Entrez la réponse 1',
                'class' => 'form-control'
            ],
            'constraints' => [
                new NotBlank(['message' => 'Le champ answer1 ne peut pas être vide.']),
            ],
        ])
        ->add('score1', IntegerType::class, [
            'label' => 'Score 1',
            'attr' => [
                'placeholder' => 'Entrez le score 1',
                'class' => 'form-control'
            ],
            'constraints' => [
                new NotBlank(['message' => 'Le champ score1 ne peut pas être vide.']),
                new Type(['type' => 'integer', 'message' => 'Le score1 doit être un nombre.']),
            ],
        ])
        ->add('answer2', TextType::class, [
            'label' => 'Réponse 2',
            'attr' => [
                'placeholder' => 'Entrez la réponse 2',
                'class' => 'form-control'
            ],
            'constraints' => [
                new NotBlank(['message' => 'Le champ answer2 ne peut pas être vide.']),
            ],
        ])
        ->add('score2', IntegerType::class, [
            'label' => 'Score 2',
            'attr' => [
                'placeholder' => 'Entrez le score 2',
                'class' => 'form-control'
            ],
            'constraints' => [
                new NotBlank(['message' => 'Le champ score2 ne peut pas être vide.']),
                new Type(['type' => 'integer', 'message' => 'Le score2 doit être un nombre.']),
            ],
        ])
        ->add('answer3', TextType::class, [
            'label' => 'Réponse 3',
            'attr' => [
                'placeholder' => 'Entrez la réponse 3',
                'class' => 'form-control'
            ],
            'constraints' => [
                new NotBlank(['message' => 'Le champ answer3 ne peut pas être vide.']),
            ],
        ])
        ->add('score3', IntegerType::class, [
            'label' => 'Score 3',
            'attr' => [
                'placeholder' => 'Entrez le score 3',
                'class' => 'form-control'
            ],
            'constraints' => [
                new NotBlank(['message' => 'Le champ score3 ne peut pas être vide.']),
                new Type(['type' => 'integer', 'message' => 'Le score3 doit être un nombre.']),
            ],
        ])
        ->add('answer4', TextType::class, [
            'label' => 'Réponse 4',
            'attr' => ['placeholder' => 'Entrez la réponse 4', 'class' => 'form-control'],
            'constraints' => [
                new NotBlank(['message' => 'Le champ answer4 ne peut pas être vide.']),
            ],
        ])
        ->add('score4', IntegerType::class, [
            'label' => 'Score 4',
            'attr' => ['placeholder' => 'Entrez le score 4', 'class' => 'form-control'],
            'constraints' => [
                new NotBlank(['message' => 'Le champ score4 ne peut pas être vide.']),
                new Type(['type' => 'integer', 'message' => 'Le score4 doit être un nombre.']),
            ],
        ])
        
                ->add('quiz', EntityType::class, [
                    'class' => Quiz::class,
                    'choice_label' => 'name',
                    'label' => 'Quiz',
                    'attr' => [
                    'class' => 'form-control'
                    ],
                    'required' => true,
                    ]);              
                }
                public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults([
        'data_class' => Test::class,
    ]);
}

}