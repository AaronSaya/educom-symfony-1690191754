<?php

namespace App\Service;

use App\Repository\ProfileRepository;
use App\Entity\Profile;
use App\Entity\User;

class ProfileService
{
    private $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function saveUpdateProfile(array $data, User $user): Profile
    {
        return $this->profileRepository->saveUpdateProfile($data, $user);
    }

    public function deleteProfile(Profile $profile): void
    {
        $this->profileRepository->deleteProfile($profile);
    }

    public function getProfile(User $user): ?Profile
    {
        return $this->profileRepository->findOneBy(['user' => $user]);
    }

    public function getProfileById(int $profileId): ?Profile
    {
        return $this->profileRepository->find($profileId);
    }

    public function createProfile($data, $user): ?Profile
    {
        return $this->profileRepository->createProfile($data, $user);
    }
}