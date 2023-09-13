<?php

namespace App\Repository;

use App\Entity\Profile;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\File\UploadedFile;


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
    private $security;

    public function __construct(ManagerRegistry $registry,  Security $security)
    {
        parent::__construct($registry, Profile::class);
        $this->entityManager = $this->getEntityManager();
        $this->security = $security;
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

        $profile->setFirstName($data['firstname']);
        $profile->setLastName($data['lastname']);
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

    public function createProfile(array $data, User $user): Profile
    {
        $profile = new Profile();

        $profile->setUser($user);

        $this->getEntityManager()->persist($profile);
        $this->getEntityManager()->flush();

        return $profile;
    }

    public function saveImageFile(Profile $profile, UploadedFile $imageFile): void
    {
        // Genereer een unieke bestandsnaam om bestandsconflicten te voorkomen
        $fileName = md5(uniqid()) . '.' . $imageFile->guessExtension();

        // Verplaats het geüploade bestand naar de gewenste directory
        $imageFile->move(
            'C:\xampp\htdocs\educom-vac!t\documents\images', // Vervang 'your_image_directory' door de daadwerkelijke directory waar je de afbeeldingen wilt opslaan
            $fileName
        );

        // Sla de bestandsnaam op in het Profile-entity-object
        $profile->setImage($fileName);

        $this->_em->persist($profile);
        $this->_em->flush();
    }

    public function saveCvFile(Profile $profile, UploadedFile $cvFile): void
    {
        $fileName = md5(uniqid()) . '.' . $cvFile->guessExtension();

        $cvFile->move(
            'C:\xampp\htdocs\educom-vac!t\documents\cv',
            $fileName
        );

        $profile->setCv($fileName);

        $this->_em->persist($profile);
        $this->_em->flush();
    }
}
