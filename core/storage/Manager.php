<?php


trait Manager{

    public function get($fields = '*'){
        return new Query('get', $this);
    }

    public function one($fields = '*'){
        return new Query('one', $this);
    }

    public function upd(){
        return new Query('upd', $this);
    }

    public function del(){
        return new Query('del', $this);
    }
}