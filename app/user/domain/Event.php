<?php


class Event implements DataObject {
    private int $id;
    private Thing $thing;


    public function getCredentials(){
        return ['identifier' => 'id'];
    }

    public function getFields(){
        return ['id' => $this -> id,
                'thing_id' => $this -> thing -> id];
    }

    public function __toString(){
        return Event::class;
    }

    public function getName(){
        return 'events';
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