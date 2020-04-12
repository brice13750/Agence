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
        $ads = new Ads();
        $form = $this->createForm(AdsFilterType::class, $ads);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            // dd('hello');
            // $criteria = $form->getData();
            
            // $search = $adsRepository->filterAds($criteria);
            return $this->redirectToRoute('home');
        }

        $allAds = $adsRepository->findAll();
        $ads = $paginator->paginate(
        $allAds, /* query NOT result */
        $reques->query->getInt('page', 1), /*page number*/
        6 /*limit per page*/
    );
        

    return $this->render('ads/index.html.twig',[
        'ads' => $ads,
        'form' => $form->createView()
    ]);
    }

}
