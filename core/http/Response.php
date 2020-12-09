<?php


interface Response {
    public function __construct($body, array $args = null);
    public function addHeader($name, $value);
    public function showBody(array $args = null);
}