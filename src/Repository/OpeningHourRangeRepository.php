<?php

namespace App\Repository;

use App\Entity\OpeningHourRange;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OpeningHourRange>
 *
 * @method OpeningHourRange|null find($id, $lockMode = null, $lockVersion = null)
 * @method OpeningHourRange|null findOneBy(array $criteria, array $orderBy = null)
 * @method OpeningHourRange[]    findAll()
 * @method OpeningHourRange[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpeningHourRangeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OpeningHourRange::class);
    }

    public function save(OpeningHourRange $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OpeningHourRange $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getOpenDays(): array
    {
        $openingHourRanges = $this->findAll();
        $openDays = [];
        foreach ($openingHourRanges as $openingHourRange){
            $openDays[] = $openingHourRange->getDay();
        }
        return array_unique($openDays);
    }
//    /**
//     * @return OpeningHourRange[] Returns an array of OpeningHourRange objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OpeningHourRange
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
