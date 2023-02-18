<?php

namespace App\Repository;

use App\Entity\DayOpeningHours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DayOpeningHours>
 *
 * @method DayOpeningHours|null find($id, $lockMode = null, $lockVersion = null)
 * @method DayOpeningHours|null findOneBy(array $criteria, array $orderBy = null)
 * @method DayOpeningHours[]    findAll()
 * @method DayOpeningHours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DayOpeningHoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DayOpeningHours::class);
    }

    public function save(DayOpeningHours $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DayOpeningHours $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DayOpeningHours[] Returns an array of DayOpeningHours objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DayOpeningHours
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
