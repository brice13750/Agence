<?php

namespace App\Controller;

use App\Entity\Ads;
use App\Form\AdsFilterType;
use App\Repository\AdsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\BrowserKit\Response;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdsController extends AbstractController
{
    /**
     * @Route("/ads/{id}", name="show_ad")
     */
    public function show(Ads $ads)
    {

        return $this->render('ads/show.html.twig', [
            'ads' => $ads
        ]);
    }

    /**
     * @Route("/annonces", name="all_ads")
     */
    public function ads(AdsRepository $adsRepository, PaginatorInterface $paginator, Request $request, Request $reques)
    {
        $allAds = $adsRepository->findAll();
        $ads = $paginator->paginate(
        $allAds, /* query NOT result */
        $reques->query->getInt('page', 1), /*page number*/
        6 /*limit per page*/
    );
        

    return $this->render('ads/index.html.twig',[
        'ads' => $ads,
    ]);
    }


    /**
     * @Route("/filtre/annonce", name="filter_ad")
     */
    public function filter(AdsRepository $adsRepository, Request $request)
    {
        $ads = $adsRepository->findAll();
        $form = $this->createForm(AdsFilterType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            
            $criteria = $form->getData();
            
            $ads = $adsRepository->filterAds($criteria);
            // dd($ads);

        }
        

    return $this->render('ads/filter.html.twig',[
        'form' => $form->createView(),
        'ads' => $ads
    ]);
    }



}
