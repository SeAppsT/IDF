<?php

class PageResponse implements Response {

    private $path;

    public function __construct(string $body, array $args = null){
        $this -> path = $body;
        $this -> showBody($args);
    }

    public function addHeader($name, $value){

    }

    public function showBody(array $args = null){
        if ($args != null)
            extract($args);
        require_once 'app/'.$this -> path;
    }
}