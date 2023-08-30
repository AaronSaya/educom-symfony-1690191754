<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Profile;
use App\Entity\User;

class ProfileService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createProfile(array $profileData): Profile
    {
        $profile = new Profile();
        $this->updateProfileFromData($profile, $profileData);
        
        $this->entityManager->persist($profile);
        $this->entityManager->flush();

        return $profile;
    }

    public function updateProfile(Profile $profile): Profile
{
    $this->entityManager->flush();

    return $profile;
}
    private function updateProfileFromData(Profile $profile, array $profileData): void
    {
        $profile->setFirstName($profileData['first_name']);
        $profile->setLastName($profileData['last_name']);
        $profile->setDateOfBirth($profileData['date_of_birth']);
        $profile->setEmail($profileData['email']);
        $profile->setPhonenumber($profileData['phonenumber']);
        $profile->setFotoUrl($profileData['foto_url']);
        $profile->setAddress($profileData['address']);
        $profile->setPostalcode($profileData['postalcode']);
        $profile->setLocation($profileData['location']);
        $profile->setMotivation($profileData['motivation']);
    
    }

    public function deleteProfile(Profile $profile): void
    {
        $this->entityManager->remove($profile);
        $this->entityManager->flush();
    }

    public function getProfile(User $user): ?Profile
    {
        return $user->getProfile();
    }

    public function getProfileById(int $profileId): ?Profile
    {
        return $this->entityManager->getRepository(Profile::class)->find($profileId);
    }
}