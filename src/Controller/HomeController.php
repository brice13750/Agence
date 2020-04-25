<?php

namespace App\Controller;

use App\Repository\AdsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(AdsRepository $adsRepository)
    {
        $ads = $adsRepository->findLastAds();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'ads' => $ads
        ]);
    }
}

// 291ms pour l'accueil
