<?php


use Request;
use Response;

Source::addRequestHandler(function (Request $request): Response {
    $product = new \Product();
    $productDataObject = new \ProductDataObject();
    $productDataObject -> setProduct($product);
    echo 'HANDLER products';
    return new PageResponse('products.html');
})
    -> setPath('product');


Source::addRequestHandler(function (Request $request): Response {
    echo 'HANDLER product';
    return new PageResponse('add_product.html');
})
    -> setPath('product/{id}')
    -> addMethod('GET');


Source::addRequestHandler(function (Request $request): Response{
    $product = new Product();
    $product -> setId($request -> pathVariable('product_id'));
    $order = new Order();
    $order -> setId($request -> pathVariable('cart_id'));
    $order -> addProductToCart($product);
    $productDataObject = new ProductDataObject();
    $productFromDB = $productDataObject -> one() -> where('price', ['<', '400']) -> go();
    echo 'HANDLER product/cart';
    return new PageResponse('page.html');
})
    -> setPath('product/{product_id}/cart/{cart_id}');