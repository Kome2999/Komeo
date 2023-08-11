<?php


// src/Controller/DogController.php

namespace App\Controller;

use App\Entity\Dog;
use App\Form\DogType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DogController extends AbstractController
{
    /**
     * @Route("/dogs", name="dog_list")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $dogs = $entityManager->getRepository(Dog::class)->findAll();

        return $this->render('dog/index.html.twig', [
            'dogs' => $dogs,
        ]);
    }

    /**
     * @Route("/create-dog", name="create_dog")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Create a new Dog instance
        $dog = new Dog();

        // Create the form using DogType and bind it to the $dog object
        $form = $this->createForm(DogType::class, $dog);

        // Handle the form submission
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Save the dog to the database
            $entityManager->persist($dog);
            $entityManager->flush();

            // Redirect to a success page or perform any additional actions
            return $this->redirectToRoute('dog_list');
        }

        // If the form is not submitted or not valid, render the create.html.twig template
        return $this->render('dog/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

   /**
 * @Route("/dogs/{id}/edit", name="dog_edit")
 */
public function edit(Request $request, Dog $dog, EntityManagerInterface $entityManager): Response
{
    $form = $this->createForm(DogType::class, $dog);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        return $this->redirectToRoute('dog_list');
    }

    return $this->render('dog/edit.html.twig', [
        'form' => $form->createView(),
        'dog' => $dog, // Pass the dog object to the template
    ]);
}




    /**
     * @Route("/dogs/{id}/delete", name="dog_delete", methods={"POST"})
     */
    public function delete(Request $request, Dog $dog, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dog->getId(), $request->request->get('_token'))) {
            $entityManager->remove($dog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dog_list');
    }
}
