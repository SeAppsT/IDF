<?php


interface Authable {
    public function getSecretData();
    public function getCredentials(): array;
}