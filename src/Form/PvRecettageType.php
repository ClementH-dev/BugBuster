<?php

namespace App\Form;

use App\Entity\PvRecettage;
use App\Entity\Tests;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PvRecettageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none'],
            ])
            ->add('technicalEnvironment', TextareaType::class, [
                'label' => 'Environnement technique',
                'attr' => ['class' => 'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none'],
            ])
            ->add('criticalPoints', TextareaType::class, [
                'label' => 'Points critiques',
                'attr' => ['class' => 'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none'],
            ])
            ->add('consequences', TextareaType::class, [
                'label' => 'Conséquences',
                'attr' => ['class' => 'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none'],
            ])
            ->add('actionPlan', TextareaType::class, [
                'label' => 'Plan d’action',
                'attr' => ['class' => 'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none'],
            ])
            ->add('conlusion', TextareaType::class, [
                'label' => 'Conclusion',
                'attr' => ['class' => 'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none'],
            ])
            ->add('tests', EntityType::class, [
                'class' => Tests::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.name', 'ASC');
                },
                'attr' => [
                    'class' => 'select2-multiple w-full',
                    'data-placeholder' => 'Rechercher des tests...',
                ],
                'by_reference' => false,
            ])
            ->add('_token', HiddenType::class, [
                'mapped' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PvRecettage::class,
            'csrf_protection' => true,
        ]);
    }
}
