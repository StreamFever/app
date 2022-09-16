<?php

namespace App\Repository;

use App\Entity\Social;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Social>
 *
 * @method Social|null find($id, $lockMode = null, $lockVersion = null)
 * @method Social|null findOneBy(array $criteria, array $orderBy = null)
 * @method Social[]    findAll()
 * @method Social[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SocialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Social::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Social $entity, bool $flush = true): void
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
    public function remove(Social $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // INFO: Retourne la liste des "Social" dont l'utilisateur a accès et ceux dont il est propriétaire
    public function findByIdUser($id_user) {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.socialAccess', 'u1')
            ->where('u1 = :id_user OR s.userId = :id_user')
            ->setParameter('id_user', $id_user)
            ->orderBy('s.socialLib', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // INFO: Retourne la liste des "Social" dont l'utilisateur a accès
    public function findByAccessUser($id_user) {
        return $this->createQueryBuilder('s')
            ->join('s.socialAccess', 'u1')
            ->where('u1.id = :id_user')
            ->setParameter('id_user', $id_user)
            ->orderBy('s.socialLib', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // INFO: Retourne la liste des "Social" dont l'utilisateur est propriétaire
    public function findByOwnerUser($id_user) {
        return $this->createQueryBuilder('s')
            ->join('s.userId', 'u1')
            ->where('u1.id = :id_user')
            ->setParameter('id_user', $id_user)
            ->orderBy('s.socialLib', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Social[] Returns an array of Social objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Social
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}