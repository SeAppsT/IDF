<?php

class JsonMapper implements Mapper {

    private string $pathToDir;

    public function getPathToDir(): string{
        return $this -> pathToDir;
    }

    public function setPathToDir(string $pathToDir): void{
        $this -> pathToDir = $pathToDir;
    }

    public function query(Query $query){

    }

    public function insert(DataObject $entity){
        // TODO: Implement insert() method.
    }

    public function update(DataObject $entity){
        // TODO: Implement update() method.
    }

    public function delete(DataObject $entity){
        // TODO: Implement delete() method.
    }

    public function getName(){
        return 'json';
    }
}