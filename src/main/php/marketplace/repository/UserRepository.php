<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 2:25 AM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/utils/DBConnectionHandler.php";
include_once $_SERVER['DOCUMENT_ROOT']."/model/User.php";

class UserRepository
{

    private $conn;

    function __construct(DBConnectionHandler $dbConnectionHandler)
    {
        $this->conn = $dbConnectionHandler->getConn();
    }

    /**
     * @return mixed
     */
    private function getConn()
    {
        return $this->conn;
    }

    function create(User $user){

        $uname = $user->getUsername();
        $password = $user->getPassword();
        $fname = $user->getFirstName();
        $lname = $user->getLastName();
        $address = $user->getAddress();
        $email = $user->getEmail();
        $phone = $user->getPhone();


        $query = "insert into users (uname, password, fname, lname, address, email, phone)
                                values ('".$uname   ."',
                                        '".$password."',
                                        '".$fname   ."',
                                        '".$lname   ."',
                                        '".$address ."',
                                        '".$email   ."',
                                        '".$phone   ."')";

        return mysqli_query($this->getConn(), $query );

    }

    function update(User $user){

        $uname = $user->getUsername();
        $password = $user->getPassword();
        $fname = $user->getFirstName();
        $lname = $user->getLastName();
        $address = $user->getAddress();
        $email = $user->getEmail();
        $phone = $user->getPhone();

        $query = "update users set 
                 uname    = '".$uname   ."',
                 password = '".$password."',
                 fname    = '".$fname   ."',
                 lname    = '".$lname   ."',
                 address  = '".$address ."',
                 email    = '".$email   ."',
                 phone    = '".$phone   ."'
           where uname    = '".$uname   ."'";

        return mysqli_query($this->getConn(), $query );

    }
    
    
    function getByUsername($username){

        $user = null;

        $query = "select * from users where uname = '".$username."'";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {

            while(($row = mysqli_fetch_assoc($result))){

                $user = new User($row['uname'],
                    $row['password'],
                    $row['fname'],
                    $row['lname'],
                    $row['address'],
                    $row['email'],
                    $row['phone']);
                break;

            }

        }

        return $user;

    }

    function getByFirstName($firstName){

        $userList = null;

        $query = "select * from users where fname = '".$firstName."'";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {
            $userList = [];
            while(($row = mysqli_fetch_assoc($result))){

                $userList += [$row['uname'] => new User($row['uname'],
                    $row['password'],
                    $row['fname'],
                    $row['lname'],
                    $row['address'],
                    $row['email'],
                    $row['phone'])];

            }

        }

        return $userList;

    }

    function getByLastName($lastName){

        $userList = null;

        $query = "select * from users where lname = '".$lastName."'";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {
            $userList = [];
            while(($row = mysqli_fetch_assoc($result))){

                $userList += [$row['uname'] => new User($row['uname'],
                    $row['password'],
                    $row['fname'],
                    $row['lname'],
                    $row['address'],
                    $row['email'],
                    $row['phone'])];

            }

        }

        return $userList;

    }

    function getByFirstNameAndLastName($firstName, $lastName){

        $userList = null;

        $query = "select * from users where lname = '".$lastName."' AND fname = '".$firstName."'";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {
            $userList = [];
            while(($row = mysqli_fetch_assoc($result))){

                $userList += [$row['uname'] => new User($row['uname'],
                    $row['password'],
                    $row['fname'],
                    $row['lname'],
                    $row['address'],
                    $row['email'],
                    $row['phone'])];


            }

        }

        return $userList;

    }

    function getByEmail($email){

        $userList = null;

        $query = "select * from users where email = '".$email."'";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {
            $userList = [];
            while(($row = mysqli_fetch_assoc($result))){

                $userList += [$row['uname'] => new User($row['uname'],
                    $row['password'],
                    $row['fname'],
                    $row['lname'],
                    $row['address'],
                    $row['email'],
                    $row['phone'])];

            }

        }

        return $userList;

    }

    function getByPhone($phone){

        $userList = null;

        $query = "select * from users where phone = '".$phone."'";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {
            $userList = [];
            while(($row = mysqli_fetch_assoc($result))){

                $userList += [$row['uname'] => new User($row['uname'],
                    $row['password'],
                    $row['fname'],
                    $row['lname'],
                    $row['address'],
                    $row['email'],
                    $row['phone'])];


            }

        }

        return $userList;

    }

    function getByAddress($address){

        $userList = null;

        $query = "select * from users where address like '%".$address."%'";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {
            $userList = [];
            while(($row = mysqli_fetch_assoc($result))){

                $userList += [$row['uname'] => new User($row['uname'],
                    $row['password'],
                    $row['fname'],
                    $row['lname'],
                    $row['address'],
                    $row['email'],
                    $row['phone'])];


            }

        }

        return $userList;

    }

    function getAll(){

        $userList = null;

        $query = "select * from users";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {
            $userList = [];
            while(($row = mysqli_fetch_assoc($result))){

                $userList += [$row['uname'] => new User($row['uname'],
                    $row['password'],
                    $row['fname'],
                    $row['lname'],
                    $row['address'],
                    $row['email'],
                    $row['phone'])];

            }

        }

        return $userList;

    }


}