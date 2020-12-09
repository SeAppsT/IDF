<?php


class Order implements DataObject {

    use BaseDataHelper;
    use Manager;

    private $id;
    private array $products;
    private string $table = 'orders';

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

    public function getCredentials(){
        return ['identifier' => 'id'];
    }

    public function getFields(){
        return ['id' => $this -> id];
    }

    public function __toString(){
        return Order::class;
    }

    public function getName(){
        return $this -> table;
    }

    function setDomain($domain)
    {
        // TODO: Implement setDomain() method.
    }

    function getDomain()
    {
        // TODO: Implement getDomain() method.
    }
}