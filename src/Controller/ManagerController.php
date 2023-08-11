<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Manager;
use App\Entity\VetRequest;
use App\Form\ManagerType;
use App\Repository\BookingRepository;
use App\Repository\ManagerRepository;
use App\Repository\VetRequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/manager")
 */
class ManagerController extends AbstractController
{
    /**
     * @Route("/", name="manager_index", methods={"GET"})
     */
    public function index(ManagerRepository $managerRepository): Response
    {
        $managers = $managerRepository->findAll();

        return $this->render('manager/index.html.twig', [
            'managers' => $managers,
        ]);
    }

    /**
     * @Route("/new", name="manager_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $manager = new Manager();
        $form = $this->createForm(ManagerType::class, $manager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($manager);
            $entityManager->flush();

            return $this->redirectToRoute('manager_index');
        }

        return $this->render('manager/new.html.twig', [
            'manager' => $manager,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="manager_show", methods={"GET"})
     */
    public function show(Manager $manager): Response
    {
        return $this->render('manager/show.html.twig', [
            'manager' => $manager,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="manager_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Manager $manager): Response
    {
        $form = $this->createForm(ManagerType::class, $manager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('manager_index');
        }

        return $this->render('manager/edit.html.twig', [
            'manager' => $manager,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="manager_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Manager $manager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$manager->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($manager);
            $entityManager->flush();
        }

        return $this->redirectToRoute('manager_index');
    }

    /**
     * @Route("/booking/{id}/approve", name="booking_approve", methods={"POST"})
     */
    public function approveBooking(Request $request, Booking $booking): Response
    {
        // Logic to approve the booking

        return $this->redirectToRoute('booking_index');
    }

    /**
     * @Route("/allocation/index", name="allocation_index", methods={"GET"})
     */
    public function allocationIndex(): Response
    {
        // Logic to retrieve and display daily allocations of dogs to keepers

        return $this->render('manager/allocation/index.html.twig', [
            // Pass necessary data to the template if required
        ]);
    }

    /**
     * @Route("/allocation/new", name="allocation_new", methods={"GET","POST"})
     */
    public function newAllocation(Request $request): Response
    {
        // Logic to create a new daily allocation of a dog to a keeper

        return $this->render('manager/allocation/new.html.twig', [
            // Pass necessary data to the template if required
        ]);
    }

    /**
     * @Route("/allocation/{id}/edit", name="allocation_edit", methods={"GET","POST"})
     */
    public function editAllocation(Request $request, $id): Response
    {
        // Logic to edit an existing daily allocation of a dog to a keeper

        return $this->render('manager/allocation/edit.html.twig', [
            // Pass necessary data to the template if required
        ]);
    }

    /**
     * @Route("/vet/request/{id}/process", name="vet_request_process", methods={"POST"})
     */
    public function processVetRequest(Request $request, VetRequest $vetRequest): Response
    {
        // Logic to process the vet request

        return $this->redirectToRoute('vet_request_index');
    }
}
