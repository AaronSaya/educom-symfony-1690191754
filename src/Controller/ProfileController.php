<?php

namespace App\Controller;

use App\Form\ProfileFormType; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ProfileService;
use Symfony\Component\Security\Core\Security;


class ProfileController extends AbstractController
{
    private $profileService;
    private $security;

    public function __construct(ProfileService $profileService, Security $security)
    {
        $this->profileService = $profileService;
        $this->security = $security;
    }

    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request): Response
    {
        $user = $this->security->getUser();
        $profile = $this->profileService->getProfile($user);
    
        $form = $this->createForm(ProfileFormType::class, $profile);
        $form->handleRequest($request);

        $isLoggedIn = $this->isGranted('IS_AUTHENTICATED_FULLY'); 

    
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'profile' => $profile,
            'profileForm' => $form->createView(),
            'isLoggedIn' => $isLoggedIn,
        ]);
    }

    public function edit(Request $request): Response
    {
        $user = $this->security->getUser(); 
        $profile = $this->profileService->getProfile($user); 
    
        if (!$profile) {
            // Redirect or show an error message
            $this->addFlash('error', 'Profile not found.');
            return $this->redirectToRoute('app_profile'); // Redirect back to the profile page
        }
    
        $form = $this->createForm(ProfileFormType::class, $profile);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Update user data
            $this->profileService->updateProfile($profile);
    
            return $this->redirectToRoute('app_profile_edit');
        }
    
        return $this->render('profile/edit.html.twig', [
            'controller_name' => 'ProfileController',
            'profile' => $profile,
            'profileForm' => $form->createView(),
        ]);
    }

    public function delete(): Response
    {
        $user = $this->security->getUser(); 
        $profile = $this->profileService->getProfile($user); 

        if (!$profile) {
           
            return $this->redirectToRoute('app_profile');
        }

        $this->profileService->deleteProfile($profile);

        return $this->redirectToRoute('app_homepage');
    }

}