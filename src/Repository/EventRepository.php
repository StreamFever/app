<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 *
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Event $entity, bool $flush = true): void
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
    public function remove(Event $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findAll()
    {
        return $this->findBy(array(), array('eventStartDate' => 'ASC'));
    }

    // INFO: Retourne la liste des "Events" dont l'utilisateur a accès et ceux dont il est propriétaire
    public function findByIdUser($id_user) {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.eventAccess', 'u1')
            ->where('u1 = :id_user OR e.userId = :id_user')
            ->setParameter('id_user', $id_user)
            ->orderBy('e.eventStartDate', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // INFO: Retourne la liste des "Events" dont l'utilisateur a accès
    public function findByAccessUser($id_user) {
        return $this->createQueryBuilder('e')
            ->join('e.eventAccess', 'u1')
            ->where('u1.id = :id_user')
            ->setParameter('id_user', $id_user)
            ->orderBy('e.eventStartDate', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    // INFO: Retourne la liste des "Events" dont l'utilisateur est propriétaire
    public function findByOwnerUser($id_user) {
        return $this->createQueryBuilder('e')
            ->join('e.userId', 'u1')
            ->where('u1.id = :id_user')
            ->setParameter('id_user', $id_user)
            ->orderBy('e.eventStartDate', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findFirst()
    {
        // $date = new \DateTime("NOW");
        // return $this->createQueryBuilder('e')
        //     ->where('e.eventStartDate > :date AND e.overlayId IS NOT NULL')
        //     ->orderBy('e.eventStartDate', 'ASC')
        //     ->setParameter(':date', $date)    
        //     ->setMaxResults(1)
        //     ->getQuery()
        //     ->getResult()
        // ;
        return $this->createQueryBuilder('e')
            ->join('e.userId', 'u')
            ->where('e.overlayId IS NOT NULL')
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findRecentsEvent()
    {
        $date = new \DateTime("NOW");
        
        return $this->createQueryBuilder('e')
            ->where('e.eventStartDate > :date')
            ->orderBy('e.id', 'ASC')    
            ->setParameter(':date', $date)    
            ->setMaxResults(2)
            ->getQuery()
            ->getResult()
        ;
    }

    // public function findAll($id_user)
    // {
    //     return $this->createQueryBuilder('e')
    //         ->join('e.userId', 'u')
    //         ->where('u.id = :id_user')
    //         ->setParameter('id_user', $id_user)
    //         ->orderBy('e.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
       
    // }

    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
