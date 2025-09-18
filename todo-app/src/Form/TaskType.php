<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Título',
                'required' => true,
                'attr' => ['maxlength' => 255],
                'constraints' => [
                    new NotBlank([
                        'message' => 'O título não pode estar vazio.',
                    ]),
                    new Length([
                        'max' => 255,
                        'min' => 3,
                        'minMessage' => 'O título deve ter pelo menos {{ limit }} caracteres.',
                        'maxMessage' => 'O título não pode ter mais de {{ limit }} caracteres.',
                    ]),
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'Descrição (Opcional)',
                'required' => false,
                'attr' => ['maxlength' => 1000],
                'constraints' => [
                    new Length([
                        'max' => 1000,
                        'maxMessage' => 'A descrição não pode ter mais de {{ limit }} caracteres.',
                    ]),
                ],
            ])
            ->add('dueAt', DateTimeType::class, [
                'label' => 'Data de Conclusão',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'A Fazer' => 'todo',
                    'Em Progresso' => 'in_progress',
                    'Concluída' => 'done',
                ],
            ])
            ->add('priority', ChoiceType::class, [
                'label' => 'Prioridade',
                'choices' => [
                    'Baixa' => 1,
                    'Média' => 2,
                    'Alta' => 3,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
