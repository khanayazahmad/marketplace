<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 8:56 PM
 */

/**
 * @param $json
 * @param $class
 * @return mixed|string|string[]|null
 */
function json_decode_object($json, $class){
    $object = serialize(json_decode($json));
    $object = preg_replace('@^O:8:"stdClass":@','O:7:"'.$class.'":',$object);
    $object = unserialize($object);
    return $object;
}