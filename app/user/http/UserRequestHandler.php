<?php

/**
 * Read
 */
Shopin::addRequestHandler(function (Request $request){
    $userDO = new UserDataObject();
    return new PageResponse('user/pages/users.phtml',
        ['users' => $userDO
            -> get('*')
            -> search('status', equals('active'))
            -> go()
        ]);
})
    -> setPath('users/');

/**
 * Update
 */
Shopin::addRequestHandler(function (Request $request){

})
    -> setPath('user/{id}/update/');

/**
 * Delete
 */
Shopin::addRequestHandler(function (Request $request){
    $userDO = new UserDataObject();
    $userDO -> del()
        -> search('id', equals($request -> pathVariable('id')))
        -> go();
    return new RedirectResponse('/users/');
})
    -> setPath('user/{id}/delete/');