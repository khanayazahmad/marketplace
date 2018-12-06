<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 6:33 AM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/utils/modelUtilities.php";
include_once $_SERVER['DOCUMENT_ROOT']."/service/UserService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/model/User.php";

class UserController
{

    private $userService;

    /**
     * UserService constructor.
     * @param $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser($user){
        $user = json_decode_object($user, User::class);
        return $this->userService->createUser($user);
    }

    public function updateUser($user){
        $user = json_decode_object($user, User::class);
        return $this->userService->updateUser($user);
    }

    public function getUserByUsername($username){
        $user = $this->userService->getUserByUsername($username);
        return json_encode($user);
    }

    public function getUserByFirstName($firstName){
        $userList = $this->userService->getByFirstName($firstName);
        return json_encode($userList,true);
    }

    public function getUserByLastName($lastName){
        $userList = $this->userService->getByLastName($lastName);
        return json_encode($userList,true);
    }

    public function getUserByEmail($email){
        $userList = $this->userService->getByEmailId($email);
        return json_encode($userList, true);
    }

    public function getUserByPhone($phone){
        $userList = $this->userService->getByPhone($phone);
        return json_encode($userList, true);
    }

    public function getUserByAddress($address){
        $userList = $this->userService->getByAddress($address);
        return json_encode($userList, true);
    }
}