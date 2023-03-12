<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{

    #[Route('/artist', name: 'artist_list')]
    public function showArtists(ManagerRegistry $doctrine):Response
    {
        $artistes = $doctrine->getRepository(Artist::class)->findAll();
        return $this->render('artist/list.html.twig', ['artists' => $artistes]);
    }

    #[Route('/artist/{id}', name: 'artist_show')]
    public function showArtist(ManagerRegistry $doctrine,$id)
    {
        $artiste = $doctrine->getRepository(Artist::class)->find($id);
        return $this->render('artist/show.html.twig', ['artist' => $artiste]);
    }

    #[Route('/artist/members/{id}', name: 'detail_member_artist')]
    public function showDetailMembersArtist(ArtistRepository $artistRepository,$id):Response
    {
        $artiste = $artistRepository->find($id);
        // var_dump($artiste);

        return $this->render('artist/listMembers.html.twig', ['artist' => $artiste]);
    }

    
    #[Route('/admin/artist/create', name: 'artist_create')]
    public function createArtist(Request $request,ArtistRepository $memberRepository): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class,$artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){


            // Handle file upload
            /** @var UploadedFile $file */
            $file = $form->get('artistPicture')->getData();

            if ($file) {
                $fileName = uniqid().'.'.$file->guessExtension();
                $directory = __DIR__.'/../../public/images/artist/';
                try {
                    $file->move(
                        $directory,
                        $fileName
                    );
                } catch (FileException $e) {
                    // Handle exception if something goes wrong during file upload
                }

                $artist->setArtistPicture($fileName);
            }

            $memberRepository->save($artist, true);
            return $this->redirectToRoute('artist_list');
        }
        return $this->render('artist/artistNew.html.twig', [
            'artist' =>$artist,
            'form' => $form->createView(),
        ]);
    }

    
    #[Route('/admin/artist/edit/{id}', name: 'artist_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Artist $artist, ArtistRepository $artistRepository): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('artistPicture')->getData();

            if ($file) {
                $fileName = uniqid().'.'.$file->guessExtension();
                $directory = __DIR__.'/../../public/images/artist/';
                try {
                    $file->move(
                        $directory,
                        $fileName
                    );
                } catch (FileException $e) {
                    // Handle exception if something goes wrong during file upload
                }

                $artist->setArtistPicture($fileName);
            }

            $artistRepository->save($artist, true);

            return $this->redirectToRoute('artist_list');
        }

        return $this->renderForm('artist/artistNew.html.twig', [
            'member' => $artist,
            'form' => $form,
        ]);
    }



    
    #[Route('/admin/concert/delete/{id}', name: 'artist_delete', requirements: ['id' => '\d+'])]
    public function deleteConcert(ManagerRegistry $doctrine,$id)
    {        
        $artist = new Artist();
        $artist = $doctrine->getRepository(Artist::class)->find($id);
        $entityManager = $doctrine->getManager();
        $entityManager->remove($artist);
        $entityManager->flush();

        return $this->redirectToRoute('artist_list');
    }





}
