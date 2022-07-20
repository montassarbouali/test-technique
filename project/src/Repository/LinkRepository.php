<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Entity\Link;
use App\Entity\Material;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Link>
 *
 * @method Link|null find($id, $lockMode = null, $lockVersion = null)
 * @method Link|null findOneBy(array $criteria, array $orderBy = null)
 * @method Link[]    findAll()
 * @method Link[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Link::class);
    }

    /**
     * list all links by fields (countMateriel, sumPrice)
     *
     * @return mixed
     */
    public function findByCriteria()
    {
        return $this->createQueryBuilder('l')
            ->innerJoin(Customer::class, 'c','WITH', 'c.id = l.customer')
            ->innerJoin(Material::class, 'm','WITH', 'm.id = l.material')
            ->select('c.firstName, c.lastName,c.email, c.phoneNumber, SUM(m.price) as sumPrice, COUNT(l.material) as countMateriel')
            ->groupBy('c.id')
            ->having('countMateriel >= 30')
            ->andHaving('sumPrice >= 30000')
            ->orderBy('c.id')
            ->getQuery()
            ->getResult();
    }

    /**
     * find all prices
     *
     * @return mixed
     */
    public function findAllPrices()
    {
        return $this->createQueryBuilder('l')
            ->innerJoin(Customer::class, 'c','WITH', 'c.id = l.customer')
            ->innerJoin(Material::class, 'm','WITH', 'm.id = l.material')
            ->select('c.firstName, c.lastName,c.email, c.phoneNumber, SUM(m.price) as sumPrice, COUNT(l.material) as countMateriel')
            ->groupBy('c.id')
            ->orderBy('c.id')
            ->getQuery()
            ->getResult();
    }
}
