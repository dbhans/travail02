<?php

namespace App\Controller;

use App\Entity\Accounts;
use App\Entity\Customers;
use App\Form\AccountsType;
use App\Repository\AccountsRepository;
use App\Repository\CustomersRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/accounts")
 */
class AccountsController extends AbstractController
{
    /**
     * @Route("/", name="accounts_index", methods="GET")
     */
    public function index(AccountsRepository $accountsRepository): Response
    {
        return $this->render('accounts/index.html.twig', ['accounts' => $accountsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="accounts_new", methods="GET|POST")
     */
    public function new(Request $request,CustomersRepository $customersRepository): Response
    {
        $account = new Accounts();
        $form = $this->createForm(AccountsType::class, $account);
        $form->handleRequest($request);
        $errors = array('Customer ID');
        if ($form->isSubmitted() && $form->isValid()) {
           if ($customersRepository->find($form['customer']->getdata())== null)
           {
            $this->addFlash(
                'notice',
                'this customer doesn t exist'
            );
            return $this->render('accounts/new.html.twig', [
                'account' => $account,
                'form' => $form->createView(),
            ]);
           }
            $em = $this->getDoctrine()->getManager();
            $em->persist($account);
            $em->flush();

            return $this->redirectToRoute('accounts_index');
        }

        return $this->render('accounts/new.html.twig', [
            'account' => $account,
            'form' => $form->createView(),
        ]);
    }

        /**
     * @Route("/new/{id}", name="customer_accounts", methods="GET|POST")
     */
    public function newcust(Request $request, Customers $customer): Response
    {
        $account = new Accounts();
        $form = $this->createForm(AccountsType::class, $account);
        $form['customer']->setdata($customer->getId());
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
           
            $em = $this->getDoctrine()->getManager();
            $em->persist($account);
            $em->flush();

            return $this->redirectToRoute('accounts_index');
        }

        return $this->render('accounts/new.html.twig', [
            'account' => $account,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="accounts_show", methods="GET")
     */
    public function show(Accounts $account): Response
    {
        return $this->render('accounts/show.html.twig', ['account' => $account]);
    }

    /**
     * @Route("/{id}/edit", name="accounts_edit", methods="GET|POST")
     */
    public function edit(Request $request, Accounts $account): Response
    {
        $form = $this->createForm(AccountsType::class, $account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accounts_edit', ['id' => $account->getId()]);
        }

        return $this->render('accounts/edit.html.twig', [
            'account' => $account,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="accounts_delete", methods="DELETE")
     */
    public function delete(Request $request, Accounts $account): Response
    {
        if ($this->isCsrfTokenValid('delete'.$account->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($account);
            $em->flush();
        }

        return $this->redirectToRoute('accounts_index');
    }

    /**
     * @Route("/balanceenquiry/{idcustomer}", name="customer_accounts", methods="GET|POST")
     */
    public function Balanceenquiry(Request $request,$idcustomer, AccountsRepository $accountsRepository): Response
    {       
        return $this->render('accounts/balanceenquiry.html.twig', ['accounts' => $accountsRepository->findByCustomer($idcustomer)]);
           
    }
}
