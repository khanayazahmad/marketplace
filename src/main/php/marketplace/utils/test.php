<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 7:10 PM
 */
//
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
include_once "../model/Service.php";
//include_once "DBConnectionHandler.php";

//$class = 'Company';
//$company = new $class(1,"cf","some desc","ayazkhan.rocks");
//
//$json = json_encode($company);
//http_response_code(404);
//echo $json;
//$json = '{
//    "serviceId": "1",
//    "name": "freelance",
//    "description": "some desc",
//    "url": "ayazkhan.rocks",
//    "visitCount": "0",
//    "lastVisited": "1",
//    "company": {
//        "companyId": "1",
//        "name": "cf",
//        "description": "some desc",
//        "url": "ayazkhan.rocks"
//    }
//}';
//
////$class = User::class;
////$object = serialize(json_decode());
////$object = preg_replace('@^O:8:"stdClass":@','O:7:"'.$class.'":',$object);
////$object = unserialize($object);
////
////echo "\n".$company->getCompanyId();
//
//$object = new Service(null,null,null,null,null,null,null);
//$object->jsonDecode($json);

$arr =  [1=>[2]];
array_push($arr[1],3) ;

echo sizeof($arr[1]);




