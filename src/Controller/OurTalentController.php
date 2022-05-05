<?php

namespace App\Controller;

use App\Repository\TalentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/nos_talents')]
class OurTalentController extends AbstractController
{
    #[Route('/nos_talents', name: 'app_our_talent_index')]
    public function talentIndex(TalentRepository $talentRepository): Response
    {
        $talents = $talentRepository->findAll();
        return $this->render('talent/index.html.twig', [
            'talents' => $talents,
        ]);
    }
}
