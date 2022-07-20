<?php
namespace App\Manager;

use App\Entity\Material;
use App\Repository\MaterialRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * class MaterialManager
 *
 * @package App\Manager\MaterialManager
 */
class MaterialManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var MaterialRepository
     */
    private $materialRepository;

    /**
     * @param EntityManagerInterface $em
     * @param MaterialRepository     $materialRepository
     */
    public function __construct(EntityManagerInterface $em, MaterialRepository $materialRepository)
    {
        $this->em = $em;
        $this->materialRepository = $materialRepository;
    }

    /**
     * find all materials
     *
     * @return array
     */
    public function findAllMaterials(): array
    {
        return $this->materialRepository->findAll();
    }

    /**
     * find material by id
     *
     * @param string $materialId
     * @return Material|null
     */
    public function findMaterialById(string $materialId)
    {
        return $this->materialRepository->findOneBy(['id' => $materialId]);
    }

    /**
     * Create a material
     *
     * @param array $argument
     * @return Material
     */
    public function creatMaterial(array $argument)
    {
        $material = new Material();
        $material
            ->setName($argument['name'])
            ->setPrice($argument['price'])
            ->setCategory($argument['category'])
            ->setReference($argument['reference']);

        $this->em->persist($material);
        $this->em->flush();

        return $material;
    }

    /**
     * Update a material
     *
     * @param Material $material
     * @return Material
     */
    public function updateMaterial(Material $material)
    {
        $this->em->flush($material);

        return $material;
    }

    /**
     * Disable a material
     *
     * @param Material $material
     * @return void
     */
    public function disabledMaterial(Material $material)
    {
        $this->em->remove($material);
        $this->em->flush();
    }
}