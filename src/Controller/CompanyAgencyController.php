<?php

namespace App\Controller;

use App\Entity\Agency;
use App\Entity\Company;
use App\Data\FilterData;
use App\Form\FilterAgencyCompanyType;
use App\Repository\AgencyRepository;
use App\Repository\CompanyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/groupe')]
class CompanyAgencyController extends AbstractController
{
    #[Route('/', name: 'app_group_index')]
    public function groupIndex(CompanyRepository $companyRepository, AgencyRepository $agencyRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $filter = new FilterData();
        $filter->page = $request->get('page', 1);

        $form = $this->createForm(FilterAgencyCompanyType::class, $filter);
        $form->handleRequest($request);
        
        if($form->getData()->agency == true && $form->getData()->company == false){
            $group = $agencyRepository->findFilter($filter);
        } else if($form->getData()->agency == false && $form->getData()->company == true){
            $group = $companyRepository->findFilter($filter);
        } else{
            $companies = $companyRepository->findFilter($filter);
            $agencies = $agencyRepository->findFilter($filter);
    
            $group = [...$companies, ...$agencies];
    
            usort($group, fn($object1, $object2) =>
                ($object1->getId() > $object2->getId())  ? -1 : 1
            );
        }
        
        $group = $paginator->paginate($group, $request->query->getInt('page', 1), 4);

        return $this->render('company_agency/index.html.twig', [
            'group' => $group,
            'form' => $form->createView()
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
