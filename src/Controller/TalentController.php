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

#[Route('/talent')]
class TalentController extends AbstractController
{
    #[Route('/', name: 'app_talent_index')]
    public function talentIndex(TalentRepository $talentRepository, Request $request, PaginatorInterface $paginator, EntityManagerInterface $em,): Response
    {
        $filter = new FilterData();
        $filter->page = $request->get('page', 1);

        $form = $this->createForm(FilterType::class, $filter);
        $form->handleRequest($request);

        $talents = $talentRepository->findFilter($filter);
        $talents = $paginator->paginate($talents, $request->query->getInt('page', 1), 3);
        // dd($talents);
        return $this->render('talent/index.html.twig', [
            'talents' => $talents,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/nos_talents', name: 'app_our_talents_index')]
    public function ourTalentIndex(TalentRepository $talentRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $filter = new FilterData();
        $filter->page = $request->get('page', 1);

        $form = $this->createForm(FilterType::class, $filter);
        $form->handleRequest($request);

        // $talents = $talentRepository->findBy(['ourTalent' => 'true']);
        $talents = $talentRepository->findFilterOurTalent($filter);
        $talents = $paginator->paginate($talents, $request->query->getInt('page', 1), 3);

        return $this->render('talent/index.html.twig', [
            'talents' => $talents,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/detail/{id<\d+>}', name: 'app_talent_detail')]
    public function detail(Talent $talent): Response
    {
        return $this->render('talent/detail.html.twig', [
            'talent' => $talent,
        ]);
    }
}
