<?php


use Symfony\Component\Form\Test\TypeTestCase;
use App\Form\BookingRequestType;
use App\Entity\BookingRequest;
use App\Entity\Dog;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingRequestTypeTest extends TypeTestCase
{
    protected function getExtensions()
    {
        $dog = new Dog();
        $dog->setName('Buddy'); // Replace with an actual dog name

        // Set up the mock of the EntityType
        $dogEntityType = $this->createMock(EntityType::class);
        $dogEntityType
            ->method('getBlockPrefix')
            ->willReturn('entity');

        $dogEntityType
            ->method('configureOptions')
            ->willReturnCallback(function (OptionsResolver $resolver) use ($dog) {
                $resolver->setDefault('class', Dog::class);
                $resolver->setDefault('choice_label', 'name');
                $resolver->setDefault('choices', [$dog]);
            });

        return [
            new PreloadedExtension([$dogEntityType], []),
        ];
    }

    public function testSubmitValidData()
    {
        $formData = [
            'dog' => 1, // Assuming the choice value for the dog entity is 1
            'vaccinationStatus' => 'fully vaccinated',
            'startDate' => new \DateTime(),
            'endDate' => new \DateTime(),
            'isolationKennelAvailable' => true,
            'sharedSocialKennelAvailable' => false,
        ];

        $form = $this->factory->create(BookingRequestType::class);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertInstanceOf(BookingRequest::class, $form->getData());

    }
}
