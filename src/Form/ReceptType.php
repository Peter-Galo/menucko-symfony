<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Recept;

class ReceptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Názov',
                'required' => true,
            ])
            ->add('days', IntegerType::class, [
                'label' => 'Na koľko dní',
                'required' => true,
                'attr' => ['min' => 1],
            ])
            ->add('category', ChoiceType::class, [
                'label' => 'Kategória',
                'choices' => [
                    'Mäsko' => 'masko',
                    'Veg' => 'veg',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Typ',
                'required' => false,
                'choices' => [
                    'Slané' => 'slane',
                    'Sladké' => 'sladke',
                ],
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recept::class,
        ]);
    }
}
