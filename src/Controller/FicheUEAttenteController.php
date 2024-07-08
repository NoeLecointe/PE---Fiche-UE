<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FicheUEAttente;
use App\Entity\FicheUE;
use App\Entity\Formation;
use App\Entity\Activite;
use App\Entity\Name;
use App\Entity\Competence;
use Doctrine\Persistence\ManagerRegistry;

class FicheUEAttenteController extends AbstractController
{


    
    #[Route('/ficheUEattente', name: 'listeUEattente')]
    public function list_ficheUE(ManagerRegistry $doctrine) {
        $repository = $doctrine->getRepository(FicheUEAttente::class);
        $ues = $doctrine->getRepository(FicheUE::class);

        $ueattente = $repository->list();
        $ue = $ues->list();

        return $this->render('fiche_ue_attente/index.html.twig', ['ueattente' => $ueattente, 'ue' => $ue]);
    }

    // #[Route('/ficheUEattente/ajout', name: 'ajoutUE')]
        // public function ajout_UE(ManagerRegistry $doctrine) {
        //     $formation = $doctrine->getRepository(Formation::class);
            
        //     $form = $formation->formations();

        //     return $this->render('fiche_ue_attente/ajoutFiche.html.twig', ['form' => $form]);
    // }

    #[Route('/ficheUEattente/modif', name: 'modifUE')]
    public function modif_UE(ManagerRegistry $doctrine) {
        $repository = $doctrine->getRepository(FicheUEAttente::class);
        $name = $doctrine->getRepository(Name::class);
        $form = $doctrine->getRepository(Formation::class);
        $act = $doctrine->getRepository(Activite::class);
        $comp = $doctrine->getRepository(Competence::class);
        
        $ue = $repository->fiche_UE($_POST['code']);
        
        if ($_POST['modif'] == 'Enregistrer') {
            $n = $name->detail_name_attente($ue['id']);   
            
            if ($_POST['projet'] == 'non') { $_POST['projet'] = 0; } else { $_POST['projet'] = 1; }
            if ($_POST['alternance'] == 'non') { $_POST['alternance'] = 0; } else { $_POST['alternance'] = 1; }
            if ($_POST['anglais'] == 'non') { $_POST['anglais'] = 0; } else { $_POST['anglais'] = 1; }
            if ($_POST['ddrs'] == 'non') { $_POST['ddrs'] = 0; } else { $_POST['ddrs'] = 1; }
            if ($_POST['recherche'] == 'non') { $_POST['recherche'] = 0; } else { $_POST['recherche'] = 1; }

            $repository->modif_fiche($_POST['code'], $_POST['nom'], $_POST['cat'], $_POST['periode'], $_POST['cible'], $_POST['credits'], $_POST['CM'], $_POST['TD'], $_POST['TP'], $_POST['THE'], $_POST['projet'], $_POST['antecedent'], $_POST['fr'], $_POST['anglais'], $_POST['modalite'], $_POST['acquis'], $_POST['savoir'], $_POST['techniques'], $_POST['alternance'], $_POST['ddrs'], $_POST['ddrs_prec'], $_POST['recherche'], $_POST['recherche_prec'], $_POST['commentaire'], $_POST['code']);
            

            foreach ($_POST['name'] as $key => $pname) {
                $nb = 0;
                foreach ($n as $value) {
                    if ($value['id'] == $key) {
                        $nb = 1;
                    }
                }
                if($nb == 1) {
                    if($pname['notion'] || $pname['application'] || $pname['maitrise'] || $pname['expertise'] ) {
                        $name->change_name('oui', $ue['id'] ,$key, $pname['notion'], $pname['application'], $pname['maitrise'], $pname['expertise']);
                    } else {
                        $name->delete_name('oui', $ue['id'], $key);
                    }
                }
                if ($nb == 0) {
                    if($pname['notion'] || $pname['application'] || $pname['maitrise'] || $pname['expertise'] ) {
                        $name->add_name('oui', $ue['id'] ,$key, $pname['notion'], $pname['application'], $pname['maitrise'], $pname['expertise']);
                    }
                }
            }
        }

        if ($_POST['modif'] == 'Annuler la soumission' || $_POST['modif'] == 'Soumettre' || $_POST['modif']) {
            if ($ue['validation'] == 0) {
                $repository->validation($ue['code_ue'], 1);
            } else {
                $repository->validation($ue['code_ue'], 0);
            }
            $ue = $repository->fiche_UE($_POST['code']);
        }

        $formation = $form->formationUEattente($ue['id']);

        $activite = $act->getActiviteFormation($formation[0]['accronym_Forma']);
        foreach ($formation as $key => $f) {
            if ($key != 0) {
                $a = $act->getActiviteFormation($f[0]['accronym_Forma']);
                array_push($activite, $a);
            }
        }

        $n = $name->detail_name_attente($ue['id']);

        $competence = $comp->getComp();


        return $this->render('fiche_ue_attente/modifFiche.html.twig', ['ue' => $ue, 'formation' => $formation, 'activite' => $activite, 'name' => $n, 'competences' => $competence]);
    }

    #[Route('/ficheUEattente/attente', name: 'attente')]
    public function attente(ManagerRegistry $doctrine) {
        $repository = $doctrine->getRepository(FicheUEAttente::class);
        $ue = $repository->list();

        if (!$ue) {
            throw $this->createNotFoundException(
                "Il n'y a pas de fiche UE"
            );
        }

        return $this->render('fiche_ue_attente/attente.html.twig', ['ue' => $ue]);
    }



    #[Route('/ficheUEattente/consulter', name: 'detailUEattente')]
    public function detail_ficheUE(ManagerRegistry $doctrine) {
        $repository = $doctrine->getRepository(FicheUEAttente::class);
        $name = $doctrine->getRepository(Name::class);
        $form = $doctrine->getRepository(Formation::class);
        $act = $doctrine->getRepository(Activite::class);
        $comp = $doctrine->getRepository(Competence::class);
        
        $ue = $repository->fiche_UE($_POST['code']);

        $formation = $form->formationUEattente($ue['id']);

        $activite = $act->getActiviteFormation($formation[0]['accronym_Forma']);
        foreach ($formation as $key => $f) {
            if ($key != 0) {
                $a = $act->getActiviteFormation($f[0]['accronym_Forma']);
                array_push($activite, $a);
            }
        }

        $n = $name->detail_name_attente($ue['id']);

        $competence = $comp->getComp();

        return $this->render('fiche_ue_attente/modifFiche.html.twig', ['ue' => $ue, 'formation' => $formation, 'activite' => $activite, 'name' => $n, 'competences' => $competence]);
    }

}
