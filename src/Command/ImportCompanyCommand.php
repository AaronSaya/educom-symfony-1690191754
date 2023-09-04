<?php

namespace App\Command;

use App\Entity\Company;
use App\Entity\User;

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
    protected function configure()
    {
        $this
            ->setHelp('This command allows you to import a spreadsheet')
            ->addArgument('file', InputArgument::REQUIRED, 'Spreadsheet')
        ;   
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)                             
    {

        $io= 

        $inputFileName = $input->getArgument('file');
        $spreadsheet = IOFactory::load($inputFileName);



        return Command::SUCCESS;
    } 
}

