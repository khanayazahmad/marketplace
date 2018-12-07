<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/6/2018
 * Time: 12:50 PM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/controller/CompanyController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/controller/ReviewController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/controller/ServiceController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/controller/UserController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/service/CompanyService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/service/ReviewService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/service/ServiceService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/service/UserService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/repository/CompanyRepository.php";
include_once $_SERVER['DOCUMENT_ROOT']."/repository/ReviewRepository.php";
include_once $_SERVER['DOCUMENT_ROOT']."/repository/ServiceRepository.php";
include_once $_SERVER['DOCUMENT_ROOT']."/repository/UserRepository.php";
include_once $_SERVER['DOCUMENT_ROOT']."/utils/DBConnectionHandler.php";

class APIHandler
{

    public static function parseURI($requestMethod, $uri){
        $uriComponents = explode("/", $uri);

        $uriMap = [
            "requestMethod" => $requestMethod,
            "controller" => $uriComponents[1],
            "method" => $uriComponents[2],
            "params" => []
        ];

        for($index = 3; $index < sizeof($uriComponents); $index++){
            $uriMap["params"] += [str_replace("%20"," ",$uriComponents[$index])];
        }

        return $uriMap;
    }

    public static function executeAPI($requestMethod, $uri){

        $dbConnectionHandler = new DBConnectionHandler();

        $uri_map = self::parseURI($requestMethod, $uri);

        $api_map = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT']."/utils/api_endpoint_map.json"),true);

        $controllerName = $api_map[$uri_map["controller"]]["name"];
        $method = $api_map[$uri_map["controller"]]["methods"][$uri_map["method"]];

        $class = $controllerName."Repository";
        $repository = new $class($dbConnectionHandler);

        $class = $controllerName."Service";
        $service = new $class($repository);

        $class = $controllerName."Controller";
        $controller = new $class($service);


            if ($requestMethod == "GET") {

                if (sizeof($uri_map["params"]) == 0) {
                    if (is_callable(array($controller, $method))){

                        $response = $controller->$method();

                        if($response){
                            return array("response"=>$response, "status"=>200);

                        }else{
                            return ["response"=>json_encode(["message"=>"Not Found"]), "status"=>404];

                        }
                    }else{
                        return ["response"=>json_encode(["message"=>"Incorrect API Call"]), "status"=>400];
                    }
                }else if(sizeof($uri_map["params"]) == 1){
                    if (is_callable(array($controller, $method))){

                        $response = $controller->$method($uri_map["params"][0]);

                        if($response){
                            return array("response"=>$response, "status"=>200);

                        }else{
                            return ["response"=>json_encode(["message"=>"Not Found"]), "status"=>404];

                        }
                    }else{
                        return ["response"=>json_encode(["message"=>"Incorrect API Call"]), "status"=>400];
                    }
                }
            }else if($requestMethod == "POST"){
                if (is_callable(array($controller, $method))){
                    $input = file_get_contents('php://input');
                    $response = $controller->$method($input);

                    if($response){
                        return ["response"=>json_encode(["message"=>"Success"]), "status"=>200];
                    }else{
                        return ["response"=>json_encode(["message"=>"Failure"]), "status"=>417];
                    }

                }else{
                    return ["response"=>json_encode(["message"=>"Incorrect API Call"]), "status"=>400];
                }
            }

    }


}