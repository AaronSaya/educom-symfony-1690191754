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
        $this->entityManager = $this->getEntityManager();
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

    public function saveUpdateProfile(array $data, $user): Profile
    {

        $profile = $this->getProfile($user);

        if (!$profile) {
            $profile = new Profile();
            $profile->setUser($user);
        }

        $profile->setFirstName($data['firstName']);
        $profile->setLastName($data['lastName']);
        $profile->setDateOfBirth($data['dateOfBirth']);
        $profile->setEmail($data['email']);
        $profile->setPhonenumber($data['phonenumber']);
        $profile->setFotoUrl($data['fotoUrl']);
        $profile->setAddress($data['address']);
        $profile->setPostalcode($data['postalcode']);
        $profile->setLocation($data['location']);
        $profile->setMotivation($data['motivation']);

        $this->entityManager->persist($profile);
        $this->entityManager->flush();

        return $profile;
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
