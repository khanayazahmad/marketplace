<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 2:25 AM
 */

class User implements JsonSerializable
{
    private $username;
    private $password;
    private $firstName;
    private $lastName;
    private $address;
    private $email;
    private $phone;

    /**
     * User constructor.
     * @param $username
     * @param $password
     * @param $firstName
     * @param $lastName
     * @param $address
     * @param $email
     * @param $phone
     */
    public function __construct($username, $password, $firstName, $lastName, $address, $email, $phone)
    {
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->email = $email;
        $this->phone = $phone;
    }


    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function jsonSerialize()
    {
        return [
            "username" => $this->getUsername(),
            "password" => $this->getPassword(),
            "firstName" => $this->getFirstName(),
            "lastName" => $this->getLastName(),
            "address" => $this->getAddress(),
            "email" => $this->getEmail(),
            "phone" => $this->getPhone()
        ];
    }

    public function jsonDecode($json)
    {
        $data = json_decode($json, true);
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        $this->address = $data['address'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
    }


}