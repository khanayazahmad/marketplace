<?php
/**
 * Created by PhpStorm.
 * User: kayaz
 * Date: 12/5/2018
 * Time: 1:34 AM
 */

$config = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT']."/config.json"),true);

function getDBConfig(){

    return $GLOBALS['config']['db_config'];

}

function getServerConfig(){

    return $GLOBALS['config']['server_config'];

}