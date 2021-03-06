<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 2:30 AM
 */

include_once "Company.php";

class Service implements JsonSerializable
{

    private $serviceId;
    private $name;
    private $description;
    private $url;
    private $visitCount;
    private $lastVisited;
    private $company;

    /**
     * Service constructor.
     * @param $serviceId
     * @param $name
     * @param $description
     * @param $url
     * @param $visitCount
     * @param $lastVisited
     * @param $company
     */
    public function __construct($serviceId, $name, $description, $url, $visitCount, $lastVisited, Company $company)
    {
        $this->serviceId = $serviceId;
        $this->name = $name;
        $this->description = $description;
        $this->url = $url;
        $this->visitCount = $visitCount;
        $this->lastVisited = $lastVisited;
        $this->company = $company;
    }

    /**
     * Service constructor.
     * @param $serviceId
     * @param $name
     * @param $description
     * @param $url
     * @param $company
     */


    /**
     * @return mixed
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * @param mixed $serviceId
     */
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return mixed
     */
    public function getVisitCount()
    {
        return $this->visitCount;
    }

    /**
     * @param mixed $visitCount
     */
    public function setVisitCount($visitCount)
    {
        $this->visitCount = $visitCount;
    }

    /**
     * @return mixed
     */
    public function getLastVisited()
    {
        return $this->lastVisited;
    }

    /**
     * @param mixed $lastVisited
     */
    public function setLastVisited($lastVisited)
    {
        $this->lastVisited = $lastVisited;
    }

    /**
     * @param Company $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    public function jsonSerialize()
    {
        return [
            "serviceId" => $this->getServiceId(),
            "name" => $this->getName(),
            "description" => $this->getDescription(),
            "url" => $this->getUrl(),
            "visitCount" => $this->getVisitCount(),
            "lastVisited" => $this->getLastVisited(),
            "company" => $this->getCompany()->jsonSerialize()
        ];
    }

    public function jsonDecode($json){
        $data = json_decode($json,true);
        $this->serviceId   = $data['serviceId'];
        $this->name        = $data['name'];
        $this->description = $data['description'];
        $this->url         = $data['url'];
        $this->visitCount  = $data['visitCount'];
        $this->lastVisited = $data['lastVisited'];
        $this->company = new Company(null,null,null,null);
        $this->company->jsonDecode(json_encode($data['company']));
    }


}