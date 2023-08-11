<?php



// src/Controller/AllocationController.php

namespace App\Controller;

use App\Entity\Allocation;
use App\Form\AllocationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllocationController extends AbstractController
{
    /**
     * @Route("/allocation", name="app_allocation_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $allocations = $entityManager
            ->getRepository(Allocation::class)
            ->findAll();

        return $this->render('allocation/index.html.twig', [
            'allocations' => $allocations,
        ]);
    }

    /**
     * @Route("/allocation/new", name="app_allocation_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $allocation = new Allocation();
        $form = $this->createForm(AllocationType::class, $allocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($allocation);
            $entityManager->flush();

            return $this->redirectToRoute('app_allocation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('allocation/new.html.twig', [
            'allocation' => $allocation,
            'form' => $form,
        ]);
    }

   /**
     * @Route("/allocation/{id}/edit", name="app_allocation_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Allocation $allocation, EntityManagerInterface $entityManager): Response
    {
        // Check if the user is granted either 'ROLE_MANAGER' or 'ROLE_KEEPER'
        if (!$this->isGranted('ROLE_MANAGER') && !$this->isGranted('ROLE_KEEPER')) {
            throw new AccessDeniedException('You are not allowed to edit allocations.');
        }

        $form = $this->createForm(AllocationType::class, $allocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_allocation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('allocation/edit.html.twig', [
            'allocation' => $allocation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/allocation/{id}", name="app_allocation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Allocation $allocation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$allocation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($allocation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_allocation_index', [], Response::HTTP_SEE_OTHER);
    }
}
