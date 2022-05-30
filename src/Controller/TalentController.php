<?php

namespace App\Controller;

use App\Entity\Talent;
use App\Data\FilterData;
use App\Form\FilterType;
use App\Repository\TalentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/talent')]
class TalentController extends AbstractController
{
    #[Route('/', name: 'app_talent_index')]
    public function talentIndex( TalentRepository $talentRepository, Request $request, PaginatorInterface $paginator, EntityManagerInterface $em,): Response
    {
        $filter = new FilterData();

        $form = $this->createForm(FilterType::class, $filter);
        $form->handleRequest($request);

        $talents1 = $talentRepository->findFilter($filter);

        $talents = [...$talents1,...$talents1,...$talents1,...$talents1,...$talents1,...$talents1,...$talents1,...$talents1,...$talents1,...$talents1,];

        $talents = $paginator->paginate($talents, $request->query->getInt('page', 1), 8);

        if ($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('talent/talents.html.twig', ['talents' => $talents]),
                'pagination' => $this->renderView('paginationAjax.html.twig', ['talents' => $talents]),
            ]);
        }

        return $this->render('talent/index.html.twig', [
            'talents' => $talents,
            'form' => $form->createView(),
            'version' => 'normal'
        ]);
    }
    // #[Route('/{slug}', name: 'app_talent_index2')]
    // public function test(string $slug)
    // {
    //     dd($slug);
    //     if(str_contains($slug, 'ajax=1')){
    //         // dd($slug);
    //         return $this->redirectToRoute('app_talent_index');
    //     }
        
    // }

    #[Route('/nos_talents', name: 'app_our_talents_index')]
    public function ourTalentIndex(TalentRepository $talentRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $filter = new FilterData();
        $filter->page = $request->get('page', 1);

        $form = $this->createForm(FilterType::class, $filter);
        $form->handleRequest($request);

        $talents = $talentRepository->findFilterOurTalent($filter);
        $talents = $paginator->paginate($talents, $request->query->getInt('page', 1), 4);

        if ($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('talent/talents.html.twig', ['talents' => $talents]),
                'pagination' => $this->renderView('paginationAjax.html.twig', ['talents' => $talents]),
            ]);
        }

        return $this->render('talent/index.html.twig', [
            'talents' => $talents,
            'form' => $form->createView(),
            'version' => 'ourTalent'
        ]);
    }

    #[Route('/detail/{id<\d+>}', name: 'app_talent_detail')]
    public function detail(Talent $talent, Request $request, PaginatorInterface $paginator): Response
    {
        $talentProjects = $talent->getProjects();
        $talentProject = [...$talentProjects,...$talentProjects,...$talentProjects,...$talentProjects,...$talentProjects,...$talentProjects,...$talentProjects, ];

        $talentAgencys = $talent->getAgencies();
        $talentAgency = [...$talentAgencys, ...$talentAgencys, ...$talentAgencys, ...$talentAgencys, ...$talentAgencys, ...$talentAgencys, ...$talentAgencys, ...$talentAgencys, ...$talentAgencys, ...$talentAgencys, ...$talentAgencys, ];

        if ($request->get('ajax')) {
            if($request->get('pageProjects') && $request->get('pageAgency')){
                $talentProject = $paginator->paginate($talentProject, $request->query->getInt('pageProjects', $request->get('pageProjects')), 6,
                ['pageParameterName' => 'pageProjects']);

                $talentAgency = $paginator->paginate($talentAgency, $request->query->getInt('pageAgency', $request->get('pageAgency')), 6,
                ['pageParameterName' => 'pageAgency']);
        
                return new JsonResponse([
                    'project' => $this->renderView('talent/profileProject.html.twig', ['projects' => $talentProject, 'talent'=>$talent]),
                    'agency' => $this->renderView('talent/profileAgency.html.twig', ['agencies' => $talentAgency, 'talent'=>$talent])
                ]);
            }
            if($request->get('pageProjects')){
                $talentProject = $paginator->paginate($talentProject, $request->query->getInt('pageProjects', $request->get('pageProjects')), 6,
                ['pageParameterName' => 'pageProjects']);
        
                return new JsonResponse([
                    'project' => $this->renderView('talent/profileProject.html.twig', ['projects' => $talentProject, 'talent'=>$talent])
                ]);
            }
            if($request->get('pageAgency')){
                $talentAgency = $paginator->paginate($talentAgency, $request->query->getInt('pageAgency', $request->get('pageAgency')), 6,
                ['pageParameterName' => 'pageAgency']);

                return new JsonResponse([
                    'agency' => $this->renderView('talent/profileAgency.html.twig', ['agencies' => $talentAgency, 'talent'=>$talent])
                ]);
            }
        }

        $talentProject = $paginator->paginate($talentProject, $request->query->getInt('pageProjects', 1), 6,
        ['pageParameterName' => 'pageProjects']);

        $talentAgency = $paginator->paginate($talentAgency, $request->query->getInt('pageAgency', 1), 6,
        ['pageParameterName' => 'pageAgency']);

        return $this->render('talent/detail.html.twig', [
            'talent' => $talent,
            'projects' => $talentProject,
            'agencies' => $talentAgency,
        ]);
    }
}
