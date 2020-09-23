<?php

class JsonResponse implements Response {

    private $object;

    public function __construct(string $body, array $args = null){
        $this -> object = $body;
        $this -> showBody($args);
    }

    public function addHeader($name, $value){
        header($name, $value);
    }

    public function showBody(array $args = null){
        http_send_content_type('application/json');
        echo json_decode($this -> object);
    }
}