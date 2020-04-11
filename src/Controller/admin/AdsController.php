<?php

namespace App\Controller\admin;

use App\Entity\Ads;
use App\Form\AdsType;
use App\Form\EditAdsType;
use App\Repository\AdsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdsController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function list(AdsRepository $adsRepository)
    {
        $ads = $adsRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'ads' => $ads
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

        /**
    * @Route("/admin/edit/{id}", name="admin_edit")
    */
    public function edit($id, EntityManagerInterface $em, AdsRepository $adsRepository, Request $request)
    {
        $ad = $adsRepository->find($id);

        $form = $this->createForm(EditAdsType::class, $ad);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            // $em->persist($ad);
            $em->flush();
            // $this->addFlash('success', 'Annonce modifié');
            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/edit.html.twig',[
            'form' => $form->createView(),
            'ad' => $ad,
        ]);
    }

    /**
    * @Route("/admin/delete/{id}", name="admin_delete")
    */
    public function delete($id, EntityManagerInterface $em)
    {
        $ad = $em->getRepository(Ads::class)->find($id);
        $em->remove($ad);
        $em->flush();

        return $this->redirectToRoute('admin');
    }
}
