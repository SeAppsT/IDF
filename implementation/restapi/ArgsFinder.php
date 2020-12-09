<?php


class ArgsFinder {
    function find(string $className, string $methodName){
        $reflectionClass = new ReflectionClass($className);
        $reflectionMethod = $reflectionClass -> getMethod($methodName);
        $reflectionParams = $reflectionMethod -> getParameters();
    }
}