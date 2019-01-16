<?php

namespace App\Controller;

use App\Entity\Tranfers;
use App\Entity\Transactions;
use App\Form\TranfersType;
use App\Repository\TranfersRepository;
use App\Repository\AccountsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/transfers")
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
    public function new(Request $request,AccountsRepository $accountsRepository,$acc): Response
    {
        $tranfer = new Tranfers();
        $tranfer->setPayer($acc);
        $form = $this->createForm(TranfersType::class, $tranfer);
        $form->handleRequest($request);
        $message = array();

        if ($form->isSubmitted() && $form->isValid()) {
            
                if ($accountsRepository->find($form['payee']->getdata())== null)
                {
                    $message[0] = 1 ;
                }
                if ($accountsRepository->find($form['payer']->getdata())== null)
                {
                    $message[1] = 1 ;
                } 
                if(isset( $message[1])&&isset( $message[0]))  
                {
                    $this->addFlash(
                        'danger',
                        "Both account doesn't exist"
                    );
                    return $this->render('tranfers/new.html.twig', [
                       'tranfer' => $tranfer,
                       'form' => $form->createView(),'acc'=>$acc
                   ]);
                } elseif (isset( $message[1])&&!isset( $message[0])) {
                    $this->addFlash(
                        'danger',
                        'the account '.$form['payer']->getdata().' doesn t exist' 
                    );
                    return $this->render('tranfers/new.html.twig', [
                       'tranfer' => $tranfer,
                       'form' => $form->createView(),'acc'=>$acc
                   ]);
                } elseif (!isset( $message[1]) && isset( $message[0])) {
                    $this->addFlash(
                        'danger',
                        'the account '.$form['payee']->getdata().' doesn t exist' 
                    );
                    return $this->render('tranfers/new.html.twig', [
                       'tranfer' => $tranfer,
                       'form' => $form->createView(),'acc'=>$acc
                   ]);
                }                
                
                
            $customerpayer = $accountsRepository->find($form['payer']->getdata());
            $customerpayee = $accountsRepository->find($form['payee']->getdata());



            $em = $this->getDoctrine()->getManager();
            $em->persist($tranfer);
            $em->flush();
            unset($message);
            // creation of the transaction for the payee
            $payee = new Transactions();
            $payee->setAmount($form['transfer']->getdata());
            $payee->setType("Deposit");
            $payee->setAccount($form['payee']->getdata());
            $payee->setTransfer($tranfer->getId());
            $payee->setIduser($customerpayee->getCustomer());

             // creation of the transaction for the payer
            $payer = new Transactions();
            $payer->setAmount($form['transfer']->getdata());
            $payer->setType("Widthdraw");
            $payer->setAccount($form['payer']->getdata());
            $payer->setTransfer($tranfer->getId());
            $payer->setIduser($customerpayer->getCustomer());

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
