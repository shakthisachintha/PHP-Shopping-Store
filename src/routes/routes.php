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
    ['url' => '/product-view',       'methods' => ['GET'],      'middlewares'=>['admin'],   'handler' => 'ProductController::show_product_view'],
    ['url' => '/product-delete',     'methods' => ['GET'],      'middlewares'=>['admin'],   'handler' => 'ProductController::handle_product_delete'],
    ['url' => '/product-save',       'methods' => ['POST'],     'middlewares'=>['admin'],   'handler' => 'ProductController::handle_create'],
    ['url' => '/product-update',     'methods' => ['POST'],     'middlewares'=>['admin'],   'handler' => 'ProductController::handle_product_update'],
    ['url' => '/product-delete',     'methods' => ['POST'],     'middlewares'=>['admin'],   'handler' => 'ProductController::handle_delete'],
    ['url' => '/shop',               'methods' => ['GET'],                                  'handler' => 'ProductController::show_shop_view'],

    // Category Routes
    ['url' => '/category-create',    'methods' => ['GET'],      'middlewares'=>['admin'],   'handler' => 'CategoryController::show_create_view'],
    ['url' => '/category-view',      'methods' => ['GET'],                                  'handler' => 'CategoryController::show_category_view'],
    ['url' => '/category-update',    'methods' => ['GET'],      'middlewares'=>['admin'],   'handler' => 'CategoryController::show_update_view'],
    ['url' => '/category-delete',    'methods' => ['GET'],      'middlewares'=>['admin'],   'handler' => 'CategoryController::show_delete_view'],
    ['url' => '/category-save',      'methods' => ['POST'],     'middlewares'=>['admin'],   'handler' => 'CategoryController::handle_create'],
    ['url' => '/category-update',    'methods' => ['POST'],     'middlewares'=>['admin'],   'handler' => 'CategoryController::handle_update'],
    ['url' => '/category-delete',    'methods' => ['POST'],     'middlewares'=>['admin'],   'handler' => 'CategoryController::handle_delete'],

    // Shopping Cart Routes
    ['url' => '/cart-add-product',    'methods' => ['GET'],     'middlewares'=>['auth'],   'handler' => 'ShoppingCartController::handle_add_product'],
    ['url' => '/cart-remove-product', 'methods' => ['GET'],     'middlewares'=>['auth'],   'handler' => 'ShoppingCartController::handle_remove_product'],
    ['url' => '/cart-clear',          'methods' => ['GET'],     'middlewares'=>['auth'],   'handler' => 'ShoppingCartController::handle_cart_clear'],

    // Order Routes
    ['url' => '/checkout',            'methods' => ['GET'],     'middlewares'=>['auth'],   'handler' => 'OrderController::show_checkout_page'],
    ['url' => '/checkout-order',      'methods' => ['POST'],    'middlewares'=>['auth'],   'handler' => 'OrderController::handle_create_order_and_checkout'],
    ['url' => '/checkout-payment',    'methods' => ['GET'],     'middlewares'=>['auth'],   'handler' => 'OrderController::show_checkout_payment_gateway'],
    ['url' => '/payment-status',      'methods' => ['POST'],    'middlewares'=>['auth'],   'handler' => 'OrderController::handle_payment_status_update'],
    ['url' => '/orders',              'methods' => ['GET'],     'middlewares'=>['auth'],   'handler' => 'OrderController::show_order_details'],
    ['url' => '/order-download',      'methods' => ['GET'],     'middlewares'=>['auth'],   'handler' => 'OrderController::handle_order_product_download'],

    // User Routes
    ['url' => '/user-account',        'methods' => ['GET'],     'middlewares'=>['auth'],   'handler' => 'UserController::show_user_account'],
    ['url' => '/my-orders',           'methods' => ['GET'],     'middlewares'=>['auth'],   'handler' => 'UserController::show_user_orders'],
    ['url' => '/password-update',     'methods' => ['POST'],    'middlewares'=>['auth'],   'handler' => 'UserController::handle_password_update'],
    ['url' => '/account-update',      'methods' => ['POST'],    'middlewares'=>['auth'],   'handler' => 'UserController::handle_account_update'],
];
