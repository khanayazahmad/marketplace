<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 3:03 AM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/utils/DBConnectionHandler.php";
include_once $_SERVER['DOCUMENT_ROOT']."/model/Review.php";
include_once "ServiceRepository.php";
include_once "UserRepository.php";

class ReviewRepository
{

    private $conn;
    private $serviceRepository;
    private $userRepository;

    function __construct(DBConnectionHandler $dbConnectionHandler)
    {
        $this->conn = $dbConnectionHandler->getConn();
        $this->serviceRepository = new ServiceRepository($dbConnectionHandler);
        $this->userRepository = new UserRepository($dbConnectionHandler);
    }

    /**
     * @return mixed
     */
    private function getConn()
    {
        return $this->conn;
    }

    function create(Review $review){

        $ratings = $review->getRatings();
        $description = $review->getDescription();
        $service_id = $review->getService()->getServiceId();
        $uname = $review->getUser()->getUsername();

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $query = "insert into reviews (ratings,description,service_id, uname)
                                values ('".$ratings."','". $description."','". $service_id."','".$uname."')";

        return mysqli_query($this->getConn(), $query );

    }

    function update(Review $review){

        $reviewId = $review->getReviewId();
        $ratings = $review->getRatings();
        $description = $review->getDescription();
        $service_id = $review->getService()->getServiceId();
        $uname = $review->getUser()->getUsername();

        $query = "update reviews set ratings = ".$ratings.",description = '".$description."', service_id = '".$service_id."', uname = '".$uname."'
                                where review_id =". $reviewId;

        return mysqli_query($this->getConn(), $query );

    }


    function getByID($reviewId){

        $review = null;

        $query = "select * from reviews where review_id = ".$reviewId;

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {

            while(($row = mysqli_fetch_assoc($result))){

                $review = new Review($row['review_id'],
                    $row['ratings'],
                    $row['description'],
                    $this->serviceRepository->getByID($row['service_id']),
                    $this->userRepository->getByUsername($row['uname'])
                );
                break;

            }

        }

        return $review;

    }

    function getByServiceId($serviceId){

        $reviewList = null;

        $query = "select * from reviews where service_id =". $serviceId." order by ratings ";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {
            $reviewList = [];
            while(($row = mysqli_fetch_assoc($result))){

                $reviewList += [$row['review_id'] =>
                    new Review($row['review_id'],
                    $row['ratings'],
                    $row['description'],
                    $this->serviceRepository->getByID($row['service_id']),
                        $this->userRepository->getByUsername($row['uname'])
                )];

            }

        }

        return $reviewList;

    }

    function getAll(){

        $reviewList = null;

        $query = "select * from reviews";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {
            $reviewList = [];
            while(($row = mysqli_fetch_assoc($result))){

                $reviewList += [$row['review_id']
                => (new Review($row['review_id'],
                        $row['ratings'],
                        $row['description'],
                        $this->serviceRepository->getByID($row['service_id']),
                        $this->userRepository->getByUsername($row['uname'])
                    ))
                ];


            }

        }

        return $reviewList;

    }


}