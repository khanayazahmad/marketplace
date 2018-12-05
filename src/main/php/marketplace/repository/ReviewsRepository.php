<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 3:03 AM
 */

include "../config/dbInit.php";

class ReviewsRepository
{

    private $conn;
    private $serviceRepository;

    function __construct()
    {
        $this->conn = getDBConnection();
        $this->serviceRepository = new ServicesRepository();
    }

    /**
     * @return mixed
     */
    private function getConn()
    {
        return $this->conn;
    }

    function createReview(Review $review){

        $ratings = $review->getRatings();
        $description = $review->getDescription();
        $service_id = $review->getService()->getServiceId();

        $query = "insert into reviews (ratings,description,service_id)
                                values ('$ratings','$description','$service_id')";

        return mysqli_query($this->getConn(), $query );

    }

    function updateReview(Review $review){

        $reviewId = $review->getReviewId();
        $ratings = $review->getRatings();
        $description = $review->getDescription();
        $service_id = $review->getService()->getServiceId();

        $query = "update reviews set ratings = '$ratings', description = '$description', service_id = '$service_id'
                                where review_id = $reviewId";

        return mysqli_query($this->getConn(), $query );

    }


    function getByID($reviewId){

        $review = null;

        $query = "select * from reviews where review_id = $reviewId";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {

            while(($row = mysqli_fetch_assoc($result))){

                $review = new Review($row['review_id'],
                    $row['ratings'],
                    $row['description'],
                    $this->serviceRepository->getByID($row['service_id'])
                );
                break;

            }

        }

        return $review;

    }

    function getByServiceId($serviceId){

        $reviewList = null;

        $query = "select * from reviews where service_id = $serviceId";

        $result = mysqli_query($this->getConn(), $query );



        if (mysqli_num_rows($result)> 0) {

            while(($row = mysqli_fetch_assoc($result))){

                $reviewList += [$row['review_id'] =>
                    new Review($row['review_id'],
                    $row['ratings'],
                    $row['description'],
                    $this->serviceRepository->getByID($row['service_id'])
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

            while(($row = mysqli_fetch_assoc($result))){

                $reviewList += [$row['review_id']
                => (new Review($row['review_id'],
                        $row['ratings'],
                        $row['description'],
                        $this->serviceRepository->getByID($row['service_id'])
                    ))
                ];
                break;

            }

        }

        return $reviewList;

    }


}