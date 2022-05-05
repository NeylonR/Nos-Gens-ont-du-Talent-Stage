<?php

namespace App\Controller;

use App\Entity\Agency;
use App\Entity\Company;
use App\Repository\AgencyRepository;
use App\Repository\CompanyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/groupe')]
class CompanyAgencyController extends AbstractController
{
    #[Route('/', name: 'app_group_index')]
    public function groupIndex(CompanyRepository $companyRepository, AgencyRepository $agencyRepository): Response
    {
        $companies = $companyRepository->findAll();
        $agencies = $agencyRepository->findAll();

        $group = [...$companies, ...$agencies];

        usort($group, fn($object1, $object2) =>
            ($object1->getId() > $object2->getId())  ? -1 : 1
        );

        return $this->render('company_agency/index.html.twig', [
            'group' => $group,
        ]);
    }

    #[Route('/societe/detail/{id<\d+>}', name: 'app_group_company_detail')]
    public function groupCompanyDetail(Company $company): Response
    {
        return $this->render('company_agency/company_detail.html.twig', [
            'company' => $company,
        ]);
    }

    #[Route('/agency/detail/{id<\d+>}', name: 'app_group_agency_detail')]
    public function groupAgencyDetail(Agency $agency): Response
    {
        return $this->render('company_agency/agency_detail.html.twig', [
            'agency' => $agency,
        ]);
    }
}
