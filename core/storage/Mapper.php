<?php


interface Mapper{
    public function insert(DataObject $entity);
    public function update(DataObject $entity);
    public function delete(DataObject $entity);
    public function query(Query $query);
    public function getName();
}