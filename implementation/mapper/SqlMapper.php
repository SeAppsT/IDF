<?php

class SqlMapper implements Mapper {
    private PDO $dbHandler;
    private $mode;
    private $name;

    public function setDbHandler(PDO $dbHandler): void {
        $this -> dbHandler = $dbHandler;
    }

    public function setMode($mode): void {
        $this -> mode = $mode;
    }

    public function getName(){
        return $this -> name;
    }

    public function insert(DataObject $entity){

    }

    public function update(DataObject $entity){

    }

    public function delete(DataObject $entity){

    }

    public function query(Query $query){
        
    }
}