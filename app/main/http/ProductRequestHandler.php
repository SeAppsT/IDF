<?php


Source::addRequestHandler(function (Request $request): Response {
    $product = new \Product();
    $productDataObject = new \ProductDataObject($product);
    $productDataObject -> setProduct($product);
    echo 'HANDLER products';
    return new PageResponse('products.html');
})
    -> setPath('product');


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
    $productDataObject = new ProductDataObject($product);
    $productFromDB = $productDataObject -> del()
        -> where('price', bigger(400))
        -> where('rating', letter(2))
        -> outer(
            $productDataObject -> get()
                -> where('price', bigger(50))
                -> go()
        )
        -> go();



    print_r($productFromDB);

    return new PageResponse('page.html');
})
    -> setPath('product/{product_id}/cart/{cart_id}');