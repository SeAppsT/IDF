<?php


class DBDto{
    public $query;
    public $params;

    public function __construct($query, $params){
        $this -> query = $query;
        $this -> params = $params;
    }
}