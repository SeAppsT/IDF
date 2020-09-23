<?php

class JsonResponse implements Response {

    private $object;

    public function __construct($body){
        $this -> object = $body;
        $this -> showBody();
    }

    public function addHeader($name, $value){
        header($name, $value);
    }

    public function showBody(array $args = null){
        http_send_content_type('application/json');
        echo json_decode($this -> object);
    }
}