<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 6:38 AM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/repository/ReviewRepository.php";
include_once $_SERVER['DOCUMENT_ROOT']."/model/Review.php";

class ReviewService
{

    private $reviewRepository;

    /**
     * ReviewService constructor.
     * @param $reviewRepository
     */
    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function createReview(Review $review){
        return $this->reviewRepository->create($review);
    }

    public function updateReview(Review $review){
        return $this->reviewRepository->update($review);
    }

    public function getReviewById($reviewId){
        return $this->reviewRepository->getByID($reviewId);
    }

    public function getReviewByServiceId($serviceId){
        return $this->reviewRepository->getByServiceId($serviceId);
    }

    public function getAllReview(){
        return $this->reviewRepository->getAll();
    }


}