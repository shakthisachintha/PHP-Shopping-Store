<?php

$routes = [
    // ['/route-name', [GET, POST], controller::handler_function]

    // Auth routes
    ['url' => '/',                   'methods' => ['GET'],      'handler' => 'frontpage'],
    ['url' => '/login',              'methods' => ['POST'],     'handler' => 'AuthController::handle_login'],
    ['url' => '/register',           'methods' => ['POST'],     'handler' => 'AuthController::handle_register'],
    ['url' => '/logout',             'methods' => ['GET'],      'handler' => 'AuthController::handle_logout'],

    // Product Routes
    ['url' => '/product-create',     'methods' => ['GET'],      'handler' => 'ProductController::show_create_view'],
    ['url' => '/product-view',       'methods' => ['GET'],      'handler' => 'ProductController::show_product_view'],
    ['url' => '/product-update',     'methods' => ['GET'],      'handler' => 'ProductController::show_update_view'],
    ['url' => '/product-delete',     'methods' => ['GET'],      'handler' => 'ProductController::show_delete_view'],
    ['url' => '/product-create',     'methods' => ['POST'],     'handler' => 'ProductController::handle_create'],
    ['url' => '/product-update',     'methods' => ['POST'],     'handler' => 'ProductController::handle_update'],
    ['url' => '/product-delete',     'methods' => ['POST'],     'handler' => 'ProductController::handle_delete'],

    // Category Routes
    ['url' => '/category-create',    'methods' => ['GET'],      'handler' => 'CategoryController::show_create_view'],
    ['url' => '/category-view',      'methods' => ['GET'],      'handler' => 'CategoryController::show_category_view'],
    ['url' => '/category-update',    'methods' => ['GET'],      'handler' => 'CategoryController::show_update_view'],
    ['url' => '/category-delete',    'methods' => ['GET'],      'handler' => 'CategoryController::show_delete_view'],
    ['url' => '/category-create',    'methods' => ['POST'],     'handler' => 'CategoryController::handle_create'],
    ['url' => '/category-update',    'methods' => ['POST'],     'handler' => 'CategoryController::handle_update'],
    ['url' => '/category-delete',    'methods' => ['POST'],     'handler' => 'CategoryController::handle_delete'],

    // Shopping Cart Routes
    ['url' => '/cart-view',           'methods' => ['GET'],     'handler' => 'CartController::show_cart_view'],
    ['url' => '/cart-add-product',    'methods' => ['GET'],     'handler' => 'CartController::handle_add_product'],
    ['url' => '/cart-remove-product', 'methods' => ['GET'],     'handler' => 'CartController::handle_remove_product'],

    // Order Routes

    // User Routes
];
