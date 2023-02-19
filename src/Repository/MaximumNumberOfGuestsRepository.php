<?php

namespace App\Repository;

use App\Entity\MaximumNumberOfGuests;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MaximumNumberOfGuests>
 *
 * @method MaximumNumberOfGuests|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaximumNumberOfGuests|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaximumNumberOfGuests[]    findAll()
 * @method MaximumNumberOfGuests[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaximumNumberOfGuestsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaximumNumberOfGuests::class);
    }

    public function save(MaximumNumberOfGuests $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MaximumNumberOfGuests $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MaximumNumberOfGuests[] Returns an array of MaximumNumberOfGuests objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MaximumNumberOfGuests
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
