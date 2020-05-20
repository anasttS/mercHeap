<?php


namespace App\Repository;


use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
// * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findAll(){
//        все по алфавиту
//        $dql = 'SELECT product FROM  App\Entity\Product product ORDER BY product.name DESC';
//        $query = $this->getEntityManager()->createQuery($dql);
       $qb = $this->createQueryBuilder('product')
           ->addOrderBy('product.name', 'ASC');
        $query = $qb->getQuery();
        return $query->execute();
    }

    public function findEntitiesByString($requestString)
    {
        return $this->createQueryBuilder('product')
        ->andWhere('product.name LIKE :searchTerm')
        ->setParameter('searchTerm', '%'.$requestString.'%')
        ->orderBy('product.name', 'ASC')
        ->getQuery()
        ->getResult();
    }

}