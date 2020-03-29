<?php


class ProductDataObject implements DataObject {

    use BaseDataHelper;
    use Manager;

    private Product $product;
    private string $xml_path = '/output/xml/productCache.xml';

    public function setProduct(Product $product): void{
        $this -> product = $product;
    }

    public function getCredentials(){
        return ['table' => $this -> product -> getTable(),
                'xml_path' => $this -> xml_path];
    }

    public function getFields(){
        return ['name' => $this -> product -> getName(),
                'price' => $this -> product -> getPrice()];
    }

    public function getByName($name){
        return $this -> get() -> where('name', $name) -> go();
    }
}