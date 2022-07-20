<?php
namespace App\Controller;

use App\Manager\CustomerManager;
use App\Manager\LinkManager;
use App\Manager\MaterialManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PurchaseMaterialController
 *
 * @package App\Controller\PurchaseMaterialController
 */
class PurchaseMaterialController extends AbstractController
{
    /**
     * @param CustomerManager $customerManager
     * @param MaterialManager $materialManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(CustomerManager $customerManager, MaterialManager $materialManager)
    {
        $customers = $customerManager->findAllCustomers();
        $materials = $materialManager->findAllMaterials();

        return $this->render('purchaseMaterial/save.html.twig',
            [
                'customers' => $customers,
                'materials' => $materials
            ]
        );
    }

    /**
     * @param LinkManager $linkManager
     * @param Request     $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function save(LinkManager $linkManager, Request $request)
    {
        try {
            $data = $request->request->all();
            $linkManager->saveLinks($data);
            return $this->redirectToRoute('app_purchase_material');
        } catch (\Exception $exception) {
            return $this->redirectToRoute('app_purchase_material');
        }
    }
}