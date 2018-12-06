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

    public function createService($service){
        $service = json_decode_object($service, Service::class);
        return $this->serviceService->createService($service);
    }

    public function updateService(Service $service){
        $service = json_decode_object($service, Service::class);
        return $this->serviceService->updateService($service);
    }

    public function updateServiceStatisticsById($serviceId){
        return $this->serviceService->updateServiceStatisticsById($serviceId);
    }

    public function getServiceById($serviceId){
        $service = $this->serviceService->getServiceById($serviceId);
        return json_encode($service);
    }

    public function getServiceByName($serviceName){
        $service = $this->serviceService->getServiceByName($serviceName);
        return json_encode($service);
    }

    public function getAllService(){
        $serviceList = $this->serviceService->getAll();
        return json_encode($serviceList,true);
    }

}