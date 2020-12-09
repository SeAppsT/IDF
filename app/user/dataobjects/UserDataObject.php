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
        return ['id' => $this -> user -> id,
                'login' => $this -> user -> login,
                'password' => $this -> user -> password,
                'status' => $this -> user -> status];
    }

    public function __toString(){
        return User::class;
    }

    public function getName(){
        return $this -> name;
    }

    public function isUserExists(){
        $user = $this -> one()
            -> search('login', equals($this -> user -> login))
            -> search('password', equals($this -> user -> password))
            -> go();
        if ($user == null)
            return false;
        return $user;
    }

    public function setDomain($user){
        $this -> user = $user;
    }

    function getDomain(){
        return $this -> user;
    }
}