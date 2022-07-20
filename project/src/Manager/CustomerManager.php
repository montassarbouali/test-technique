<?php
namespace App\Manager;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CustomerManager
 *
 * @package App\Manager\CustomerManager
 */
class CustomerManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * @param EntityManagerInterface $em
     * @param CustomerRepository     $customerRepository
     */
    public function __construct(EntityManagerInterface $em, CustomerRepository $customerRepository)
    {
        $this->em = $em;
        $this->customerRepository = $customerRepository;
    }

    /**
     * Return all customers
     *
     * @return array
     */
    public function findAllCustomers(): array
    {
        return $this->customerRepository->findAll();
    }

    /**
     * Find a customer by id
     *
     * @param string $customerId
     * @return Customer|null
     */
    public function findCustomerById(string $customerId)
    {
        return $this->customerRepository->findOneBy(['id'=> $customerId]);
    }

    /**
     * Create a customer
     *
     * @param array $argument
     * @return Customer
     */
    public function creatCustomer(array $argument)
    {
        $customer = new Customer();
        $dateCreate = new \DateTime('now');
        $customer
            ->setFirstName($argument['firstName'])
            ->setLastName($argument['lastName'])
            ->setEmail($argument['email'])
            ->setPhoneNumber($argument['phoneNumber'])
            ->setCreateDate($dateCreate);

        $this->em->persist($customer);
        $this->em->flush();

        return $customer;
    }

    /**
     * Update a customer
     *
     * @param Customer $customer
     * @return void
     */
    public function updateCustomer(Customer $customer)
    {
        $customer->setUpdateDate(new \DateTime('now'));

        $this->em->persist($customer);
        $this->em->flush();

        return $customer;
    }

    /**
     * Remove a customer
     *
     * @param Customer $customer
     * @return void
     */
    public function disabledCustomer(Customer $customer)
    {
        $this->em->remove($customer);
        $this->em->flush();
    }
}