<?php
require 'core/Shopin.php';

Shopin::addMapperImplementation(SqlMapper::class);
Shopin::addMapperImplementation(JsonMapper::class);
Shopin::addRequestHandlerImplementation(BaseRequestHandler::class);
Shopin::addSessionImplementation(HttpSession::class);
// register implementations

Shopin::build(); // load classes
Shopin::configure('config.json'); // configure from file

Shopin::start(new BaseRequest()); // start with specified request class