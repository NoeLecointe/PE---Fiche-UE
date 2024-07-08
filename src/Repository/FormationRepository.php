<?php

namespace App\Repository;

use App\Entity\Formation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Formation>
 *
 * @method Formation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formation[]    findAll()
 * @method Formation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formation::class);
    }

    public function save(Formation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Formation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function formations(): array {
        $conn = $this->getEntityManager()->getConnection();
    
        $sql = '
        SELECT *
        FROM formation
        ';
        $stmt = $conn->prepare($sql);
        $res = $stmt->executeQuery();
        $donnees = $res->fetchAllAssociative();

        return $donnees;
    }

    public function formationUEattente(int $id): array {
        $conn = $this->getEntityManager()->getConnection();
    
        $sql = '
        SELECT formation.id, formation.nom_formation, formation.accronym_Forma
        FROM formation INNER JOIN formation_fiche_ueattente ON formation.id = formation_fiche_ueattente.formation_id
        WHERE formation_fiche_ueattente.fiche_ueattente_id = ?;
        ';
        $stmt = $conn->prepare($sql);
        $res = $stmt->executeQuery(array($id));
        $donnees = $res->fetchAllAssociative();

        return $donnees;
    }

    public function formationUE(int $id): array {
        $conn = $this->getEntityManager()->getConnection();
    
        $sql = '
        SELECT formation.id, formation.nom_formation, formation.accronym_Forma
        FROM formation INNER JOIN formation_fiche_ue ON formation.id = formation_fiche_ue.formation_id
        WHERE formation_fiche_ue.fiche_ue_id = ?;
        ';
        $stmt = $conn->prepare($sql);
        $res = $stmt->executeQuery(array($id));
        $donnees = $res->fetchAllAssociative();

        return $donnees;
    }

//    /**
//     * @return Formation[] Returns an array of Formation objects
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

//    public function findOneBySomeField($value): ?Formation
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
