<?php

namespace App\Form;

use App\Entity\Allocation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType; // Import TextareaType
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AllocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('allocationDate')
            ->add('dog')
            ->add('keeper')
            ->add('notes', TextareaType::class, [ // Add a textarea field for notes
                'required' => false, // Make it optional (nullable=true in the entity)
                'label' => 'Notes', // Customize the label for the field
                'attr' => ['rows' => 4], // Optionally, set the number of rows for the textarea
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Allocation::class,
        ]);
    }
}
