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
        $string = file_get_contents('php://input');
        $sections = explode('&', $string);
        $params = [];
        foreach ($sections as $section){
            $params[explode('=', $section)[0]] = explode('=', $section)[1];
        }
        return $params[$name];
    }

    public function getModel(string $modelName): object{
        $model = new $modelName();
        $input = file_get_contents('php://input');
        if ($this -> getContentType() == 'application/json')
            return $this -> getJsonModel($model, $input);
        else
            return $this -> getParamModel($model, $input);
    }

    private function getParamModel($model, $string): object{
        $sections = explode('&', $string);
        foreach ($sections as $section){
            $name = explode('=', $section)[0];
            $model -> $name = explode('=', $section)[1];
        }
        return $model;
    }

    private function getJsonModel($model, $input): object{
        $input = json_decode($input);
        foreach (get_object_vars($input) as $key => $value){
            $model -> $key = $value;
        }
        return $model;
    }

    public function queryString(): array {
        return explode('/', $_GET['url']);
    }

    public function collectInformation(RequestHandler $requestHandler): void {
        $this -> vars = $requestHandler -> getVars();
    }

    public function requestBody(){
        return json_decode(file_get_contents('php://input'));
    }

    public function getContentType(){
        return $_SERVER["CONTENT_TYPE"];
    }

    public function getMethod(): string{
        return $_SERVER['REQUEST_METHOD'];
    }
}