<?php

class BaseRequest implements Request {

    private array $vars;

    public function queryParam(string $name): string{
        return $_GET[$name];
    }

    public function pathVariable(string $name): string{
        return $this -> vars[$name];
    }

    public function bodyParam(string $name){
        return file_get_contents('php://input');
    }

    public function queryString(): array {
        return explode('/', $_GET['url']);
    }

    public function collectInformation(RequestHandler $requestHandler): void {
        $this -> vars = $requestHandler -> getVars();
    }

    public function requestBody(){
        return file_get_contents('php://input');
    }
}