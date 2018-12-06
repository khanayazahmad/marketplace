<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 6:37 AM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/repository/UserRepository.php";
include_once $_SERVER['DOCUMENT_ROOT']."/model/user.php";

class UserService
{

    private $userRepository;

    /**
     * UserService constructor.
     * @param $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(User $user){
        return $this->userRepository->create($user);
    }

    public function updateUser(User $user){
        return $this->userRepository->update($user);
    }

    public function getUserByUsername($username){
        return $this->userRepository->getByUsername($username);
    }

    public function getUserByFirstName($firstName){
        return $this->userRepository->getByFirstName($firstName);
    }

    public function getUserByLastName($lastName){
        return $this->userRepository->getByLastName($lastName);
    }

    public function getUserByEmail($email){
        return $this->userRepository->getByEmailId($email);
    }

    public function getUserByPhone($phone){
        return $this->userRepository->getByPhone($phone);
    }

    public function getUserByAddress($address){
        return $this->userRepository->getByAddress($address);
    }

    public function getAllUser(){
        return $this->userRepository->getAll();
    }

}