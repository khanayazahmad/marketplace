<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 1:40 AM
 */

require_once "getConfig.php";

$db_config = getDBConfig();

define('DB_SERVER', $db_config['host']);
define('DB_USERNAME', $db_config['username']);
define('DB_PASSWORD', $db_config['password']);
define('DB_NAME', $db_config['schema']);

/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

$query = "SELECT uname FROM users";
$result = mysqli_query($conn, $query);

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

    $result = mysqli_query($conn, $query_create_table);

}

$query = "SELECT company_id FROM company";
$result = mysqli_query($conn, $query);

if(empty($result)){

    $query_create_table = "create table company
                (
                  company_id   int not null primary key,
                  name   varchar(255) null,
                  description   varchar(1000) null,
                  url   varchar(255) null
                )";

    $result = mysqli_query($conn, $query_create_table);

}

$query = "SELECT service_id FROM services";
$result = mysqli_query($conn, $query);

if(empty($result)){

    $query_create_table = "create table services
                (
                  service_id   int not null primary key,
                  name   varchar(255) null,
                  description   varchar(1000) null,
                  url   varchar(255) null,
                  company_id   int not null,
                  FOREIGN KEY (company_id) REFERENCES company(company_id)
                )";

    $result = mysqli_query($conn, $query_create_table);

}

$query = "SELECT review_id FROM reviews";
$result = mysqli_query($conn, $query);

if(empty($result)){

    $query_create_table = "create table reviews
                (
                  review_id   int not null primary key,
                  ratings   int null,
                  description   varchar(1000) null,
                  service_id   int not null,
                  FOREIGN KEY (service_id) REFERENCES services(service_id)
                )";

    $result = mysqli_query($conn, $query_create_table);

}

$query = "SELECT * FROM statistics";
$result = mysqli_query($conn, $query);

if(empty($result)){

    $query_create_table = "create table company
                (
                  service_id   int not null,
                  company_id   int not null,
                  visit_count   int not null,
                  last_visited   long not null,
                  url   varchar(255) null,
                  company_id   int not null,
                  FOREIGN KEY (company_id) REFERENCES company(company_id),
                  service_id   int not null,
                  FOREIGN KEY (service_id) REFERENCES services(service_id)
                )";

    $result = mysqli_query($conn, $query_create_table);

}

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}