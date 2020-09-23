<?php

class Product {
    private $id;
    private $price;
    private $name;
    private $rating;

    public function addToCart(Order $order){
        $order -> addProductToCart($this);
        $this -> id = $order -> getId();
    }

    public function getId(){
        return $this -> id;
    }

    public function getPrice(){
        return $this -> price;
    }

    public function getName(){
        return $this -> name;
    }

    public function getRating(){
        return $this->rating;
    }

    public function setId($id): void{
        $this -> id = $id;
    }

    public function setTable($table): void{
        $this -> table = $table;
    }

    public function setPrice($price): void{
        $this -> price = $price;
    }

    public function setName($name): void{
        $this -> name = $name;
    }

    public function setRating($rating): void{
        $this->rating = $rating;
    }
}