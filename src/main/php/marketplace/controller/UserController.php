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

/**
 * "/user"
 */
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

    /**
     * POST : "/create"
     * @param $userJson
     * @return boolean
     */
    public function createUser($userJson){
        $user = new User(null,null,null,null,null,null,null);
        $user->jsonDecode($userJson);
        return $this->userService->createUser($user);
    }

    /**
     * POST : "/update"
     * @param $userJson
     * @return boolean
     */
    public function updateUser($userJson){
        $user = new User(null,null,null,null,null,null,null);
        $user->jsonDecode($userJson);
        return $this->userService->updateUser($user);
    }

    /**
     * GET : "/getByUsername/{username}"
     * @param $username
     * @return string
     */
    public function getUserByUsername($username){
        $user = $this->userService->getUserByUsername($username);
        return json_encode($user);
    }

    /**
     * GET : "/getByFirstName/{firstName}"
     * @param $firstName
     * @return string
     */
    public function getUserByFirstName($firstName){
        $userList = $this->userService->getUserByFirstName($firstName);
        return json_encode($userList,true);
    }

    /**
     * GET : "/getByLastName/{lastName}"
     * @param $lastName
     * @return string
     */
    public function getUserByLastName($lastName){
        $userList = $this->userService->getUserByLastName($lastName);
        return json_encode($userList,true);
    }

    /**
     * GET : "/getByEmail/{email}"
     * @param $email
     * @return string
     */
    public function getUserByEmail($email){
        $userList = $this->userService->getUserByEmail($email);
        return json_encode($userList, true);
    }

    /**
     * GET : "/getByPhone/{phone}"
     * @param $phone
     * @return string
     */
    public function getUserByPhone($phone){
        $userList = $this->userService->getUserByPhone($phone);
        return json_encode($userList, true);
    }

    /**
     * GET : "/getByAddress/{address}"
     * @param $address
     * @return string
     */
    public function getUserByAddress($address){
        $userList = $this->userService->getUserByAddress($address);
        return json_encode($userList, true);
    }

    /**
     * GET : "/getAll"
     * @return string
     */
    public function getAllUser(){
        echo "reached User Controller";

        $userList = $this->userService->getAllUser();
        return json_encode($userList, true);
    }
}