<?php

Source::addRequestHandler(function (Request $request){
    return new PageResponse('main/pages/main.phtml');
})
    -> setPath('');