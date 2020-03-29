<?php


interface Response {
    public function __construct($body);
    public function addHeader($name, $value);
    public function showBody(array $args = null);
}