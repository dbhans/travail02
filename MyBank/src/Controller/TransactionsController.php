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
     * @Route("/", name="transactions_index", methods="GET")
     */
    public function index(TransactionsRepository $transactionsRepository): Response
    {
        return $this->render('transactions/index.html.twig', ['transactions' => $transactionsRepository->findAll()]);
    }

    /**
     * @Route("/customer/{custom}", name="transactions_index_customer", methods="GET")
     */
    public function indexcustomer(TransactionsRepository $transactionsRepository,$custom): Response
    {
        return $this->render('transactions/index_customer.html.twig', ['transactions' => $transactionsRepository->findBycustomer($custom)]);
    }

    /**
     * @Route("/account/{accout}", name="transactions_index_account", methods="GET")
     */
    public function indexaccount(TransactionsRepository $transactionsRepository, $accout): Response
    {
        return $this->render('transactions/index_account.html.twig', ['transactions' => $transactionsRepository->findByaccount($accout)]);
    }
    /**
     * @Route("/new", name="transactions_new", methods="GET|POST")
     */
    public function new(Request $request,TransactionsRepository $transactionsRepository): Response
    {
        $transaction = new Transactions();
        $form = $this->createForm(TransactionsType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($transactionsRepository->find($form['amount']->getdata()) < 1)
           {
            $this->addFlash(
                'notice',
                'the amount shoud be greater than dollar doesn t exist'
            );
            return $this->render('transactions/new.html.twig', [
                'transaction' => $transaction,
                'form' => $form->createView(),
            ]);
           }
            $em = $this->getDoctrine()->getManager();
            $em->persist($transaction);
            $em->flush();

            return $this->redirectToRoute('transactions_index');
        }

        return $this->render('transactions/new.html.twig', [
            'transaction' => $transaction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="transactions_show", methods="GET")
     */
    public function show(Transactions $transaction): Response
    {
        return $this->render('transactions/show.html.twig', ['transaction' => $transaction]);
    }

    /**
     * @Route("/{id}/edit", name="transactions_edit", methods="GET|POST")
     */
    public function edit(Request $request, Transactions $transaction): Response
    {
        $form = $this->createForm(TransactionsType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('transactions_edit', ['id' => $transaction->getId()]);
        }

        return $this->render('transactions/edit.html.twig', [
            'transaction' => $transaction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="transactions_delete", methods="DELETE")
     */
    public function delete(Request $request, Transactions $transaction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transaction->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($transaction);
            $em->flush();
        }

        return $this->redirectToRoute('transactions_index');
    }
}
