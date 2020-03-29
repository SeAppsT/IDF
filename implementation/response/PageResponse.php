<?php

class PageResponse implements Response {

    private $path;

    public function __construct($body){
        $this -> path = $body;
    }

    public function addHeader($name, $value){
        // TODO: Implement addHeader() method.
    }

    public function showBody(array $args = null){
        require_once $this -> path;
    }
}