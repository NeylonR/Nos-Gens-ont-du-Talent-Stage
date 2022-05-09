<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#[Route('/projets')]
class ProjectController extends AbstractController
{
    #[Route('/', name: 'app_project_index')]
    public function projectIndex(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();
        $countProgress = 0;
        $countOver = 0;
        $countLookingFor = 0;
        // dd(...$projects);

        foreach($projects as $p){
            if($p->getStatus() == 'En cours'){
                $countProgress ++;
            } else if($p->getStatus() == 'Terminé'){
                $countOver ++;
            } else if($p->getStatus() == 'En recherche de talents'){
                $countLookingFor ++;
            }
        }

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
            'countProgress' => $countProgress,
            'countOver' => $countOver,
            'countLookingFor' => $countLookingFor,
        ]);
    }

    #[Route('/detail/{id<\d+>}', name: 'app_project_detail')]
    public function detail(Project $project): Response
    {
        return $this->render('project/detail.html.twig', [
            'project' => $project,
        ]);
    }
}
