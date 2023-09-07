<?php

namespace App\Controller;

use App\Service\ProfileService;
use App\Service\UserService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


class ProfileController extends AbstractController
{
    private $profileService;
    private $userService;
    private $security;

public function __construct(ProfileService $profileService, UserService $userService, Security $security)
    {
        $this->profileService = $profileService;
        $this->userService = $userService;
        $this->security = $security;
    }

    #[Route('/profile', name: 'app_profile')]
    public function index() 
    {
        
            if (!$this->security->isGranted('IS_AUTHENTICATED_FULLY')) {
                throw new AccessDeniedException('Toegang geweigerd. Log in om je profiel te bekijken.');
            }

            $user = $this->userService->getUser();
            $profile = $this->profileService->getProfile($user);

            if($profile){
                $data = $profile;
            } else {
                
            $data = [
                'first_name' => '',
                'last_name' => '',
                'date_of_birth' => '',
                'email' => '',
                'phonenumber' => '',
                'address' => '',
                'postalcode' => '',
                'location' => '',
                'motivation' => '',
                'foto_url' => '',
                ];
            }
            return $this->render('profile/profile.html.twig', [
                'data' => $data,
            ]);
        }


       #[Route('/profile/save', name: 'app_save_profile', methods:("POST"))]
       public function saveUpdateProfile(Request $request): Response
       {
        
        $data = $request->request->all();
        $user = $this->getUser();

        $this->profileService->saveUpdateProfile($data, $user);


        return $this->redirectToRoute('app_profile');
       }

        // public function delete(): Response
        // {
        //     $user = $this->security->getUser(); 
        //     $profile = $this->profileService->getProfile($user); 

        //     if (!$profile) {
            
        //         return $this->redirectToRoute('app_profile');
        //     }

        //     $this->profileService->deleteProfile($profile);

        //     return $this->redirectToRoute('app_homepage');
        // }
}