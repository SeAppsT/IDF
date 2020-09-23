<?php


class HttpSession implements Session {

    public function get(string $key){
        return $_SESSION[$key];
    }

    public function put(string $key, $value){
        $_SESSION[$key] = $value;
    }

    public function setCredentials(array $credentials){

    }
}