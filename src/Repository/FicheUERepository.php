<?php

namespace App\Repository;

use App\Entity\FicheUE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FicheUE>
 *
 * @method FicheUE|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheUE|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheUE[]    findAll()
 * @method FicheUE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheUERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheUE::class);
    }

    public function save(FicheUE $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FicheUE $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function list(): array 
    {
        $conn = $this->getEntityManager()->getConnection();
    
        $sql = '
        SELECT fiche_ue.id, code_ue, nom_ue, categorie_ue, periode, credits, nom_formation 
        FROM fiche_ue 
        INNER JOIN formation_fiche_ue ON fiche_ue.id = formation_fiche_ue.fiche_ue_id 
        INNER JOIN formation ON formation.id = formation_fiche_ue.formation_id;
        ';
        $stmt = $conn->prepare($sql);

        $ue = $stmt->executeQuery();

        return $ue->fetchAllAssociative();
    }

    public function fiche_UE($code): array {
        $conn = $this->getEntityManager()->getConnection();
    
        $sql = '
        SELECT *
        FROM fiche_ue
        WHERE code_ue = ?;
        ';
        $stmt = $conn->prepare($sql);
        $res = $stmt->executeQuery(array($code));
        $donnees = $res->fetchAllAssociative();

        $donnees = $donnees[0];

        return $donnees;
    }



//    /**
//     * @return FicheUE[] Returns an array of FicheUE objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FicheUE
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
