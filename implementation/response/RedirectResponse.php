<?php


class RedirectResponse implements Response {

    private string $path;

    public function __construct($body, array $args = null){
        $this -> path = $body;
        $this -> showBody();
    }

    public function addHeader($name, $value){

    }

    public function showBody(array $args = null){
        header('Location: '.$this -> path);
    }
}