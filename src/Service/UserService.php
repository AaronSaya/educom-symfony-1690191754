<?php

namespace App\Service;

use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Repository\UserRepository;

class UserService
{
    private $security;
    private $entityManager;
    private $userRepository;

    public function __construct(UserRepository $userRepository, Security $security, EntityManagerInterface $entityManager)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }

    public function getUser()
    {
        // returns User object or null if not authenticated
        $user = $this->security->getUser();

        return $user;
    }

    public function isAuthenticated()
    {
        // Controleert of de gebruiker is geauthenticeerd
        return $this->security->isGranted('IS_AUTHENTICATED_FULLY');
    }

    public function createUser(array $userData): User
    {
        return $this->userRepository->createUser($userData);
    }

    public function updateUser(User $user, array $userData): User
    {
        // Update the properties of the user entity based on $userData
        $user->setUsername($userData['username']);
        // ... update other properties ...

        $this->entityManager->flush();

        return $user;
    }

    public function deleteUser(User $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function getUserById(int $userId): ?User
    {
        return $this->entityManager->getRepository(User::class)->find($userId);
    }

}