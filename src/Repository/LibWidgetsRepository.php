<?php

namespace App\Repository;

use App\Entity\LibWidgets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<LibWidgets>
 *
 * @method LibWidgets|null find($id, $lockMode = null, $lockVersion = null)
 * @method LibWidgets|null findOneBy(array $criteria, array $orderBy = null)
 * @method LibWidgets[]    findAll()
 * @method LibWidgets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LibWidgetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, LibWidgets::class);
        $this->entityManager = $entityManager;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(LibWidgets $entity, bool $flush = true): void
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
    public function remove(LibWidgets $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findAllByOverlay($idOverlay)
    {
        return $this->createQueryBuilder('l')
            ->leftJoin('l.widgets', 'w')
            ->leftJoin('w.overlay', 'o')
            ->where('o.id = :id_overlay')
            ->setParameter('id_overlay', $idOverlay)
            ->getQuery()
            ->getResult();
    }

    // public function findOne()
    // {
    //     $query = $this->entityManager->createQuery(
    //         'SELECT lw
    //         FROM App\Entity\LibWidgets lw
    //         WHERE lw.id = :id_libwidget'
    //     );
    //     $query->setParameter('id_libwidget', 1);

    //     // returns an array of Product objects
    //     return $query->getResult();
    // }

    // /**
    //  * @return LibWidgets[] Returns an array of LibWidgets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LibWidgets
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
