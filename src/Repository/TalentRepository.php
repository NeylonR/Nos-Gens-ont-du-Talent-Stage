<?php

namespace App\Repository;

use App\Entity\Talent;
use App\Data\FilterData;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Talent>
 *
 * @method Talent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Talent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Talent[]    findAll()
 * @method Talent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TalentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Talent::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Talent $entity, bool $flush = true): void
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
    public function remove(Talent $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return Talent Returns an array of Talent objects
     */
    public function findFilter(FilterData $filter): array
    {
        $query = $this->createQueryBuilder('talent')
        ->select('talent')
        ->join('talent.talentCategory', 'category')
        ->orderBy('talent.firstName', 'ASC')
        ;

        if(!empty($filter->categories)){
            $query = $query->andWhere('category.id IN (:categories)')
            ->setParameter('categories', $filter->categories);
        }
        // dd($query->getQuery());
        return $query->getQuery()->getResult();
    }

    /**
     * @return Talent Returns an array of Talent objects
     */
    public function findFilterOurTalent(FilterData $filter): array
    {
        $query = $this->createQueryBuilder('talent')
        ->select('talent')
        ->join('talent.talentCategory', 'category')
        ->orderBy('talent.firstName', 'ASC')
        ->where('talent.ourTalent = true')
        ;

        if(!empty($filter->categories)){
            $query = $query->andWhere('category.id IN (:categories)')
            ->setParameter('categories', $filter->categories)
            ;
        }

        return $query->getQuery()->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Talent
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
