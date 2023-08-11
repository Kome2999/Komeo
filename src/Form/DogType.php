<?php

// src/Form/DogType.php

namespace App\Form;

use App\Entity\Dog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
            ])
            ->add('age', TextType::class, [
                'label' => 'Age',
            ])
            ->add('breed', TextType::class, [
                'label' => 'Breed',
            ])
            ->add('sex', ChoiceType::class, [
                'label' => 'Sex',
                'choices' => [
                    'Male' => 'Male',
                    'Female' => 'Female',
                ],
            ])
            ->add('weight', TextType::class, [
                'label' => 'Weight',
            ])
            ->add('dietaryRequirements', TextareaType::class, [
                'label' => 'Dietary Requirements',
                'required' => false,
            ])
            ->add('medicineRequirements', TextareaType::class, [
                'label' => 'Medicine Requirements',
                'required' => false,
            ])
            ->add('specialNotes', TextareaType::class, [
                'label' => 'Special Notes',
                'required' => false,
            ])
            ->add('vaccinationStatus', TextType::class, [
                'label' => 'Vaccination Status',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dog::class,
        ]);
    }
}

