<?php

namespace App\Controller;

use App\Entity\Ads;
use App\Repository\AdsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(AdsRepository $adsRepository)
    {
        $ads = $adsRepository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'ads' => $ads
        ]);
    }
}
