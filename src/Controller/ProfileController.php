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
        $user = $this->userService->getUser();
        $profile = $this->profileService->getProfile($user);

        if (!$profile) {

            return $this->redirectToRoute('get_profile');
        }

        $user = $this->getUser();
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

        $this->profileService->createProfile($data, $user);

        return $this->render('profile/index.html.twig', [
            'data' => $data,
        ]);
    }
    #[Route('/profile/save', name: 'app_save_profile', methods: ("POST"))]
    public function saveUpdateProfile(Request $request): Response
    {

        $data = $request->request->all();
        $user = $this->userService->getUser();

        $this->profileService->saveUpdateProfile($data, $user);


        return $this->redirectToRoute('get_profile');
    }

    #[Route('/profile/get', name: 'get_profile')]
    public function getProfile()
    {
        $user = $this->userService->getUser();
        $profile = $this->profileService->getProfile($user);

        if (!$profile) {

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/profile.html.twig', [
            'profile' => $profile,
        ]);
    }
    #[Route('/profile/delete', name: 'app_delete_profile', methods: ("POST"))]
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
