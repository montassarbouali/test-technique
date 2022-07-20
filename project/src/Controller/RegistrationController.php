<?php
namespace App\Controller;

use App\Manager\LinkManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class RegistrationController
 *
 * @package App\Controller\RegistrationController
 */
class RegistrationController extends AbstractController
{
    /**
     * @param LinkManager $linkManger
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(LinkManager $linkManager)
    {
        $registrations = $linkManager->findCustomerByCriteria();
        return $this->render('registrationOfMaterial/index_registration.html.twig',
            [
                'registrations' => $registrations
            ]
        );
    }


    public function filterRegistration(LinkManager $linkManager)
    {
        $registrations = $linkManager->findAllPrices();
        $goldCustomer = $linkManager->findGoldCustomer();
        return $this->render('registrationOfMaterial/registration.html.twig',
            [
                'registrations' => $registrations,
                'goldCustomer' => $goldCustomer
            ]
        );
    }
}
