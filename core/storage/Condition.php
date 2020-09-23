<?php


class Condition{
    private AiQuery $condition;
    private AiQuery $action;
    private AiQuery $parent;

    public function __construct(AiQuery $condition, AiQuery $parent){
        $this -> condition = $condition;
        $this -> parent = $parent;
    }

    public function then(AiQuery $action): AiQuery{
        $this -> action = $action;
        return $this -> parent;
    }
}