<?php

namespace App\Controller;

use App\Entity\Transactions;
use App\Form\TransactionsType;
use App\Repository\TransactionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/transactions")
 */
class TransactionsController extends AbstractController
{
    /**
     * @Route("/{acc}/{cust}", name="transactions_index", methods="GET")
     */
    public function index(TransactionsRepository $transactionsRepository,$acc,$cust): Response
    {
        return $this->render('transactions/index.html.twig', ['transactions' => $transactionsRepository->findBycustomer($cust),'acc'=>$acc,'cust'=>$cust]);
    }

    /**
     * @Route("/customer/{custom}/{acc}", name="transactions_index_customer", methods="GET")
     */
    public function indexcustomer(TransactionsRepository $transactionsRepository,$custom,$acc): Response
    {
        return $this->render('transactions/index_customer.html.twig', ['transactions' => $transactionsRepository->findByaccount($custom),'acc'=>$acc]);
    }

    /**
     * @Route("/account/{acc}", name="transactions_index_account", methods="GET")
     */
    public function indexaccount(TransactionsRepository $transactionsRepository, $acc): Response
    {
        return $this->render('transactions/index_account.html.twig', ['transactions' => $transactionsRepository->findByaccount($acc),'acc'=>$acc]);
    }
    /**
     * @Route("/new/{acc}/{cust}", name="transactions_new", methods="GET|POST")
     */
    public function new(Request $request,TransactionsRepository $transactionsRepository, $acc, $cust): Response
    {
        $transaction = new Transactions();
        $form = $this->createForm(TransactionsType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form['amount']->getdata() < 1)
           {
            $this->addFlash(
                'danger',
                'the amount shoud be greater than dollar doesn t exist'
            );
            return $this->render('transactions/new.html.twig', [
                'transaction' => $transaction,
                'form' => $form->createView(),
                'acc' => $acc,
                'cust' => $cust
            ]);
           }
            $em = $this->getDoctrine()->getManager();
            $transaction->setTransfer(0);
            $em->persist($transaction);
            $em->flush();

            return $this->redirectToRoute('transactions_index',['cust' => $cust,'acc'=>$acc]);
        }

        return $this->render('transactions/new.html.twig', [
            'transaction' => $transaction,
            'form' => $form->createView(),
            'acc' => $acc,
            'cust' => $cust
        ]);
    }

    /**
     * @Route("/{id}/{acc}", name="transactions_show", methods="GET")
     */
    public function show(Transactions $transaction,$acc): Response
    {
        return $this->render('transactions/show.html.twig', ['transaction' => $transaction,'acc'=>$acc]);
    }

    /**
     * @Route("/{id}/edit/{acc}", name="transactions_edit", methods="GET|POST")
     */
    public function edit(Request $request, Transactions $transaction,$acc): Response
    {
        $form = $this->createForm(TransactionsType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('transactions_edit', ['id' => $transaction->getId(),'acc'=>$acc]);
        }

        return $this->render('transactions/edit.html.twig', [
            'transaction' => $transaction,
            'form' => $form->createView(),
            
        ]);
    }

    /**
     * @Route("/{id}/{acc}", name="transactions_delete", methods="DELETE")
     */
    public function delete(Request $request, Transactions $transaction,$acc): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transaction->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($transaction);
            $em->flush();
        }

        return $this->redirectToRoute('transactions_index',['acc'=>$acc]);
    }
    /**
     * @Route("/options/{acc}/{cust}", name="transaction_option", methods="GET")
     */
    public function option($acc, $cust): Response
    {
        return $this->render('transactions/options.html.twig', ['acc' => $acc, 'cust' => $cust]);
    }
}
