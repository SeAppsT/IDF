<?php

class PageResponse implements Response {

    private $path;

    public function __construct($body){
        $this -> path = $body;
        $this -> showBody();
    }

    public function addHeader($name, $value){
        // TODO: Implement addHeader() method.
    }

    public function showBody(array $args = null){
        if ($args != null)
            extract($args);
        require_once 'app/'.$this -> path;
    }
}