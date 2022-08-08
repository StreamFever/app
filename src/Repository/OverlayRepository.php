<?php

namespace App\Repository;

use App\Entity\Overlay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Overlay>
 *
 * @method Overlay|null find($id, $lockMode = null, $lockVersion = null)
 * @method Overlay|null findOneBy(array $criteria, array $orderBy = null)
 * @method Overlay[]    findAll()
 * @method Overlay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OverlayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Overlay::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Overlay $entity, bool $flush = true): void
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
    public function remove(Overlay $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // INFO: Retourne la liste des "Overlay" dont l'utilisateur a accès et ceux dont il est propriétaire
    public function findByIdUser($id_user) {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.OverlayAccess', 'u1')
            ->where('u1 = :id_user OR o.OverlayOwner = :id_user')
            ->setParameter('id_user', $id_user)
            ->orderBy('o.OverlayName', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // INFO: Retourne la liste des "Overlay" dont l'utilisateur a accès
    public function findByAccessUser($id_user) {
        return $this->createQueryBuilder('o')
            ->join('o.OverlayAccess', 'u1')
            ->where('u1.id = :id_user')
            ->setParameter('id_user', $id_user)
            ->orderBy('o.OverlayName', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // INFO: Retourne la liste des "Overlay" dont l'utilisateur est propriétaire
    public function findByOwnerUser($id_user) {
        return $this->createQueryBuilder('e')
            ->join('o.OverlayOwner', 'u1')
            ->where('u1.id = :id_user')
            ->setParameter('id_user', $id_user)
            ->orderBy('o.OverlayName', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // INFO: Retourne les trois derniers des "Overlay" dont l'utilisateur a accès et ceux dont il est propriétaire
    public function findLastByIdUser($id_user) {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.OverlayAccess', 'u1')
            ->where('u1 = :id_user OR o.OverlayOwner = :id_user')
            ->setParameter('id_user', $id_user)
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Overlay[] Returns an array of Overlay objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Overlay
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
