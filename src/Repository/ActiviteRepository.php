<?php

namespace App\Repository;

use App\Entity\Activite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Activite>
 *
 * @method Activite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activite[]    findAll()
 * @method Activite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activite::class);
    }

    public function save(Activite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Activite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getActivite(): array {
        $conn = $this->getEntityManager()->getConnection();
                    
        $sql = '
        SELECT activite.id_act, activite.nom, formation.accronym_Forma
        FROM activite
        LEFT OUTER JOIN formation ON activite.id_formation_id = formation.id
        ';

        $stmt = $conn->prepare($sql);
        $comp = $stmt->executeQuery();
        $donnees = $comp->fetchAllAssociative();


        return $donnees;
    }

    public function getActiviteFormation($accro): array {
        $donnees = $this->getActivite();
        
        foreach ($donnees as $key => $d) {
            if($d['accronym_Forma'] != $accro && $d['accronym_Forma'] != NULL) {
                unset($donnees[$key]);
            }
        }
        return $donnees;
    }

//    /**
//     * @return Activite[] Returns an array of Activite objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Activite
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
