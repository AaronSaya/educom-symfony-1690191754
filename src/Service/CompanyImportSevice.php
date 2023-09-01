<?php

namespace App\Service;

use App\Repository\CompanyRepository;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CompanyImporter
{
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function importCompaniesFromExcel(string $excelFilePath): void
    {
        $spreadsheet = IOFactory::load($excelFilePath);
        $worksheet = $spreadsheet->getActiveSheet();

        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $data = [];
            foreach ($cellIterator as $cell) {
                $data[] = $cell->getValue();
            }

            [$name, $address, $location, $postalCode, $email, $phonenumber] = $data;

            $existingCompany = $this->companyRepository->findOneByName($name);

            if ($existingCompany) {
                continue; // Skip if company already exists
            }

            $this->companyRepository->createCompanyAndUser($name, $address, $location, $postalCode, $email, $phonenumber);
        }
    }
}
