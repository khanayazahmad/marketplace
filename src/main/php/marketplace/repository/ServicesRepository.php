<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 3:05 AM
 */

class ServicesRepository
{

    private $conn;
    private $companyRepository;

    function __construct()
    {
        $this->conn = getDBConnection();
        $this->companyRepository = new CompanyRepository();
    }

    /**
     * @return mixed
     */
    public function getConn()
    {
        return $this->conn;
    }

    function createService(Service $service){

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

    function updateService(Service $service){

        $serviceId = $service->getServiceId();
        $name = $service->getName();
        $description = $service->getDescription();
        $url = $service->getUrl();
        $company_id = $service->getCompany()->getCompanyId();

        $query = "update services set name = '$name', description = '$description', url = '$url', company_id = '$company_id'
                                where service_id = $serviceId";

        return mysqli_query($this->getConn(), $query );

    }

    function updateServiceStats($serviceId){

        $last_visited = time();

        $query = "update services set last_visited = '$last_visited', visit_count = visit_count + 1
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
                => $service = new Service($row['service_id'],
                    $row['name'],
                    $row['description'],
                    $row['url'],
                    $row['visit_count'],
                    $row['last_visited'],
                    $this->companyRepository->getByID($row['company_id'])
                )
                ];
                break;

            }

        }

        return $serviceList;

    }


}