<?php

namespace App\Manager;

use App\Entity\Link;
use App\Entity\Material;
use App\Repository\LinkRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class LinkManager
 *
 * @package App\Manager\LinkManager
 */
class LinkManager
{
    /**
     * @var LinkRepository
     */
    private $linkRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var CustomerManager
     */
    private $customerManager;

    /**
     * @var MaterialManager
     */
    private $materialManager;

    /**
     * @param LinkRepository $linkRepository
     * @param EntityManagerInterface $em
     * @param CustomerManager $customerManager
     * @param MaterialManager $materialManager
     */
    public function __construct(LinkRepository         $linkRepository,
                                EntityManagerInterface $em,
                                CustomerManager        $customerManager,
                                MaterialManager        $materialManager
    )
    {
        $this->linkRepository = $linkRepository;
        $this->em = $em;
        $this->customerManager = $customerManager;
        $this->materialManager = $materialManager;
    }

    /**
     * Save a links
     *
     * @param array $argument
     * @return void
     */
    public function saveLinks(array $argument)
    {
        $customer = $this->customerManager->findCustomerById($argument['customer_id']);
        if (strpos(',', $argument['purchase_material']) !== false) {
            $materialIds = explode(',', $argument['purchase_material']);
        } else {
            $materialIds = [$argument['purchase_material']];
        }

        foreach ($materialIds as $materialId) {
            $link = new Link();
            $material = $this->materialManager->findMaterialById($materialId);

            if ($material instanceof Material) {
                $link
                    ->setCustomer($customer)
                    ->setMaterial($material);
                $this->em->persist($link);
            }
        }
        $this->em->flush();

    }

    /**
     * @param string $customerId
     * @return Link[]
     */
    public function findLinksByClientId(string $customerId)
    {
        return $this->linkRepository->findBy(['customer' => $customerId]);
    }

    /**
     * @return Link[]|float|int|mixed|string
     */
    public function findCustomerByCriteria()
    {
        return $this->linkRepository->findByCriteria();
    }

    /**
     * find all prices
     *
     * @return mixed
     */
    public function findAllPrices()
    {
        return $this->linkRepository->findAllPrices();
    }

    /**
     * @return Link|mixed|string
     */
    public function findGoldCustomer()
    {
        $customers = $this->findAllPrices();
        if (count($customers) > 0) {
            $goldCustomer = $customers[0];
            foreach ($customers as $k => $customer) {
                if ($k > 0 && $k < (count($customers) - 1)) {
                    if ($customer[$k]['sumPrice'] > $customer[$k - 1]['sumPrice']) {
                        $goldCustomer = $customer[$k];
                    }
                }
            }
            return $goldCustomer;
        }
    }

    /**
     * Disable a link by argument
     *
     * @param string $argument
     * @param string $column
     * @return void
     */
    public function disabledLinkByArgument(string $argument, string $column)
    {
        if ($column === 'customer') {
            $links = $this->findLinksByClientId($argument);
        } else {
            $links = $this->linkRepository->findBy(['material' => $argument]);
        }

        foreach ($links as $link) {
            $this->em->remove($link);
        }
        $this->em->flush();

    }
}

