<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vaccinationStatus', ChoiceType::class, [
                'label' => 'Vaccination Status',
                'choices' => [
                    'Fully Vaccinated' => 'fully_vaccinated',
                    'Not Fully Vaccinated' => 'not_fully_vaccinated',
                ],
            ])
            ->add('owner', EntityType::class, [
                'label' => 'Owner',
                'class' => 'App\Entity\Owner',
                'choice_label' => 'name',
                'placeholder' => 'Select an owner',
            ])
            ->add('dog', EntityType::class, [
                'label' => 'Dog',
                'class' => 'App\Entity\Dog',
                'choice_label' => 'name',
                'placeholder' => 'Select a dog',
            ]);

        if (!$options['exclude_check_in_date']) {
            $builder->add('checkInDate', null, [
                'label' => 'Check-In Date',
            ]);
        }

        if (!$options['exclude_check_out_date']) {
            $builder->add('checkOutDate', null, [
                'label' => 'Check-Out Date',
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
            'exclude_check_in_date' => false,
            'exclude_check_out_date' => false,
        ]);
    }
}
