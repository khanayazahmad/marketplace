<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 1:40 AM
 */

require_once ("getConfig.php");

class DBConnectionHandler{

    private $db_config;
    private $conn;

    /**
     * DBConnectionHandler constructor.
     */
    public function __construct()
    {
        $this->db_config = getDBConfig();
        define('DB_SERVER', $this->db_config['host']);
        define('DB_USERNAME', $this->db_config['username']);
        define('DB_PASSWORD', $this->db_config['password']);
        define('DB_NAME', $this->db_config['schema']);

        $this->conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if($this->conn === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        $query = "SELECT uname FROM users";
        $result = mysqli_query($this->conn, $query);

        if(empty($result)){

            $query_create_table = "create table users
                (
                  uname   varchar(255) not null primary key,
                  password   varchar(255) null,
                  fname   varchar(255) null,
                  lname   varchar(255) null,
                  address varchar(512) null,
                  email   varchar(255) null,
                  phone  varchar(12)  null
                )";

            $result = mysqli_query($this->conn, $query_create_table);

        }

        $query = "SELECT company_id FROM company";
        $result = mysqli_query($this->conn, $query);

        if(empty($result)){

            $query_create_table = "create table company
                (
                  company_id   int not null AUTO_INCREMENT primary key,
                  name   varchar(255) null,
                  description   varchar(1000) null,
                  url   varchar(255) null
                )";

            $result = mysqli_query($this->conn, $query_create_table);

        }

        $query = "SELECT service_id FROM services";
        $result = mysqli_query($this->conn, $query);

        if(empty($result)){

            $query_create_table = "create table services
                (
                  service_id   int not null AUTO_INCREMENT primary key,
                  name   varchar(255) null,
                  description   varchar(1000) null,
                  url   varchar(255) null,
                  visit_count int not null,
                  last_visited long null,
                  company_id   int not null,
                  FOREIGN KEY (company_id) REFERENCES company(company_id)
                )";

            $result = mysqli_query($this->conn, $query_create_table);

        }

        $query = "SELECT review_id FROM reviews";
        $result = mysqli_query($this->conn, $query);

        if(empty($result)){

            $query_create_table = "create table reviews
                (
                  review_id   int not null AUTO_INCREMENT primary key,
                  ratings   int null,
                  description   varchar(1000) null,
                  service_id   int not null,
                  uname varchar(255) not null, 
                  FOREIGN KEY (service_id) REFERENCES services(service_id),
                  FOREIGN KEY (uname) REFERENCES users(uname)
                )";

            $result = mysqli_query($this->conn, $query_create_table);

        }


    }

    /**
     * @return mysqli
     */
    public function getConn()
    {
        return $this->conn;
    }

}
