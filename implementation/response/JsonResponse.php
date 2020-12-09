<?php

class JsonResponse implements Response {

    private $object;

    public function __construct($body, array $args = null){
        $this -> object = $body;
        $this -> addHeader('Content-Type', 'application/json');
        $this -> showBody($args);
    }

    public function addHeader($name, $value){
        header($name.': '.$value);
    }

    public function showBody(array $args = null){
        echo json_encode($this -> object);
    }
}