<?php


class UserDataObject implements DataObject {

    use BaseDataHelper;
    use Manager;

    private User $user;
    private string $name = 'users';

    public function __construct(User $user = null){
        if ($user != null)
            $this -> user = $user;
    }

    public function getCredentials(){
        return ['identifier' => 'id'];
    }

    public function getFields(){
        return ['id' => $this -> user -> getId(),
                'login' => $this -> user -> getLogin(),
                'password' => $this -> user -> getPassword()];
    }

    public function __toString(){
        return User::class;
    }

    public function getName(){
        return $this -> name;
    }

    public function isUserExists(){
        return $this -> one()
            -> search('login', equals($this -> user -> getLogin()))
            -> search('password', equals($this -> user -> getPassword()))
            -> go() ? true : false;
    }
}