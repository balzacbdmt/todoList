<?php

namespace App\Repository;

use App\Entity\Todo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Todo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Todo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Todo[]    findAll()
 * @method Todo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TodoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Todo::class);
    }

     /**
      * @return Todo[] Returns an array of Todo objects
      */
    
    public function getTodoList(Array $arrayGroups)
    {
        $todos = $this->createQueryBuilder('t')
        ->orderBy('t.deadline', 'ASC')
        ->getQuery()
        ->getResult();

        foreach ($todos as $t){
            $arrayLabels = $t->getLabels()->getValues();
            $t->setLabels($arrayLabels);

            foreach ($arrayGroups as $ug){
                if ($ug == $t->getUsergroups()) {
                    $t->setUsergroups($ug);
                }
            }
        }

        return $todos;
    }

    /*
    public function findOneBySomeField($value): ?Todo
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
