<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 *
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Game $entity, bool $flush = true): void
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
    public function remove(Game $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findAllCreatedByUserId($id_user)
    {
        return $this->createQueryBuilder('g')
            ->join('g.userId', 'u')
            ->where('u.id = :id_user')
            ->setParameter('id_user', $id_user)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findFirstCurrentByUserId($id_user)
    {
        return $this->createQueryBuilder('g')
            ->join('g.userId', 'u')
            ->where('u.id = :id_user AND gs.statusName = :status')
            ->leftJoin('g.gameStatus', 'gs')
            ->setParameters(['id_user' => $id_user, 'status' => 'current'])
            ->orderBy('g.id', 'ASC')
            ->addOrderBy('g.gameStatus')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findFirstNextByUserId($id_user)
    {
        return $this->createQueryBuilder('g')
            ->join('g.userId', 'u')
            ->where('u.id = :id_user AND gs.statusName = :status')
            ->leftJoin('g.gameStatus', 'gs')
            ->setParameters(['id_user' => $id_user, 'status' => 'soon'])
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Game[] Returns an array of Game objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Game
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
