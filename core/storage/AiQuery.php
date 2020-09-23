<?php


class AiQuery{

    private array $conditions;
    private DataObject $dataObject;

    public function __construct(DataObject $dataObject){
        $this -> dataObject = $dataObject;
    }

    public static function start(DataObject $dataObject){
        return new AiQuery($dataObject);
    }

    public function where(string $field, array $value){
        return $this;
    }

    public function in(string $field){
        return $this;
    }

    public function cond(AiQuery $condition): Condition{
        $this -> conditions[] = new Condition($condition, $this);
        return $this -> conditions[count($this -> conditions) - 1];
    }

    public function del(AiQuery $query = null){
        return $this;
    }

    public function alias(){
        
    }
}