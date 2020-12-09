<?php


trait BaseDataHelper {

    public function insert($mapperName = 'main'){
        Shopin::getConnection($mapperName) -> insert($this);
    }

    public function update($mapperName = 'main'){
        Shopin::getConnection($mapperName) -> update($this);
    }

    public function delete($mapperName = 'main'){
        Shopin::getConnection($mapperName) -> delete($this);
    }
}