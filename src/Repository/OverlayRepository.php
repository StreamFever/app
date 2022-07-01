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

    // // Retourne la liste des widgets que l'user à accès (même si ce n'est pas le propriétaire) ou qu'il a crée
    // public function findAllOverlaysWhereIdUser($user_id)
    // {
    //     return $this->createQueryBuilder('o')
    //         ->join('o.WidgetPermission', 'u1')
    //         ->join('o.widgetOwner', 'u2')
    //         ->where('u1.id = :user_id OR u2.id = :user_id')
    //         ->setParameter('user_id', $user_id)
    //         ->orderBy('o.id', 'ASC')
    //         ->getQuery()
    //         ->getResult()
    //     ;
       
    // }

    // // Même utilité que celle au dessus sauf qu'on veut que les 2 derniers
    // public function findLatestOverlaysWhereIdUser($user_id)
    // {
    //     return $this->createQueryBuilder('o')
    //         ->join('o.WidgetPermission', 'u1')
    //         ->join('o.widgetOwner', 'u2')
    //         ->where('u1.id = :user_id OR u2.id = :user_id')
    //         ->setParameter('user_id', $user_id)
    //         ->orderBy('o.id', 'ASC')
    //         ->getQuery()
    //         ->getResult()
    //     ;
       
    // }

    // Retourne la liste des widgets selon l'id d'un utilisateur
    public function findAllByIdUser($user_id)
    {
        return $this->createQueryBuilder('o')
            ->join('o.OverlayOwner', 'u')
            ->where('u.id = :user_id')
            ->setParameter('user_id', $user_id)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
       
    }

    // Même utilité que celle au dessus sauf qu'on veut que les 2 derniers
    public function findLatestOverlaysWhereIdUser($user_id)
    {
        return $this->createQueryBuilder('o')
            ->join('o.OverlayAccess', 'u1')
            ->join('o.OverlayOwner', 'u2')
            ->where('u1.id = :user_id OR u2.id = :user_id')
            ->setParameter('user_id', $user_id)
            ->orderBy('o.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
       
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
