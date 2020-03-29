<?php


interface RequestHandler {
    public function setPath($path): RequestHandler;
    public function __construct();
    public function setAction(Closure $action);
    public function addMethod($method): RequestHandler;
    public function isItOk(array $queryString): bool;
    public function getVars(): array;
}