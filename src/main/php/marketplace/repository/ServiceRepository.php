<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 3:05 AM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/utils/DBConnectionHandler.php";
include_once $_SERVER['DOCUMENT_ROOT']."/model/Service.php";
include_once $_SERVER['DOCUMENT_ROOT']."/model/Company.php";
include_once "CompanyRepository.php";

class ServiceRepository
{

    private $conn;
    private $companyRepository;

    function __construct(DBConnectionHandler $dbConnectionHandler, CompanyRepository $companyRepository)
    {
        $this->conn = $dbConnectionHandler->getConn();
        $this->companyRepository = $companyRepository;
    }

    /**
     * @return mixed
     */
    private function getConn()
    {
        return $this->conn;
    }

    function create(Service $service){

        $name = $service->getName();
        $description = $service->getDescription();
        $url = $service->getUrl();
        $visit_count = 0;
        $last_visited = time();
        $company_id = $service->getCompany()->getCompanyId();

        $query = "insert into services (name, description, url, visit_count, last_visited, company_id)
                                values ('$name','$description','$url','$visit_count','$last_visited','$company_id')";

        return mysqli_query($this->getConn(), $query );

    }

    function update(Service $service){

        $serviceId = $service->getServiceId();
        $name = $service->getName();
        $description = $service->getDescription();
        $url = $service->getUrl();
        $company_id = $service->getCompany()->getCompanyId();

        $query = "update services set name = '$name', description = '$description', url = '$url', company_id = '$company_id'
                                where service_id = $serviceId";

        return mysqli_query($this->getConn(), $query );

    }

    function updateServiceLastVisitedAndVisitCountById($serviceId, $last_visited, $visit_count_incr){

        $query = "update services set last_visited = '$last_visited', visit_count = visit_count + $visit_count_incr
                                where service_id = $serviceId";

        return mysqli_query($this->getConn(), $query );

    }

    function getByID($serviceId){

        $service = null;

        $query = "select * from services where service_id = $serviceId";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {

            while(($row = mysqli_fetch_assoc($result))){

                $service = new Service($row['service_id'],
                    $row['name'],
                    $row['description'],
                    $row['url'],
                    $row['visit_count'],
                    $row['last_visited'],
                    $this->companyRepository->getByID($row['company_id'])
                );
                break;

            }

        }

        return $service;

    }

    function getByName($serviceName){

        $service = null;

        $query = "select * from services where name = $serviceName";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {

            while(($row = mysqli_fetch_assoc($result))){

                $service = new Service($row['service_id'],
                    $row['name'],
                    $row['description'],
                    $row['url'],
                    $row['visit_count'],
                    $row['last_visited'],
                    $this->companyRepository->getByID($row['company_id'])
                );break;

            }

        }

        return $service;

    }

    function getAll(){

        $serviceList = null;

        $query = "select * from services";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {

            while(($row = mysqli_fetch_assoc($result))){

                $serviceList += [$row['service_id']
                    => (new Service($row['service_id'],
                        $row['name'],
                        $row['description'],
                        $row['url'],
                        $row['visit_count'],
                        $row['last_visited'],
                        $this->companyRepository->getByID($row['company_id'])
                    ))
                ];
                break;

            }

        }

        return $serviceList;

    }


}