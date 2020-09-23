<?php


class User {

    private int $id = 0;
    private string $login;
    private string $password;

    public function __construct(string $login, string $password){
        $this -> login = $login;
        $this -> password = $password;
    }

    public function login(): bool{
        $userDO = new UserDataObject($this);
        if ($userDO -> isUserExists()){
            Source::getSessionImplementation('Http') -> put('user', $this);
            return true;
        } else
            return false;
    }

    public function logout(string $key){
        Source::getSessionImplementation('Http') -> put($key, null);
    }

    public function getId(): int{
        return $this -> id;
    }

    public function setId(int $id): void{
        $this -> id = $id;
    }

    public function getLogin(): string{
        return $this -> login;
    }

    public function setLogin(string $login): void{
        $this -> login = $login;
    }

    public function getPassword(): string{
        return $this -> password;
    }

    public function setPassword(string $password): void{
        $this -> password = $password;
    }
}