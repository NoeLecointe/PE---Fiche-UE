<?php

namespace App\Repository;

use App\Entity\FicheUEAttente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FicheUEAttente>
 *
 * @method FicheUEAttente|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheUEAttente|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheUEAttente[]    findAll()
 * @method FicheUEAttente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheUEAttenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheUEAttente::class);
    }

    public function save(FicheUEAttente $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FicheUEAttente $entity, bool $flush = false): void
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
        SELECT fiche_ueattente.id, code_ue, nom_ue, categorie_ue, periode, credits, nom_formation, validation
        FROM fiche_ueattente 
        INNER JOIN formation_fiche_ueattente ON fiche_ueattente.id = formation_fiche_ueattente.fiche_ueattente_id 
        INNER JOIN formation ON formation.id = formation_fiche_ueattente.formation_id
        ORDER BY code_ue;
        ';
        $stmt = $conn->prepare($sql);

        $ue = $stmt->executeQuery();

        return $ue->fetchAllAssociative();
    }

    public function fiche_UE($code): array {
        $conn = $this->getEntityManager()->getConnection();
    
        $sql = '
        SELECT *
        FROM fiche_ueattente 
        WHERE code_ue = ?;
        ';
        $stmt = $conn->prepare($sql);
        $res = $stmt->executeQuery(array($code));
        $donnees = $res->fetchAllAssociative();

        $donnees = $donnees[0];

        return $donnees;
    }

    public function new_fiche($code, $nom, $form):void {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        INSERT INTO fiche_ueattente (`code_ue`, `nom_ue`) VALUES (?, ?)
        ';
        $stmt = $conn->prepare($sql);
        $stmt->executeQuery(array($code, $nom));

        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT id FROM fiche_ueattente WHERE code_ue = ?
        ';
        $stmt = $conn->prepare($sql);
        $res = $stmt->executeQuery(array($code));
        $id = $res->fetchAllAssociative();
        $id = $id[0];

        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        INSERT INTO formation_fiche_ueattente (`formation_id`, `fiche_ueattente_id`) VALUES (?,?) 
        ';
        $stmt = $conn->prepare($sql);
        $stmt->executeQuery(array($form, $id['id']));
    }

    public function modif_fiche($code, $nom, $cat, $periode, $cible, $credits, $cm, $td, $tp, $the, $projet, $antecedent, $fr, $anglais, $modalite, $acquis, $savoir, $techniques, $alternance, $ddrs, $ddrs_prec, $recherche, $recherche_prec, $commentaire, $code2):void {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "
        UPDATE fiche_ueattente 
        SET code_ue = ?, nom_ue = ?, categorie_ue = ?, periode = ?, cible = ?, credits = ?, heure_cm = ?, heure_td = ?, heure_tp = ?, heure_the = ?, projet = ?, antecedent = ?, niv_francais = ?, anglais = ?, modalite = ?, acquis = ?, savoir = ?, techniques = ?, alternance = ?, label_ddrs = ?, label_ddrs_prec = ?, label_recherche = ?, label_recherche_prec = ?, commentaire = ?
        WHERE code_ue = ?";
        $stmt = $conn->prepare($sql);
        $stmt->executeQuery(array($code, $nom, $cat, $periode, $cible, $credits, $cm, $td, $tp, $the, $projet, $antecedent, $fr, $anglais, $modalite, $acquis, $savoir, $techniques, $alternance, $ddrs, $ddrs_prec, $recherche, $recherche_prec, $commentaire, $code2));
    }

    public function validation($code, $val) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "
        UPDATE fiche_ueattente
        SET validation = ?
        WHERE code_ue = ?";
        $stmt = $conn->prepare($sql);
        $stmt->executeQuery(array($val, $code));
    }

//    /**
//     * @return FicheUEAttente[] Returns an array of FicheUEAttente objects
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

//    public function findOneBySomeField($value): ?FicheUEAttente
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
