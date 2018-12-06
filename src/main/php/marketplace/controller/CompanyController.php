<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 6:37 AM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/utils/modelUtilities.php";
include_once $_SERVER['DOCUMENT_ROOT']."/service/CompanyService.php";

/**
 * "/company"
 */
class CompanyController
{
    private $companyService;

    /**
     * CompanyController constructor.
     * @param $companyService
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * GET : "/getById/{companyId}"
     * @param $companyId
     * @return string
     */
    public function getCompanyById($companyId){
        $company = $this->companyService->getCompanyById($companyId);
        return json_encode($company);
    }

    /**
     * GET : "/getByName/{companyName}"
     * @param $companyName
     * @return string
     */
    public function getCompanyByName($companyName){
        $company = $this->companyService->getCompanyByName($companyName);
        return json_encode($company);

    }

    /**
     * GET : "/getAll"
     * @return string
     */
    public function getListOfCompany(){
        $companyList = $this->companyService->getAllCompany();
        return json_encode($companyList,true);

    }

}