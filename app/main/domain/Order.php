<?php


class Order{
    private $id;
    private array $products;

    public function getId(){
        return $this -> id;
    }

    public function setId($id){
        $this -> id = $id;
    }

    public function getProducts(){
        return $this -> products;
    }

    public function addProductToCart(Product $product){
        $this -> products[] = $product;
    }
}