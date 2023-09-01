<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Company;
use App\Entity\User;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

#[AsCommand(
    name: 'ImportCompany',
    description: 'Import companies from Excel spreadsheet',
)]
class ImportCompanyCommand extends Command
{
    private $passwordHasher;
    private $entityManager;
    private $slugger;

    public function __construct(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        parent::__construct();
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
        $this->slugger = $slugger;
    }

    protected function configure(): void
    {
        $this->setDescription('Import companies from Excel spreadsheet');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Load and process Excel spreadsheet using PhpSpreadsheet's Xlsx reader
        $excelFilePath = __DIR__ . '/../../documents/excel/Company_List.xlsx';
        $spreadsheet = IOFactory::load($excelFilePath);
        $worksheet = $spreadsheet->getActiveSheet();

        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // Include all cells, even if they are empty

            $data = [];

            foreach ($cellIterator as $cell) {
                $data[] = $cell->getValue();
            }

            [$name, $address, $location, $postalCode, $email, $phonenumber] = $data;

            // Create a new Company entity
            $company = new Company();
            $company->setName($name);
            $company->setAddress($address);
            $company->setLocation($location);
            $company->setPostalCode($postalCode);
            $company->setEmail($email);
            $company->setPhonenumber($phonenumber);

            // Generate a username from the company name
            $username = $this->slugger->slug($name)->lower();

            // Set default password
            $password = $name;
            $encodedPassword = $this->passwordHasher->hashPassword($company, $password);

            // Create a new User entity
            $user = new User();
            $user->setUsername($username);
            $user->setPassword($encodedPassword);
            $user->setRoles(['ROLE_EMPLOYER']);

            // Persist entities
            $this->entityManager->persist($company);
            $this->entityManager->persist($user);
        }

        // Flush changes to the database
        $this->entityManager->flush();

        $io->success('Companies and Users imported successfully.');

        return Command::SUCCESS;
    }
}
