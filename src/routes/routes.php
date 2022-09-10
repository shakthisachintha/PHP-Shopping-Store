<?php

$routes = [
    // ['/route-name', [GET, POST], controller::handler_function]

    // Auth routes
    ['url' => '/',                   'methods' => ['GET'],                                   'handler' => 'AuthController::show_index'],
    ['url' => '/auth',               'methods' => ['GET'],      'middlewares'=>['guest'],    'handler' => 'AuthController::show_login_register'],
    ['url' => '/login',              'methods' => ['POST'],     'middlewares'=>['guest'],    'handler' => 'AuthController::handle_login'],
    ['url' => '/register',           'methods' => ['POST'],     'middlewares'=>['guest'],    'handler' => 'AuthController::handle_register'],
    ['url' => '/logout',             'methods' => ['GET'],      'middlewares'=>['auth'],     'handler' => 'AuthController::handle_logout'],
    ['url' => '/forgot-password',    'methods' => ['GET'],      'middlewares'=>['guest'],    'handler' => 'AuthController::handle_forgot_password'],

    // Product Routes
    ['url' => '/products',           'methods' => ['GET'],                                  'handler' => 'ProductController::show_index'],
    ['url' => '/product-create',     'methods' => ['GET'],      'middlewares'=>['admin'],   'handler' => 'ProductController::show_create_view'],
    ['url' => '/product-view',       'methods' => ['GET'],                                  'handler' => 'ProductController::show_product_view'],
    ['url' => '/product-update',     'methods' => ['GET'],      'middlewares'=>['admin'],   'handler' => 'ProductController::show_update_view'],
    ['url' => '/product-delete',     'methods' => ['GET'],      'middlewares'=>['admin'],   'handler' => 'ProductController::show_delete_view'],
    ['url' => '/product-save',       'methods' => ['POST'],     'middlewares'=>['admin'],   'handler' => 'ProductController::handle_create'],
    ['url' => '/product-update',     'methods' => ['POST'],     'middlewares'=>['admin'],   'handler' => 'ProductController::handle_update'],
    ['url' => '/product-delete',     'methods' => ['POST'],     'middlewares'=>['admin'],   'handler' => 'ProductController::handle_delete'],

    // Category Routes
    ['url' => '/category-create',    'methods' => ['GET'],      'middlewares'=>['admin'],   'handler' => 'CategoryController::show_create_view'],
    ['url' => '/category-view',      'methods' => ['GET'],                                  'handler' => 'CategoryController::show_category_view'],
    ['url' => '/category-update',    'methods' => ['GET'],      'middlewares'=>['admin'],   'handler' => 'CategoryController::show_update_view'],
    ['url' => '/category-delete',    'methods' => ['GET'],      'middlewares'=>['admin'],   'handler' => 'CategoryController::show_delete_view'],
    ['url' => '/category-save',      'methods' => ['POST'],     'middlewares'=>['admin'],   'handler' => 'CategoryController::handle_create'],
    ['url' => '/category-update',    'methods' => ['POST'],     'middlewares'=>['admin'],   'handler' => 'CategoryController::handle_update'],
    ['url' => '/category-delete',    'methods' => ['POST'],     'middlewares'=>['admin'],   'handler' => 'CategoryController::handle_delete'],

    // Shopping Cart Routes
    ['url' => '/cart-view',           'methods' => ['GET'],     'middlewares'=>['auth'],   'handler' => 'ShoppingCartController::show_cart_view'],
    ['url' => '/cart-add-product',    'methods' => ['GET'],     'middlewares'=>['auth'],   'handler' => 'ShoppingCartController::handle_add_product'],
    ['url' => '/cart-remove-product', 'methods' => ['GET'],     'middlewares'=>['auth'],   'handler' => 'ShoppingCartController::handle_remove_product'],
    ['url' => '/cart-clear',          'methods' => ['GET'],     'middlewares'=>['auth'],   'handler' => 'ShoppingCartController::handle_cart_clear'],

    // Order Routes

    // User Routes
    ['url' => '/user-account',        'methods' => ['GET'],     'handler' => 'UserController::show_user_account'],
];
