<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function detail(Project $project, Request $request, PaginatorInterface $paginator): Response
    {  
        $projectTalent = $project->getProjectTalent();
        $projectCompany = $project->getProjectCompany();
        // $p = $project->getProjectTalent();
        // $projectTalent = [...$p, ...$p, ...$p, ...$p, ...$p, ...$p, ...$p, ...$p, ...$p];
        if ($request->get('ajax')) {
            if($request->get('pageTalents') && $request->get('pageCompany')){
                $projectTalent = $paginator->paginate($projectTalent, $request->query->getInt('pageTalents', $request->get('pageTalents')), 6,
                ['pageParameterName' => 'pageTalents']);

                $projectCompany = $paginator->paginate($projectCompany, $request->query->getInt('pageCompany', $request->get('pageCompany')), 6,
                ['pageParameterName' => 'pageCompany'] );
        
                return new JsonResponse([
                    'talent' => $this->renderView('profileTalent.html.twig', ['talents' => $projectTalent]),
                    'company' => $this->renderView('profileCompany.html.twig', ['companies' => $projectCompany])
                ]);
            }
            if($request->get('pageTalents')){
                $projectTalent = $paginator->paginate($projectTalent, $request->query->getInt('pageTalents', $request->get('pageTalents')), 6,
                ['pageParameterName' => 'pageTalents']);
        
                return new JsonResponse([
                    'talent' => $this->renderView('profileTalent.html.twig', ['talents' => $projectTalent])
                ]);
            }
            if($request->get('pageCompany')){
                $projectCompany = $paginator->paginate($projectCompany, $request->query->getInt('pageCompany', $request->get('pageCompany')), 6,
                ['pageParameterName' => 'pageCompany'] );

                return new JsonResponse([
                    'company' => $this->renderView('profileCompany.html.twig', ['companies' => $projectCompany])
                ]);
            }
        }
        
        $projectTalent = $paginator->paginate($projectTalent, $request->query->getInt('pageTalents', 1), 6,
        ['pageParameterName' => 'pageTalents']);

        $projectCompany = $paginator->paginate($projectCompany, $request->query->getInt('pageCompany', 1), 6,
        ['pageParameterName' => 'pageCompany'] );

        return $this->render('project/detail.html.twig', [
            'project' => $project,
            'talents' => $projectTalent,
            'companies' => $projectCompany,
        ]);
    }
}
