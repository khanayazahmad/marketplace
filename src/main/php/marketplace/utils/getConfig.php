<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 1:34 AM
 */

$config = json_decode(file_get_contents("../../utils.json"),true);

function getDBConfig(){

    return $GLOBALS['utils']['db_config'];

}

function getServerConfig(){

    return $GLOBALS['utils']['server_config'];

}