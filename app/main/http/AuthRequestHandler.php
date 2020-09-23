<?php

Source::addRequestHandler(function (Request $request){
    $user = new User(json_decode($request -> requestBody()) -> login,
        json_decode($request -> requestBody()) -> password);
    if ($user -> login())
        return new PageResponse('templates/success.html');
    else
        return new PageResponse('templates/error.html');
})
    -> setPath('auth/login');



Source::addRequestHandler(function (Request $request){
    if (Source::getSessionImplementation('Http') -> get('user') != null) {
        $user = Source::getSessionImplementation('Http')->get('user');
        $user->logout();
    }
}) -> setPath('auth/logout');



Source::addRequestHandler(function (Request $request){
    $user = new User($request -> bodyParam('login'),
        $request -> bodyParam('password'));

    $userDO = new UserDataObject($user);
    $userDO -> insert();
    return new PageResponse('templates/success.html');
}) -> setPath('auth/register');