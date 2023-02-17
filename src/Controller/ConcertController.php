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
    public function showArtists(ManagerRegistry $doctrine):Response
    {
        $concerts = $doctrine->getRepository(Concert::class)->findAll();
        return $this->render('concert/concertList.html.twig', ['concerts' => $concerts]);
    }



    #[Route('/concert/{id}', name: 'concert_show', requirements: ['id' => '\d+'])]
    public function showArtist(ManagerRegistry $doctrine,$id):Response
    {
        $concert = $doctrine->getRepository(ConcertType::class)->find($id);
        return $this->render('concert/concertShow.html.twig', ['concert' => $concert]);

    }


    #[Route('/concert/create', name: 'concert_create')]
    public function createConcert(Request $request): Response
    {
        $concert = new Concert();
        $form = $this->createForm(ConcertType::class,$concert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $concert = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();

            return $this->redirectToRoute('concert_success');
        }

        return $this->render('concert/concertNew.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
