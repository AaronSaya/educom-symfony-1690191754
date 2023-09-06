<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<User>
* @implements PasswordUpgraderInterface<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
        $this->entityManager = $this->getEntityManager();
    }

    public function getUser($id)
    {
        $user = $this->find($id); 
        return $user;
    }

    public function getAllUsers() 
    {
        $users = $this->findAll();
        return($users);
    }

    // /**
    //  * Used to upgrade (rehash) the user's password automatically over time.
    //  */
    // public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    // {
    //     if (!$user instanceof User) {
    //         throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
    //     }

    //     $user->setPassword($newHashedPassword);
    //     $this->getEntityManager()->persist($user);
    //     $this->getEntityManager()->flush();
    // }

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

   public function createUser(array $userData): User
    {
        $user = new User;
        $user->setUsername($userData['username']);
        $user->setPassword($userData['password']);
        // ... set other properties ...

        $user->setRoles(['ROLE_CANDIDATE']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    
        return $user;
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

}
