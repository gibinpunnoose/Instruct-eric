<?php

namespace App\Repository;

use App\Entity\Services;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Services>
 *
 * @method Services|null find($id, $lockMode = null, $lockVersion = null)
 * @method Services|null findOneBy(array $criteria, array $orderBy = null)
 * @method Services[]    findAll()
 * @method Services[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServicesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Services::class);
    }

    public function getServices(string $pattern = null)
    {

        return $this->getEntityManager()
            ->createQueryBuilder('s')
            ->select('ser.ref,ser.country')
            ->from('App\Entity\services', 'ser')
            ->where('ser.ref = ref')
            ->getQuery()
            ->getArrayResult();
    }

    public function getServicesSummary(): array
    {

        return $this->createQueryBuilder('s')
            ->select('s.country, COUNT(s.id) as totalServices')
            ->groupBy('s.country')
            ->getQuery()
            ->getResult();
    }

}
