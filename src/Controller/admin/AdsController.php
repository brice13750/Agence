<?php

namespace App\Controller\admin;

use App\Entity\Ads;
use App\Form\AdsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdsController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function list()
    {
        return $this->render('admin/ads/index.html.twig', [
            'controller_name' => 'AdsController',
        ]);
    }

    /**
     * @Route("/admin/add", name="admin_add")
     */
    public function add(EntityManagerInterface $em, Request $request)
    {
        $ads = new Ads();
        $form = $this->createForm(AdsType::class, $ads);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($ads);
            $em->flush();
        }

        return $this->render('admin/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
