<?php

namespace App\Command;

use App\Service\ImportCompanyService;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

#[AsCommand(
    name: 'app:importCompany',
    description: 'Import Company Excel',
)]
class ImportCompanyCommand extends Command
{
    private $importcompanyservice;
    private $passwordHasher;
    private $csrfTokenManager;

    public function __construct(ImportCompanyService $importcompanyservice,  UserPasswordHasherInterface $passwordHasher,CsrfTokenManagerInterface $csrfTokenManager){
        $this->importcompanyservice = $importcompanyservice;
        $this->passwordHasher = $passwordHasher;
        $this->csrfTokenManager = $csrfTokenManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setHelp('This command allows you to import a spreadsheet')
            ->addArgument('file', InputArgument::REQUIRED, 'Spreadsheet')
        ;   
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)                             
    {

        $io = new SymfonyStyle($input, $output);
        $csrfToken = $this->csrfTokenManager->getToken('import_company')->getValue();

        $inputFileName = $input->getArgument('file');
        $reader = new Xlsx();
        $path = 'documents/Excel/'. $inputFileName . '.xlsx';
        $spreadsheet = $reader->load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();

        $this->importcompanyservice->saveCompany($data, $csrfToken , $this->passwordHasher);


        $io->success('Your file has been added to the database');

        return Command::SUCCESS;
    } 
}

