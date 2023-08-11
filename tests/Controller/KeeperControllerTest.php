<?php

// src/Controller/KeeperController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Keeper;
use App\Form\KeeperType;

class KeeperController extends AbstractController
{
    public function index()
    {
        $keepers = $this->getDoctrine()->getRepository(Keeper::class)->findAll();
        return $this->render('keeper/index.html.twig', ['keepers' => $keepers]);
    }

    public function create(Request $request)
    {
        $keeper = new Keeper();
        $form = $this->createForm(KeeperType::class, $keeper);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($keeper);
            $entityManager->flush();

            return $this->redirectToRoute('keeper_list');
        }

        return $this->render('keeper/create.html.twig', ['form' => $form->createView()]);
    }

    public function edit(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $keeper = $entityManager->getRepository(Keeper::class)->find($id);

        if (!$keeper) {
            throw $this->createNotFoundException('Keeper not found');
        }

        $form = $this->createForm(KeeperType::class, $keeper);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('keeper_list');
        }

        return $this->render('keeper/edit.html.twig', ['form' => $form->createView()]);
    }

    public function delete(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $keeper = $entityManager->getRepository(Keeper::class)->find($id);

        if (!$keeper) {
            throw $this->createNotFoundException('Keeper not found');
        }

        if ($request->isMethod('POST')) {
            $entityManager->remove($keeper);
            $entityManager->flush();

            return $this->redirectToRoute('keeper_list');
        }

        return $this->render('keeper/delete.html.twig', ['keeper' => $keeper]);
    }
}
