<?php

namespace App\Controller;

use App\Entity\User;

use App\Service\UserService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class RegistrationController extends AbstractController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    #[Route('/register', name: 'app_register')]
    public function register()
    {
        $userData = [
            'username' => '',
            'password' => '',
            'authenticator' => '',
        ];

        return $this->render('registration/register.html.twig', [
            'userData' => $userData,
        ]);
    }

    #[Route('/register/save', name: 'app_save_register', methods: "POST")]
    public function createUser(Request $request,CsrfTokenManagerInterface $csrfTokenManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $csrfToken = $request->request->get('_token');
        if (!$csrfTokenManager->isTokenValid(new CsrfToken('CSRF', $csrfToken))) {
            throw new AccessDeniedException('Ongeldig CSRF-token.');
        }
        $userData = $request->request->all();

        if ($userData['password'] !== $userData['authenticator']) {

            return $this->redirectToRoute('app_register');
        }

        $passwordHash = $passwordHasher->hashPassword(new User(), $userData['password']);

        $this->userService->createUser([
            'username' => $userData['username'],
            'password' => $passwordHash,
        ]);

        return $this->redirectToRoute('app_profile');
    }
}
