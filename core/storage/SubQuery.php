<?php


class SubQuery {
    private Query $query;
    private string $type;
    private string $field;

    public function __construct(Query $query, string $type, string $field){
        $this -> query = $query;
        $this -> type = $type;
        $this -> field = $field;
    }


}