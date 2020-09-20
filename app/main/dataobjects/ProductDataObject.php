<?php


class ProductDataObject implements DataObject {

    use BaseDataHelper;
    use Manager;

    private Product $product;
    private string $xml_path = '/output/xml/productCache.xml';

    public function __construct(Product $product){
        $this -> product = $product;
    }

    public function setProduct(Product $product): void{
        $this -> product = $product;
    }

    public function getCredentials(){
        return ['table' => $this -> product -> getTable(),
                'xml_path' => $this -> xml_path,
                'identifier' => 'id'];
    }

    public function getFields(){
        return ['id' => $this -> product -> getId(),
                'name' => $this -> product -> getName(),
                'price' => $this -> product -> getPrice(),
                'rating' => $this -> product -> getRating()];
    }

    public function getByName($name){
        return $this -> get() -> where('name', $name) -> go();
    }

    public function __toString(){
        return Product::class;
    }
}