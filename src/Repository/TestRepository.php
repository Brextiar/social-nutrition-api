<?php

namespace App\Repository;

use App\Entity\Test;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class TestRepository
 *
 * @extends ServiceEntityRepository<Test>
 */
class TestRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Test::class);
    }
}
