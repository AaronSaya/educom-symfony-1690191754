<?php

namespace App\Repository;

use App\Entity\Profile;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Profile>
 *
 * @method Profile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Profile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Profile[]    findAll()
 * @method Profile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfileRepository extends ServiceEntityRepository
{

    private $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Profile::class);
    }

//    /**
//     * @return Profile[] Returns an array of Profile objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Profile
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

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
