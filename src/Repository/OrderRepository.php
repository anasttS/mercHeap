<?php


namespace App\Repository;


use App\Entity\OrderUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method OrderUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderUser[]    findAll()
 * @method OrderUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct()
    {
        parent::__construct();
    }

}