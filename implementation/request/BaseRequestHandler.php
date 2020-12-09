<?php

class BaseRequestHandler implements RequestHandler {
    private array $path;
    private array $methods = Array();
    public Closure $action;
    private array $accesses = Array();
    private array $vars = Array();

    public function setPath($path): RequestHandler {
        $pattern = '/\{(.+?)\}/';
        preg_match_all($pattern, substr($path,0), $matches);
        $this -> path = explode('/', $path);
        foreach ($matches[1] as $match){
            $this -> vars[$match] = '';
        }
        return $this;
    }

    public function __construct(){}

    public function addMethod($method): RequestHandler {
        $this -> methods[] = $method;
        return $this;
    }

    public function addAccess($access): RequestHandler {
        $this -> accesses[] = $access;
        return $this;
    }

    public function setAction(Closure $action){
       $this -> action = $action;
       return $this;
    }

    public function isItOk(array $queryString): bool {
        $result = Array();
        $i = 0;

        if (count($queryString) != count($this -> path))
            return false;
        while ($queryString[$i] != null && $this -> path[$i] != null){
            if ($this -> path[$i] == $queryString[$i] || preg_match('/{/ui', $this -> path[$i])){
                $result[] = true;
                foreach ($this -> vars as $key => $value) {
                    if ($this -> path[$i] == '{'.$key.'}')
                        $this -> vars[$key] = $queryString[$i];
                }
            } else
                $result[] = false;
            $i++;
        }
        $res = true;
        foreach ($result as $value){
            if ($value == false){
                return false;
            }
        }
        if (!empty($this -> methods)) {
            if (!in_array($_SERVER['REQUEST_METHOD'], $this -> methods))
                return false;
        }
        return $res;
    }

    public function getVars(): array {
        return $this -> vars;
    }
}