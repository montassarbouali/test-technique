<?php
namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Manager\CustomerManager;
use App\Manager\LinkManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CustomerController
 *
 * @package App\Controller\CustomerController
 */
class CustomerController extends AbstractController
{
    /**
     * @param CustomerManager $customerManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function find(CustomerManager $customerManager)
    {
        $customers = $customerManager->findAllCustomers();
        return $this->render('customer/index.html.twig', [
            'customers' => $customers
            ]
        );
    }

    /**
     * @param Request         $request
     * @param CustomerManager $customerManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request, CustomerManager $customerManager)
    {
        $form = $this->createForm(CustomerType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $customerManager->creatCustomer($form->getData());
            $this->addFlash('success', 'customer successfully created');
            return $this->redirectToRoute('app_customer_index');
        }

        return $this->render(
            'customer/create.html.twig',
            [
                'title' => "Ajout d'un nouveau client",
                'myform' => $form->createView(),
                'errors' => ''
            ]
        );
    }

    /**
     * @param Request         $request
     * @param CustomerManager $customerManager
     * @param Customer        $customer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, CustomerManager $customerManager, Customer $customer)
    {
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $customerManager->updateCustomer($form->getData());
            $this->addFlash('success', 'customer successfully updated');
            return $this->redirectToRoute('app_customer_index');
        }

        return $this->render(
            'customer/create.html.twig',
            [
                'title' => 'Modifier les information du client',
                'subtitle' => '',
                'myform' => $form->createView(),
                'customer' =>  $customer,
                'errors' => ''
            ]
        );
    }

    /**
     * @param Customer        $customer
     * @param CustomerManager $customerManager
     * @param LinkManager     $linkManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function disabled(Customer $customer,
                             CustomerManager $customerManager,
                             LinkManager $linkManager)
    {
        $linkManager->disabledLinkByArgument((string) $customer->getId(), 'customer');
        $customerManager->disabledCustomer($customer);
        $this->addFlash('success', 'customer successfully disabled');
        return $this->redirectToRoute('app_customer_index');
    }
}
