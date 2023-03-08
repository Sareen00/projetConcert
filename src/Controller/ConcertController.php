<?php

namespace App\Controller;

use App\Entity\Concert;
use App\Form\ConcertType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcertController extends AbstractController
{
    #[Route('/concert', name: 'concert_list')]
    public function showAllConcerts(ManagerRegistry $doctrine):Response
    {
        $concerts = $doctrine->getRepository(Concert::class)->findAll();
        return $this->render('concert/concertList.html.twig', ['concerts' => $concerts]);
    }



    #[Route('/concert/{id}', name: 'concert_show', requirements: ['id' => '\d+'])]
    public function showConcert(ManagerRegistry $doctrine,$id):Response
    {
        $concert = $doctrine->getRepository(Concert::class)->find($id);
        return $this->render('concert/concertShow.html.twig', ['concert' => $concert]);

    }


    
    #[Route('/concert/success', name: 'concert_success')]
    public function successConcert():Response
    {
        return $this->render('concert/concertSuccess.html.twig');
    }





    #[Route('/concert/delete/{id}', name: 'concert_delete', requirements: ['id' => '\d+'])]
    public function deleteConcert(ManagerRegistry $doctrine,$id)
    {        
        $concert = new Concert();
        $concert = $doctrine->getRepository(Concert::class)->find($id);
        $entityManager = $doctrine->getManager();
        $entityManager->remove($concert);
        $entityManager->flush();

        return $this->redirectToRoute('concert_list');
    }



    #[Route('/concert/edit/{id}', name: 'concert_edit', requirements: ['id' => '\d+'])]
    public function editConcert(Request $request,ManagerRegistry $doctrine,$id)
    {        

        $concert =  $doctrine->getRepository(Concert::class)->find($id);
        $form = $this->createForm(ConcertType::class,$concert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $concert = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();

            return $this->redirectToRoute('concert_success');
        }

        return $this->render('concert/concertNew.html.twig', [
            'form' => $form->createView()
        ]);
    }






    #[Route('/concert/create', name: 'concert_create')]
    public function createConcert(Request $request,ManagerRegistry $doctrine): Response
    {
        $concert = new Concert();
        $form = $this->createForm(ConcertType::class,$concert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $concert = $form->getData();

            // $entityManager = $this->getDoctrine()->getManager();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();

            return $this->redirectToRoute('concert_success');
        }

        return $this->render('concert/concertNew.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
