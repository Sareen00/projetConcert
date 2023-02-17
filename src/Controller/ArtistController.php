<?php

namespace App\Controller;

use App\Entity\Artist;
use Container7yHZCtx\getArtistRepositoryService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{

    #[Route('/', name: 'main')]
    public function aex(){
        dump('hello');
        die;
    }


    #[Route('/artist', name: 'artist_list')]
        public function showArtists(ManagerRegistry $doctrine):Response
    {
        $artistes = $doctrine->getRepository(Artist::class)->findAll();
        return $this->render('artist/list.html.twig', ['artists' => $artistes]);
    }

    #[Route('/artist/{id}', name: 'artist_show')]
    public function showArtist(ManagerRegistry $doctrine,$id):Response
    {
        $artiste = $doctrine->getRepository(Artist::class)->find($id);
        return $this->render('artist/show.html.twig', ['artist' => $artiste]);

        //images/artist/groupeEminem.jpg
        //images/artist/groupeEminem.jpg

    }




    #[Route('/lucky/number/{max}', name: 'app_lucky_number')]
    public function number(int $max): Response
    {
        $number = random_int(0, $max);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }

    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ArtistController.php',
        ]);
    }
}
