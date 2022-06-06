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

    /**
    * @return Overlay[] Returns an array of Overlay objects
    */
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

    // Retourne la liste des personnes qui possèdent au minimum un overlay contenant des widgets
    public function findAllUsersOwned()
    {
        return $this->createQueryBuilder('o')
            ->join('o.widgetOwner', 'u')
            ->orderBy('o.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
       
    }

    // Retourne la liste des overlays selon l'id d'un utilisateur
    public function findAllByIdUser($user_id)
    {
        return $this->createQueryBuilder('o')
            ->join('o.widgetOwner', 'u')
            ->where('u.id = :user_id')
            ->setParameter('user_id', $user_id)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
       
    }

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
