<?php

namespace App\Controller;

use App\Entity\Talent;
use App\Repository\TalentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/talent')]
class TalentController extends AbstractController
{
    #[Route('/', name: 'app_talent_index')]
    public function talentIndex(TalentRepository $talentRepository): Response
    {
        $talents = $talentRepository->findAll();
        return $this->render('talent/index.html.twig', [
            'talents' => $talents,
        ]);
    }

    #[Route('/nos_talents', name: 'app_our_talents_index')]
    public function ourTalentIndex(TalentRepository $talentRepository): Response
    {
        $talents = $talentRepository->findBy(['ourTalent' => 'true']);
        return $this->render('talent/index.html.twig', [
            'talents' => $talents,
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
