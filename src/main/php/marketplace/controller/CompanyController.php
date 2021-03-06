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
        $company = $this->companyService->getCompanyById(intval($companyId));
        return json_encode(["data"=>$company]);
    }

    /**
     * GET : "/getByName/{companyName}"
     * @param $companyName
     * @return string
     */
    public function getCompanyByName($companyName){
        $company = $this->companyService->getCompanyByName($companyName);
        return json_encode(["data"=>$company]);

    }

    /**
     * GET : "/getAll"
     * @return string
     */
    public function getAllCompany(){
        $companyList = $this->companyService->getAllCompany();
        return json_encode(["data"=>$companyList],true);

    }

}