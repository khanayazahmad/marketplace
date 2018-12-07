<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/4/2018
 * Time: 11:59 PM
 */


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once $_SERVER['DOCUMENT_ROOT']."/utils/APIHandler.php";

$url = $_SERVER['REQUEST_URI'];

$responseEntity = APIHandler::executeAPI($_SERVER['REQUEST_METHOD'],$_SERVER['REQUEST_URI']);

http_response_code($responseEntity['status']);
echo $responseEntity['response'];


