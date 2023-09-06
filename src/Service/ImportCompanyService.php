<?php

namespace App\Service;

use App\Repository\CompanyRepository;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportCompanyService extends CompanyRepository
{
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function saveCompany($data)
    {
        $this->companyRepository->saveCompany($data);
       }
}
