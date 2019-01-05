<?php

namespace App\Controller;

use App\Entity\Tranfers;
use App\Form\TranfersType;
use App\Repository\TranfersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tranfers")
 */
class TranfersController extends AbstractController
{
    /**
     * @Route("/{acc}", name="tranfers_index", methods="GET")
     */
    public function index(TranfersRepository $tranfersRepository,$acc): Response
    {
        return $this->render('tranfers/index.html.twig', ['tranfers' => $tranfersRepository->findAll(),'acc'=>$acc]);
    }

    /**
     * @Route("/new/{acc}", name="tranfers_new", methods="GET|POST")
     */
    public function new(Request $request,$acc): Response
    {
        $tranfer = new Tranfers();
        $form = $this->createForm(TranfersType::class, $tranfer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tranfer);
            $em->flush();

            return $this->redirectToRoute('tranfers_index',['acc'=>$acc]);
        }

        return $this->render('tranfers/new.html.twig', [
            'tranfer' => $tranfer,
            'form' => $form->createView(),'acc'=>$acc
        ]);
    }

    /**
     * @Route("/{id}/{acc}", name="tranfers_show", methods="GET")
     */
    public function show(Tranfers $tranfer,$acc): Response
    {
        return $this->render('tranfers/show.html.twig', ['tranfer' => $tranfer,'acc'=>$acc]);
    }

    /**
     * @Route("/{id}/edit/{acc}", name="tranfers_edit", methods="GET|POST")
     */
    public function edit(Request $request, Tranfers $tranfer,$acc): Response
    {
        $form = $this->createForm(TranfersType::class, $tranfer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tranfers_edit', ['id' => $tranfer->getId(),'acc'=>$acc]);
        }

        return $this->render('tranfers/edit.html.twig', [
            'tranfer' => $tranfer,
            'form' => $form->createView(),'acc'=>$acc
        ]);
    }

    /**
     * @Route("/{id}/{acc}", name="tranfers_delete", methods="DELETE")
     */
    public function delete(Request $request, Tranfers $tranfer,$acc): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tranfer->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tranfer);
            $em->flush();
        }

        return $this->redirectToRoute('tranfers_index',['acc'=>$acc]);
    }


}
