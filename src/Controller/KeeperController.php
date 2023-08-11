<?php

// src/Controller/KeeperController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Keeper;
use App\Form\KeeperType;
use Doctrine\ORM\EntityManagerInterface;

class KeeperController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index()
    {
        $keepers = $this->entityManager->getRepository(Keeper::class)->findAll();
        return $this->render('keeper/index.html.twig', ['keepers' => $keepers]);
    }

    public function create(Request $request)
    {
        $keeper = new Keeper();
        $form = $this->createForm(KeeperType::class, $keeper);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($keeper);
            $this->entityManager->flush();

            return $this->redirectToRoute('keeper_list');
        }

        return $this->render('keeper/create.html.twig', ['form' => $form->createView()]);
    }

    public function edit(Request $request, $id)
    {
        $keeper = $this->entityManager->getRepository(Keeper::class)->find($id);

        if (!$keeper) {
            throw $this->createNotFoundException('Keeper not found');
        }

        $form = $this->createForm(KeeperType::class, $keeper);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('keeper_list');
        }

        return $this->render('keeper/edit.html.twig', ['form' => $form->createView()]);
    }

    public function delete(Request $request, $id)
    {
        $keeper = $this->entityManager->getRepository(Keeper::class)->find($id);

        if (!$keeper) {
            throw $this->createNotFoundException('Keeper not found');
        }

        if ($request->isMethod('POST')) {
            $this->entityManager->remove($keeper);
            $this->entityManager->flush();

            return $this->redirectToRoute('keeper_list');
        }

        return $this->render('keeper/delete.html.twig', ['keeper' => $keeper]);
    }
}
