<?php

/**
 * Register @GET
 */
Shopin::addRequestHandler(function (Request $request){
    return new PageResponse('user/pages/register.phtml');
})
    -> setPath('auth/register/')
    -> addMethod('GET');

/**
 * Register @POST
 */
Shopin::addRequestHandler(function (Request $request){
    $user = new User($request -> bodyParam('login'),
        $request -> bodyParam('password'));
    $userDO = new UserDataObject($user);
    $userDO -> insert();
    return new PageResponse('templates/success.phtml', [
        'text' => 'Hello '.$user -> getLogin().'!',
        'description' => 'Вы успешно зарегистрировались',
        'link' => '/auth/register/',
        'textLink' => 'Авторизоваться'
    ]);
}) -> setPath('auth/register/')
    -> addMethod('POST');


/**
 * LOGIN @GET
 */
Shopin::addRequestHandler(function (Request $request){
    return new PageResponse('user/pages/login.phtml');
})
    -> setPath('auth/login/')
    -> addMethod('GET');


/**
 * Login @POST
 */
Shopin::addRequestHandler(function (Request $request){
    $user = new User($request -> bodyParam('login'),
        $request -> bodyParam('password'));
    if ($user -> login())
        return new RedirectResponse('/users/');
    else
        return new PageResponse('templates/error.phtml', [
            'code' => 401,
            'link' => '/auth/login/',
            'description' => 'Неправильный логин или пароль'
        ]);
})
    -> setPath('auth/login/')
    -> addMethod('POST');


/**
 * Logout
 */
Shopin::addRequestHandler(function (Request $request){
    if (Shopin::getSessionImplementation('Http') -> get('user') != null) {
        $user = Shopin::getSessionImplementation('Http') -> get('user');
        $user -> logout();
    }
}) -> setPath('auth/logout/');