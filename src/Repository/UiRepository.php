<?php

namespace App\Repository;

use App\Entity\Ui;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ui>
 *
 * @method Ui|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ui|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ui[]    findAll()
 * @method Ui[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ui::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Ui $entity, bool $flush = true): void
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
    public function remove(Ui $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // Retourne la liste des uidata selon l'id d'un utilisateur
    public function findAllByIdUser($user_id)
    {
        return $this->createQueryBuilder('ui')
            ->join('ui.uiUserId', 'u')
            ->where('u.id = :user_id')
            ->setParameter('user_id', $user_id)
            ->orderBy('ui.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
       
    }

    // /**
    //  * @return Ui[] Returns an array of Ui objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ui
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
