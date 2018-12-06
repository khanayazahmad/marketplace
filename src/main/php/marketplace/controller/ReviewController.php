<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 6:35 AM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/utils/modelUtilities.php";
include_once $_SERVER['DOCUMENT_ROOT']."/service/ReviewService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/model/Review.php";

/**
 * "/review"
 */
class ReviewController
{
    
    private $reviewService;

    /**
     * ReviewController constructor.
     * @param $reviewService
     */
    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    /**
     * POST : "/create"
     * @param $review
     * @return boolean
     */
    public function createReview($review){
        $review = json_decode_object($review, Review::class);
        return $this->reviewService->createReview($review);

    }

    /**
     * POST : "/update"
     * @param $review
     * @return boolean
     */
    public function updateReview($review){
        $review = json_decode_object($review, Review::class);
        return $this->reviewService->updateReview($review);
    }

    /**
     * GET : "/getById/{reviewId}"
     * @param $reviewId
     * @return string
     */
    public function getReviewById($reviewId){
        $review = $this->reviewService->getReviewById($reviewId);
        return json_encode($review);
    }

    /**
     * GET : "/getByServiceId/{serviceId}"
     * @param $serviceId
     * @return string
     */
    public function getReviewByServiceId($serviceId){
        $review = $this->reviewService->getReviewByServiceId($serviceId);
        return json_encode($review);
    }

    /**
     * GET : "/getAll"
     * @return string
     */
    public function getAllReview(){
        $reviewList = $this->reviewService->getAllReview();
        return json_encode($reviewList,true);
    }

}