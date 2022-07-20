<?php

namespace App\Entity;

use App\Repository\LinkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Link
 *
 * @package App\Entity\Link
 *
 * @ORM\Table(name="link")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass=LinkRepository::class)
 */
class Link
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Customer
     *
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="material")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * @var Material
     *
     * @ORM\ManyToOne(targetEntity=Material::class, inversedBy="customer")
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id")
     */
    private $material;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime", nullable=true)
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_date", type="datetime", nullable=true)
     */
    private $updateDate;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Link
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     * @return Link
     */
    public function setCustomer(Customer $customer): Link
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return Material
     */
    public function getMaterial(): Material
    {
        return $this->material;
    }

    /**
     * @param Material $material
     * @return Link
     */
    public function setMaterial(Material $material): Link
    {
        $this->material = $material;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate(): \DateTime
    {
        return $this->createDate;
    }

    /**
     * @param \DateTime $createDate
     * @return Link
     */
    public function setCreateDate(\DateTime $createDate): Link
    {
        $this->createDate = $createDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateDate(): \DateTime
    {
        return $this->updateDate;
    }

    /**
     * @param \DateTime $updateDate
     * @return Link
     */
    public function setUpdateDate(\DateTime $updateDate): Link
    {
        $this->updateDate = $updateDate;
        return $this;
    }
}
