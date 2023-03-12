<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/profile/compte/{id}', name: 'show_account',requirements: ['id' => '\d+'])]
    public function showAccount(ManagerRegistry $doctrine,$id): Response
    {
        $user =  $doctrine->getRepository(User::class)->find($id);
        return $this->render('user/show.html.twig', ['user' => $user]);
    }


    #[Route('/profile/compte/edit/{id}', name: 'edit_account')]
    public function editAccount(Request $request,UserRepository $userRepository,$id): Response
    {
        $user = $userRepository->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
    
          // Handle file upload
            /** @var UploadedFile $file */
            $file = $form->get('profilepicture')->getData();

            if ($file) {
                $fileName = uniqid().'.'.$file->guessExtension();
                $directory = __DIR__.'/../../public/images/user/';
                try {
                    $file->move(
                        $directory,
                        $fileName
                    );
                } catch (FileException $e) {
                    // Handle exception if something goes wrong during file upload
                }

                $user->setProfilepicture($fileName);
            }
    
    
    
    
    
    
            $userRepository->save($user, true);
    
            return $this->redirectToRoute('show_account', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form
        ]);
    }
    



}
