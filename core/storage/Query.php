<?php

class Query {
    private $action;
    private $conditions;
    private $changes;
    private DataObject $entity;
    private $subQueries = [];

    public function __construct($action, $entity){
        $this -> action = $action;
        $this -> entity = $entity;
    }

    public function where($field, array $value){
        $this -> conditions[$field] = $value;
        return $this;
    }

    public function set($field, $value){
        $this -> changes[$field] = $value;
    }

    public function add(Query $query, $field = 'id'){
        $this -> subQueries[] = $query;
    }

    public function go($connection_name = 'main'){
        return Source::getConnection($connection_name) -> query($this);
    }

    public function getAction(){
        return $this->action;
    }

    public function getConditions(){
        return $this->conditions;
    }

    public function getChanges(){
        return $this->changes;
    }

    public function getEntity(): DataObject{
        return $this->entity;
    }

    public function getSubQueries(): array{
        return $this->subQueries;
    }
}