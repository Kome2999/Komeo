<?php

// src/Controller/DefaultController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index(): Response
    {
        // Customize the homepage behavior here based on roles or any other logic you need
        $user = $this->getUser();
        if ($user) {
            // User is logged in, determine which homepage to redirect based on roles
            $role = $user->getRoles()[0]; // Get the first role (assuming you have only one primary role)

            if ($role === 'ROLE_ADMIN') {
                return $this->redirectToRoute('adminpage');
            } elseif ($role === 'ROLE_MANAGER') {
                return $this->redirectToRoute('managerpage');
            } elseif ($role === 'ROLE_OWNER') {
                return $this->redirectToRoute('ownerpage');
            } elseif ($role === 'ROLE_VET') {
                return $this->redirectToRoute('vetpage');
            } elseif ($role === 'ROLE_KEEPER') {
                return $this->redirectToRoute('keeperpage');
            } else {
                // For regular users with ROLE_USER, show a generic page
                return $this->render('default/index.html.twig');
            }
        } else {
            // User is not logged in, show the default homepage
            return $this->render('default/index.html.twig');
        }
    }

    /**
     * @Route("/owner", name="ownerpage")
     */
    public function ownerHomepage(): Response
    {
        return $this->render('default/owner.html.twig');
    }

    /**
     * @Route("/manager", name="managerpage")
     */
    public function managerHomepage(): Response
    {
        return $this->render('default/manager.html.twig');
    }

    /**
     * @Route("/vet", name="vetpage")
     */
    public function vetHomepage(): Response
    {
        return $this->render('default/vet.html.twig');
    }

    /**
     * @Route("/keeper", name="keeperpage")
     */
    public function keeperHomepage(): Response
    {
        return $this->render('default/keeper.html.twig');
    }
}
