<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 6:33 AM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/utils/modelUtilities.php";
include_once $_SERVER['DOCUMENT_ROOT']."/service/ServiceService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/model/Service.php";

/**
 * "/service"
 */
class ServiceController
{

    private $serviceService;

    /**
     * ServiceService constructor.
     * @param $serviceService
     */
    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    /**
     * POST : "/create"
     * @param $serviceJson
     * @return boolean
     */
    public function createService($serviceJson){
        $company = new Company(null,null,null,null);
        $service = new Service(null,null,null,null,null,null,$company);
        $service->jsonDecode($serviceJson);
        return $this->serviceService->createService($service);
    }

    /**
     * POST : "/update"
     * @param $serviceJson
     * @return boolean
     */
    public function updateService($serviceJson){
        $company = new Company(null,null,null,null);
        $service = new Service(null,null,null,null,null,null,$company);
        $service->jsonDecode($serviceJson);
        return $this->serviceService->updateService($service);
    }

    /**
     * GET : "/updateStats/{serviceId}"
     * @param $serviceId
     * @return boolean
     */
    public function updateServiceStatisticsById($serviceId){
        return $this->serviceService->updateServiceStatisticsById(intval($serviceId));
    }

    /**
     * GET : "/getById/{serviceId}"
     * @param $serviceId
     * @return string
     */
    public function getServiceById($serviceId){
        $service = $this->serviceService->getServiceById(intval($serviceId));
        return json_encode(["data"=>$service]);
    }

    /**
     * GET : "/getByName/{serviceName}"
     * @param $serviceName
     * @return string
     */
    public function getServiceByName($serviceName){
        $service = $this->serviceService->getServiceByName($serviceName);
        return json_encode(["data"=>$service]);
    }

    /**
     * GET : "/getAll"
     * @return string
     */
    public function getAllService(){
        $serviceList = $this->serviceService->getAllService();
        return json_encode(["data"=>$serviceList], true);
    }

    /**
     * GET : "/getAllByCompanyId"
     * @return string
     */
    function getAllServiceGroupByCompanyId(){
        $serviceList = $this->serviceService->getAllGroupByCompanyId();
        return json_encode(["data"=>$serviceList],true);
    }

}