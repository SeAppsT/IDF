<?php


class DBDto{
    public string $query;
    public array $params;

    public function __construct($query, $params){
        $this -> query = $query;
        $this -> params = $params;
    }
}