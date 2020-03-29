<?php
require 'core/Source.php';

Source::addMapperImplementation(SqlMapper::class);
Source::addMapperImplementation(JsonMapper::class);
Source::addRequestHandlerImplementation(BaseRequestHandler::class);
// register implementations

Source::build(); // load classes
Source::configure('config.json'); // configure from file

Source::start(new BaseRequest()); // start with specified request class