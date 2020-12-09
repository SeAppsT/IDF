<?php

require_once 'core/http/RestApi.php';
require_once 'implementation/restapi/BaseRestApi.php';
require_once 'app/user/dataobjects/UserDataObject.php';

$restApi = new BaseRestApi();
$restApi -> setContextPath('user');
$restApi -> setDataObject(new UserDataObject());

Shopin::addRestApi($restApi);