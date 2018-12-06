<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 2:34 AM
 */


class Company implements JsonSerializable
{
    private $companyId;
    private $name;
    private $description;
    private $url;

    /**
     * Company constructor.
     * @param $companyId
     * @param $name
     * @param $description
     * @param $url
     */
    public function __construct($companyId, $name, $description, $url)
    {
        $this->companyId = $companyId;
        $this->name = $name;
        $this->description = $description;
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @param mixed $companyId
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;
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

    public function jsonSerialize()
    {
        return [
            "companyId" => $this->getCompanyId(),
            "name" => $this->getName(),
            "description" => $this->getDescription(),
            "url" => $this->getUrl()
        ];
    }


}