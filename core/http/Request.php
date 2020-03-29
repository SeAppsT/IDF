<?php


interface Request{
    public function queryParam(string $name): string;
    public function pathVariable(string $name): string;
    public function bodyParam(string $name): string;
    public function queryString(): array;
    public function collectInformation(RequestHandler $requestHandler): void;
}