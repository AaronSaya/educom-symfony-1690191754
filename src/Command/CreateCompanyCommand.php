<?php

namespace App\Command;

use App\Service\CompanyService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:company:create',
    description: 'Register a new company',
)]
class CreateCompanyCommand extends Command
{

    private $companyService;

    public function __construct(CompanyService $companyService)
    {
        parent::__construct();
        $this->companyService = $companyService;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the company')
            ->addArgument('location', InputArgument::REQUIRED, 'Location of the company')
            ->addArgument('logo_url', InputArgument::REQUIRED, 'Logo of the company')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = $input->getArgument('name');
        $location = $input->getArgument('location');
        $logoUrl = $input->getArgument('logo_url');

        $this->companyService->createCompany([
            'name' => $name,
            'location' => $location,
            'logo_url' => $logoUrl,
        ]);
    
        $io->success('Company has been registered.');
        
        return Command::SUCCESS;
    }
}
