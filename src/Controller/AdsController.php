<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ads;

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
}
