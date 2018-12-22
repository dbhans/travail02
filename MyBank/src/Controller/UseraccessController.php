<?php

namespace App\Controller;

use App\Entity\Useraccess;
use App\Form\UseraccessType;
use App\Repository\UseraccessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/useraccess")
 */
class UseraccessController extends AbstractController
{
    /**
     * @Route("/", name="useraccess_index", methods="GET")
     */
    public function index(UseraccessRepository $useraccessRepository): Response
    {
        return $this->render('useraccess/index.html.twig', ['useraccesses' => $useraccessRepository->findAll()]);
    }

    /**
     * @Route("/new", name="useraccess_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $useraccess = new Useraccess();
        $form = $this->createForm(UseraccessType::class, $useraccess);
        $form->handleRequest($request);
     
       
            if ($form->isSubmitted() && $form->isValid()) {
               //$val = $form['username']->getData();
               
                $em = $this->getDoctrine()->getManager();
                $em->persist($useraccess);
                $em->flush();

                return $this->redirectToRoute('useraccess_index');
            }
        

      

        return $this->render('useraccess/new.html.twig', [
            'useraccess' => $useraccess,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="useraccess_show", methods="GET")
     */
    public function show(Useraccess $useraccess): Response
    {
        return $this->render('useraccess/show.html.twig', ['useraccess' => $useraccess]);
    }

    /**
     * 
     * @Route("/{id}/edit", name="useraccess_edit", methods="GET|POST")
     */
    public function edit(Request $request, Useraccess $useraccess): Response
    {
        $form = $this->createForm(UseraccessType::class, $useraccess);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('useraccess_edit', ['id' => $useraccess->getId()]);
        }

        return $this->render('useraccess/edit.html.twig', [
            'useraccess' => $useraccess,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="useraccess_delete", methods="DELETE")
     */
    public function delete(Request $request, Useraccess $useraccess): Response
    {
        if ($this->isCsrfTokenValid('delete'.$useraccess->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($useraccess);
            $em->flush();
        }

        return $this->redirectToRoute('useraccess_index');
    }
}
