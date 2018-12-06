<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 3:06 AM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/utils/DBConnectionHandler.php";
include_once $_SERVER['DOCUMENT_ROOT']."/model/Company.php";

class CompanyRepository
{
    private $conn;

    function __construct()
    {
        $this->conn = (new DBConnectionHandler())->getConn();

    }

    /**
     * @return mixed
     */
    private function getConn()
    {
        return $this->conn;
    }

    function getByID($companyId){

        $company = null;

        $query = "select * from company where company_id =". $companyId;

        $result = mysqli_query($this->getConn(), $query);



        if (mysqli_num_rows($result)> 0) {

            while(($row = mysqli_fetch_assoc($result))){

                $company = new Company($row['company_id'],$row['name'],$row['description'],$row['url']);
                break;

            }

        }

        return $company;

    }

    function getByName($companyName){

        $company = null;

        $query = "select * from company where name = $companyName";

        $result = mysqli_query($this->getConn(), $query);



        if (mysqli_num_rows($result)> 0) {

            while(($row = mysqli_fetch_assoc($result))){

                $company = new Company($row['company_id'],$row['name'],$row['description'],$row['url']);
                break;

            }

        }

        return $company;

    }

    function getAll(){

        $companyList = null;

        $query = "select * from company";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {

            while(($row = mysqli_fetch_assoc($result))){

                $companyList += [$row['company_id']
                                    => (new Company($row['company_id'],
                                                   $row['name'],
                                                   $row['description'],
                                                   $row['url']
                                    ))
                ];
                break;

            }

        }

        return $companyList;

    }



}