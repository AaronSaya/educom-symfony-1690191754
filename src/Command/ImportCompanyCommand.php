<?php

namespace App\Command;

use App\Entity\Company;
use App\Entity\User;

use App\Service\ImportCompanyService;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:imortCompany',
    description: 'Import Company Excel',
)]
class ImportCompanyCommand extends Command
{
    private $importcompanyservice;

    public function __construct(ImportCompanyService $importcompanyservice){
        $this->importcompanyservice = $importcompanyservice;

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

        $inputFileName = $input->getArgument('file');
        $reader = new Xlsx();
        $path = 'documents/Excel/'. $inputFileName . '.xlsx';
        $spreadsheet = $reader->load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();

        $this->importcompanyservice->saveCompany($data);


        $io->success('Your file has been added to the database');

        return Command::SUCCESS;
    } 
}

