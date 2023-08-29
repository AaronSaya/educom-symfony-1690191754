<?php

namespace App\Repository;

use App\Entity\Profile;
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
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Profile::class);
    }

    public function saveProfile($params)
    {
        $profile = new Profile();
        $profile->setFirstName($params["first_name"]);
        $profile->setLastName($params["last_name"]);
        $profile->setEmail($params["email"]);
        $profile->setDateOfBirth($params["date_of_birth"]);
        $profile->setPhonenumber($params["phonenumber"]);
        $profile->setAddress($params["address"]);
        $profile->setPostalCode($params["postal_code"]);
        $profile->setLocation($params["location"]);
        $profile->setMotivation($params["motivation"]);
        $profile->setFotoUrl($params["foto_url"]);

        $this->_em->persist($profile);
        $this->_em->flush();

        return($profile);
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
}
