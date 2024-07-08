<?php
 
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\FicheUE;
use App\Entity\Formation;
use App\Entity\Activite;
use App\Entity\Name;
use App\Entity\Competence;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
 
class PdfGeneratorController extends AbstractController
{
    #[Route('/pdf/generator/{code}', name: 'app_pdf_generator')]
    public function index(ManagerRegistry $doctrine, $code): Response
    {
        $repository = $doctrine->getRepository(FicheUE::class);
        $form = $doctrine->getRepository(Formation::class);
        $act = $doctrine->getRepository(Activite::class);
        $name = $doctrine->getRepository(Name::class);

        $img = $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/EUT+UTT.jpg');
        
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


        $html = $this->render('pdf_generator/index.html.twig', ['ue' => $ue, 'formation' => $formation, 'activite' => $activite, 'name' => $n, 'img' => $img]);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
         
        return new Response (
            $dompdf->stream('resume', ["Attachment" => false]),
            Response::HTTP_OK,
            ['Content-Type' => 'application/pdf']
        );
    }
 
    private function imageToBase64($path) {
        $path = $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
}