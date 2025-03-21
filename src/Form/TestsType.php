<?php

namespace App\Form;

use App\Entity\Tests;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du test',
                'attr' => ['class' => 'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['class' => 'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none'],
            ])
            ->add('steps', TextareaType::class, [
                'label' => 'Étapes à suivre',
                'attr' => ['class' => 'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none'],
            ])
            ->add('acceptance_criteria', TextareaType::class, [
                'label' => 'Critères d’acceptation',
                'attr' => ['class' => 'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none'],
            ])
            ->add('excected_result', TextareaType::class, [
                'label' => 'Résultat attendu',
                'attr' => ['class' => 'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none'],
            ])
            ->add('actual_result', TextareaType::class, [
                'label' => 'Résultat actuel',
                'attr' => ['class' => 'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none'],
            ])
            ->add('observations', TextareaType::class, [
                'label' => 'Observations',
                'required' => false,
                'attr' => ['class' => 'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none'],
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'En cours' => 'en_cours',
                    'Réussi' => 'reussi',
                    'Échoué' => 'echoue',
                ],
                'expanded' => false,
                'multiple' => false,
                'attr' => ['class' => 'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tests::class,
        ]);
    }
}
