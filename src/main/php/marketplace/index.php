<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/4/2018
 * Time: 11:59 PM
 */
include_once "controller/CompanyController.php";
include_once "service/CompanyService.php";
include_once "repository/CompanyRepository.php";

$url = $_SERVER['REQUEST_URI'];
echo $url."<br>";
if($url == "/company/getById/1"){
    $companyController = new CompanyController(new CompanyService(new CompanyRepository()));
    echo $companyController->getCompanyById(1);

}else{
    echo "unknown";
}


