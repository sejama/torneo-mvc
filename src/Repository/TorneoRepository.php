<?php

namespace App\Repository;

use App\Entity\Torneo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Torneo>
 */
class TorneoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Torneo::class);
    }

    public function findAll(): array
    {
        return $this->findBy([], ['id' => 'ASC']);
    }

    public function findAllByUsuario(int $usuarioId): array
    {
        return $this->findBy(['usuario' => $usuarioId], ['id' => 'ASC']);
    }

    public function findOneByRuta(string $ruta): ?Torneo
    {
        return $this->findOneBy(['ruta' => $ruta]);
    }

    //    /**
    //     * @return Torneo[] Returns an array of Torneo objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Torneo
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
