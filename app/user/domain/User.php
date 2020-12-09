<?php


class User {

    public int $id = 0;
    public string $login;
    public string $password;
    public string $status = 'active';

    public function __construct(string $login = null, string $password = null){
        if ($login != null)
            $this -> login = $login;
        if ($password != null)
            $this -> password = $password;
    }

    public function login(): bool{
        $userDO = new UserDataObject($this);
        $user = $userDO -> isUserExists();
        if ($user){
            Shopin::getSessionImplementation('Http') -> put('user', $user);
            return true;
        } else
            return false;
    }

    public function logout(){
        Shopin::getSessionImplementation('Http') -> put('user', null);
    }

}