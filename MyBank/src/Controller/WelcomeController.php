<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class WelcomeController extends AbstractController
{

    /**
     * @Route("/", name="Welcome_index", methods="GET")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('manager_index');
        //return $this->render('Welcome/index.html.twig');
    }


}