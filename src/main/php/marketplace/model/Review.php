<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 2:41 AM
 */

include_once "Service.php";
include_once "User.php";

class Review implements JsonSerializable
{

    private $reviewId;
    private $ratings;
    private $description;
    private $service;
    private $user;

    /**
     * Review constructor.
     * @param $reviewId
     * @param $ratings
     * @param $description
     * @param $service
     * @param $user
     */
    public function __construct($reviewId, $ratings, $description, Service $service, User $user)
    {
        $this->reviewId = $reviewId;
        $this->ratings = $ratings;
        $this->description = $description;
        $this->service = $service;
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getReviewId()
    {
        return $this->reviewId;
    }

    /**
     * @param mixed $reviewId
     */
    public function setReviewId($reviewId)
    {
        $this->reviewId = $reviewId;
    }

    /**
     * @return mixed
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * @param mixed $ratings
     */
    public function setRatings($ratings)
    {
        $this->ratings = $ratings;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param Service $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }



    public function jsonSerialize()
    {
        return [
            "reviewId" => $this->getReviewId(),
            "ratings" => $this->getRatings(),
            "description" => $this->getDescription(),
            "service" => $this->getService()->jsonSerialize(),
            "user" => $this->getUser()->jsonSerialize()
        ];
    }

    public function jsonDecode($json){
        $data = json_decode($json,true);
        $this->reviewId    = $data['reviewId'];
        $this->ratings     = $data['ratings'];
        $this->description = $data['description'];
        $company = new Company(null,null,null,null);
        $this->service = new Service(null, null,null,null,null,null,$company);
        $this->service->jsonDecode(json_encode($data['service']));
        $this->user = new User(null,null,null,null,null,null,null);
        $this->user->jsonDecode(json_encode($data['user']));
    }


}