<?php

namespace App\Repository;

use App\Entity\MetaOverlays;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MetaOverlays>
 *
 * @method MetaOverlays|null find($id, $lockMode = null, $lockVersion = null)
 * @method MetaOverlays|null findOneBy(array $criteria, array $orderBy = null)
 * @method MetaOverlays[]    findAll()
 * @method MetaOverlays[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetaOverlaysRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MetaOverlays::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(MetaOverlays $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(MetaOverlays $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return MetaOverlays[] Returns an array of MetaOverlays objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MetaOverlays
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
