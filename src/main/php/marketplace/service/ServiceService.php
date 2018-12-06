<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 6:38 AM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/repository/ServiceRepository.php";
include_once $_SERVER['DOCUMENT_ROOT']."/model/Service.php";

class ServiceService
{

    private $serviceRepository;

    /**
     * ServiceService constructor.
     * @param $serviceRepository
     */
    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function createService(Service $service){
        return $this->serviceRepository->create($service);
    }

    public function updateService(Service $service){
        return $this->serviceRepository->update($service);
    }

    public function updateServiceStatisticsById($serviceId){
        $last_visited = time();
        $visit_count_incr = 1;
        return $this->serviceRepository->updateServiceLastVisitedAndVisitCountById($serviceId,
                                                                                   $last_visited,
                                                                                   $visit_count_incr);
    }

    public function getServiceById($serviceId){
        return $this->serviceRepository->getByID($serviceId);
    }

    public function getServiceByName($serviceName){
        return $this->serviceRepository->getByName($serviceName);
    }

    public function getAllService(){
        return $this->serviceRepository->getAll();
    }

}