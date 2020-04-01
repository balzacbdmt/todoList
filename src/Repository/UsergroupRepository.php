<?php

namespace App\Repository;

use App\Entity\Usergroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Usergroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usergroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usergroup[]    findAll()
 * @method Usergroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsergroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usergroup::class);
    }

     /**
      * @return Usergroup[] Returns an array of Usergroup objects
      */
    public function findAllUG()
    {
        $ugReq = $this->createQueryBuilder('u')
        ->getQuery()
        ->getResult();

        foreach ($ugReq as $ug){
            $arrayUsers = $ug->getUsers()->getValues();
            $ug->setUsers($arrayUsers);
        }

        return $ugReq;
    }

    /*
    public function findOneBySomeField($value): ?Usergroup
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
