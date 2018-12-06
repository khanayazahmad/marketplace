<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 6:38 AM
 */

include "../repository/CompanyRepository.php";

class CompanyService
{


    private $companyRepository;

    /**
     * CompanyService constructor.
     * @param $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;

    }

    public function getCompanyById($companyId){
        return $this->companyRepository->getByID($companyId);
    }

    public function getCompanyByName($companyName){
        return $this->companyRepository->getByName($companyName);
    }

    public function getListOfCompany(){
        return $this->companyRepository->getAll();
    }


}