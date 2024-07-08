<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FicheUE;
use App\Entity\Formation;
use App\Entity\Activite;
use App\Entity\Name;
use App\Entity\Competence;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FicheUEController extends AbstractController
{
    #[Route('/ficheUE', name: 'listeUE')]
        public function list_ficheUE(ManagerRegistry $doctrine) {
            $repository = $doctrine->getRepository(FicheUE::class);

            $ue = $repository->list();
            
            if (!$ue) {
                throw $this->createNotFoundException(
                    "Il n'y a pas de fiche UE"
                );
            }

            return $this->render('fiche_ue/index.html.twig', ['ue' => $ue]);
        }

    #[Route('/ficheUE/{code}', name: 'detailUE')]
        public function detail_ficheUE(ManagerRegistry $doctrine, $code) {
            $repository = $doctrine->getRepository(FicheUE::class);
            $form = $doctrine->getRepository(Formation::class);
            $act = $doctrine->getRepository(Activite::class);
            $name = $doctrine->getRepository(Name::class);
            $comp = $doctrine->getRepository(Competence::class);
            
            $ue = $repository->fiche_UE($code);
    
            $formation = $form->formationUE($ue['id']);
    
            $activite = $act->getActiviteFormation($formation[0]['accronym_Forma']);
            foreach ($formation as $key => $f) {
                if ($key != 0) {
                    $a = $act->getActiviteFormation($f[0]['accronym_Forma']);
                    array_push($activite, $a);
                }
            }
    
            $n = $name->detail_name($ue['id']);


            return $this->render('fiche_ue/detail.html.twig', ['ue' => $ue, 'formation' => $formation, 'activite' => $activite, 'name' => $n]);
        }
}
