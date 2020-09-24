<?php


Source::addRequestHandler(function (Request $request): Response {
    $productDataObject = new \ProductDataObject();
    $products = $productDataObject -> get()
        -> search('price', letter(400))
        -> go();
    return new PageResponse('main/pages/products.phtml', ['products' => $products]);
})
    -> setPath('product/');


Source::addRequestHandler(function (Request $request): Response {
    echo 'HANDLER product';
    $product = new \Product();
    $productDataObject = new \ProductDataObject($product);

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
    $product -> setName("Product from fwk");
    $product -> setPrice(null);
    $product -> setRating(5);
    $productDO = new ProductDataObject($product);
    $productDO -> insert();
    $userDO = new UserDataObject();
    $DBdata = $productDO -> get()
        -> in('product_id', $order -> one())
        -> out('user_id', $userDO -> get())
        -> search('status', equals('ACTIVE'))
        -> go();
    return new PageResponse('page.html');
})
    -> setPath('product/{product_id}/cart/{cart_id}');