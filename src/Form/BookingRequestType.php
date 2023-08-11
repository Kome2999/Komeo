<?php

namespace App\Form;

use App\Entity\BookingRequest;
use App\Entity\Dog;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dog', EntityType::class, [
                'class' => Dog::class,
                'label' => 'Dog',
                'required' => true,
                'choice_label' => 'name', // Assuming Dog entity has a "name" property
            ])
            ->add('vaccinationStatus', ChoiceType::class, [
                'label' => 'Vaccination Status',
                'choices' => [
                    'Fully Vaccinated' => 'fully vaccinated',
                    'Partially Vaccinated' => 'partially vaccinated',
                    'Not Vaccinated' => 'not vaccinated',
                ],
                'required' => true,
            ])
            ->add('startDate', DateType::class, [
                'label' => 'Start Date',
                'widget' => 'single_text',
            ])
            ->add('endDate', DateType::class, [
                'label' => 'End Date',
                'widget' => 'single_text',
            ])
            ->add('isolationKennelAvailable', CheckboxType::class, [
                'label' => 'Isolation Kennel Available',
                'required' => false,
            ])
            ->add('sharedSocialKennelAvailable', CheckboxType::class, [
                'label' => 'Shared Social Kennel Available',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BookingRequest::class,
        ]);
    }
}
