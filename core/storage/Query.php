<?php

class Query {
    private string $action;
    private array $conditions = [];
    private array $changes;
    private DataObject $entity;
    private array $subQueries = [];
    private string $connection_name;

    public function __construct($action, $entity){
        $this -> action = $action;
        $this -> entity = $entity;
    }

    public function search($field, array $value){
        $this -> conditions[$field] = $value;
        return $this;
    }

    public function set($field, $value){
        $this -> changes[$field] = $value;
        return $this;
    }

    public function in(string $field, Query $query){
        $this -> subQueries[] = new SubQuery($query, 'in', $field);
        return $this;
    }

    public function out(string $field, Query $query){
        $this -> subQueries[] = new SubQuery($query, 'out', $field);
        return $this;
    }

    public function go($connection_name = 'main'){
        $this -> connection_name = $connection_name;
        return Shopin::getConnection($this -> connection_name) -> query($this);
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

    public function getConnectionName(): string{
        return $this -> connection_name;
    }
}