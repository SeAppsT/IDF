<?php


class Thing implements DataObject {

    use Manager;
    use BaseDataHelper;

    public $id;
    public $name;
    public $description;
    public $colour;
    public ?User $user;

    public function __construct(){}


    public function getCredentials(){
        return ['identifier' => 'id'];
    }

    public function getFields(){
        return ['id' => $this -> id,
                'name' => $this -> name,
                'description' => $this -> description,
                'user_id' => $this -> user -> id,
                'colour' => $this -> colour];
    }

    public function __toString(){
        return Thing::class;
    }

    public function getName(){
        return 'things';
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