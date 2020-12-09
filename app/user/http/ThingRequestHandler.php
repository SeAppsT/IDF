<?php


/**
 * Read
 */
Shopin::addRequestHandler(function (Request $request){
    $thing = new Thing();
    return new PageResponse('user/pages/things.phtml',
        ['things' => $thing
            -> get()
            -> out('user_id', Shopin::getDataObject(User::class) -> one())
            -> go()
        ]);
})
    -> setPath('things/');

/**
 * Create @GET
 */
Shopin::addRequestHandler(function (Request $request){
    return new PageResponse('user/pages/modify_thing.phtml');
})
    -> setPath('thing/create/')
    -> addMethod('GET');


/**
 * Create @POST
 */
Shopin::addRequestHandler(function (Request $request){
    $thing = $request -> getModel(Thing::class);
    $thing -> user = Shopin::getSessionImplementation('Http') -> get('user');
    $thing -> insert();
    return new RedirectResponse('/things/');
})
    -> setPath('thing/create/')
    -> addMethod('POST');