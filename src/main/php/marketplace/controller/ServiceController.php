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
     * @param $service
     * @return boolean
     */
    public function createService($service){
        $service = json_decode_object($service, Service::class);
        return $this->serviceService->createService($service);
    }

    /**
     * POST : "/update"
     * @param $service
     * @return boolean
     */
    public function updateService(Service $service){
        $service = json_decode_object($service, Service::class);
        return $this->serviceService->updateService($service);
    }

    /**
     * GET : "/update/{serviceId}"
     * @param $serviceId
     * @return boolean
     */
    public function updateServiceStatisticsById($serviceId){
        return $this->serviceService->updateServiceStatisticsById($serviceId);
    }

    /**
     * GET : "/getById/{serviceId}"
     * @param $serviceId
     * @return string
     */
    public function getServiceById($serviceId){
        $service = $this->serviceService->getServiceById($serviceId);
        return json_encode($service);
    }

    /**
     * GET : "/getByName/{serviceName}"
     * @param $serviceName
     * @return string
     */
    public function getServiceByName($serviceName){
        $service = $this->serviceService->getServiceByName($serviceName);
        return json_encode($service);
    }

    /**
     * GET : "/getAll"
     * @return string
     */
    public function getAllService(){
        $serviceList = $this->serviceService->getAll();
        return json_encode($serviceList,true);
    }

}