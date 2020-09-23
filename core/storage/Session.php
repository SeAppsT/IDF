<?php


interface Session {
    public function get(string $key);
    public function put(string $key, $value);
    public function setCredentials(array $credentials);
}