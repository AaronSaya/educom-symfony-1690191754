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

    public function createProfile(array $profileData): Profile
    {
        return $this->profileRepository->createProfile($profileData);
    }

    public function updateProfile(Profile $profile): Profile
    {
        return $this->profileRepository->updateProfile($profile);
    }

    public function deleteProfile(Profile $profile): void
    {
        $this->profileRepository->deleteProfile($profile);
    }

    public function getProfile(User $user): ?Profile
    {
        return $user->getProfile();
    }

    public function getProfileById(int $profileId): ?Profile
    {
        return $this->profileRepository->find($profileId);
    }
}