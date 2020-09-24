<?php


class ProductDataObject implements DataObject {

    use BaseDataHelper;
    use Manager;

    private Product $product;
    private string $name = 'products';

    public function __construct(Product $product = null){
        if ($product != null)
            $this -> product = $product;
    }

    public function setProduct(Product $product): void{
        $this -> product = $product;
    }

    public function getCredentials(){
        return ['identifier' => 'id'];
    }

    public function getFields(){
        return ['id' => $this -> product -> getId(),
                'name' => $this -> product -> getName(),
                'price' => $this -> product -> getPrice(),
                'rating' => $this -> product -> getRating()];
    }

    public function getByName($name){
        return $this -> get() -> search('name', equals($name)) -> go();
    }

    public function __toString(){
        return Product::class;
    }

    public function getName(){
        return $this -> name;
    }
}