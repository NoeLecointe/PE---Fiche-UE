<?php

namespace App\Repository;

use App\Entity\Name;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Name>
 *
 * @method Name|null find($id, $lockMode = null, $lockVersion = null)
 * @method Name|null findOneBy(array $criteria, array $orderBy = null)
 * @method Name[]    findAll()
 * @method Name[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Name::class);
    }

    public function save(Name $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Name $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function detail_name(int $id):array {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT activite.id_act, competence.id, competence.nom_competence, name.notion, name.application, name.maitrise, name.expertise
        FROM activite INNER JOIN competence ON activite.id = competence.id_activite_id
        INNER JOIN name ON competence.id = name.id_competence_id
        WHERE name.code_ue_id = ?';
        $stmt = $conn->prepare($sql);
        $res = $stmt->executeQuery(array($id));
        $donnees = $res->fetchAllAssociative();

        return $donnees;
    }

    public function detail_name_attente(int $id):array {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT activite.id_act, competence.id, competence.nom_competence, name.notion, name.application, name.maitrise, name.expertise
        FROM activite INNER JOIN competence ON activite.id = competence.id_activite_id
        INNER JOIN name ON competence.id = name.id_competence_id
        WHERE name.fiche_ue_attente_id = ?';
        $stmt = $conn->prepare($sql);
        $res = $stmt->executeQuery(array($id));
        $donnees = $res->fetchAllAssociative();

        return $donnees;
    }

    public function add_name($attente, $ue_id, $com_id, $n, $a, $m, $e):void {
        if ($attente == 'oui') {
            $conn = $this->getEntityManager()->getConnection();

            $sql = '
            INSERT INTO name (`id_competence_id`, `fiche_ue_attente_id`, `notion`, `application`, `maitrise`, `expertise`)
            VALUES (?, ?, ?, ?, ?, ?)';
            $stmt = $conn->prepare($sql);
            $stmt->executeQuery(array($com_id, $ue_id, $n, $a, $m, $e));
        } else if ($attente == 'non') {
            # code...
        }
    }

    public function change_name($attente, $ue_id, $com_id, $n, $a, $m, $e):void {
        if ($attente == 'oui') {
                $conn = $this->getEntityManager()->getConnection();

                $sql = '
                UPDATE name 
                SET notion = ?, application = ?, maitrise = ?, expertise = ? 
                WHERE id_competence_id = ? AND fiche_ue_attente_id = ?
                ';

                $stmt = $conn->prepare($sql);
                $stmt->executeQuery(array($n, $a, $m, $e, $com_id, $ue_id));
        } else if ($attente == 'non') {
            # code...
        }
    }

    public function delete_name($attente, $ue_id, $com_id): void {
        if ($attente == 'oui') {
            $conn = $this->getEntityManager()->getConnection();
            $sql = '
            DELETE FROM name 
            WHERE id_competence_id = ? AND fiche_ue_attente_id = ?
            ';
            $stmt = $conn->prepare($sql);
            $stmt->executeQuery(array($com_id, $ue_id));
        } else if ($attente == 'non') {
            # code...
        }
    }

//    /**
//     * @return Name[] Returns an array of Name objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Name
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
