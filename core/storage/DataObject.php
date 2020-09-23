<?php


interface DataObject{
    public function getCredentials();
    public function getFields();
    public function __toString();
    public function getName();
}