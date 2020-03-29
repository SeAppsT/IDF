<?php


trait BaseDataHelper {

    public function insert($mapperName = 'main'){
        Source::getConnection($mapperName) -> insert($this);
    }

    public function update($mapperName = 'main'){
        Source::getConnection($mapperName) -> update($this);
    }

    public function delete($mapperName = 'main'){
        Source::getConnection($mapperName) -> delete($this);
    }
}