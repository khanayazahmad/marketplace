<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 7:10 PM
 */

include "../model/Company.php";
$company = new Company(1,"a","b","c");

$json = json_encode($company);

echo $json;
$class = "Company";
$object = serialize(json_decode($json));
$object = preg_replace('@^O:8:"stdClass":@','O:7:"'.$class.'":',$object);
$object = unserialize($object);

echo "\n".$company->getCompanyId();
