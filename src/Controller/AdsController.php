<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ads;
use App\Repository\ImagesRepository;

class AdsController extends AbstractController
{
    /**
     * @Route("/ads/{id}", name="show_ad")
     */
    public function show(Ads $ads, ImagesRepository $imagesRepository)
    {
        $images = $imagesRepository->findAll();

        return $this->render('ads/show.html.twig', [
            'ads' => $ads,
            'images' => $images
        ]);
    }
}
