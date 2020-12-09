<?php


interface Request{
    public function queryParam(string $name): string;
    public function pathVariable(string $name): string;
    public function bodyParam(string $name);
    public function requestBody();
    public function queryString(): array;
    public function getMethod(): string;
    public function collectInformation(RequestHandler $requestHandler): void;
    public function getModel(string $modelName): object;
}