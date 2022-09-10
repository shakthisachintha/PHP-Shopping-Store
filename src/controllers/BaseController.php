<?php
include_once(__DIR__ . '/../services/AuthService.php');
include_once(__DIR__ . '/../services/DatabaseService.php');
include_once(__DIR__ . '/../services/RouterService.php');
include_once(__DIR__ . '/../services/CategoryService.php');
include_once(__DIR__ . '/../services/ProductService.php');
include_once(__DIR__ . '/../services/ShoppingCartService.php');

class BaseController
{
    protected AuthService $AuthService;
    protected DatabaseService $DatabaseService;
    protected CategoryService $CategoryService;
    protected ProductService $ProductService;
    protected ShoppingCartService $ShoppingCartService;

    function __construct()
    {
        $this->AuthService = new AuthService();
        $this->DatabaseService = new DatabaseService();
        $this->CategoryService = new CategoryService();
        $this->ProductService = new ProductService();
        $this->ShoppingCartService = new ShoppingCartService();
    }

    function render($template, $param = array())
    {
        extract($param, EXTR_SKIP);
        $authService = $this->AuthService;
        $shoppingCart = $this->ShoppingCartService->get_empty_shopping_cart();
        if ($authService->is_logged()) {
            $shoppingCart = $this->ShoppingCartService->get_customer_shopping_cart($authService->get_current_user()->get_id());
        }
        include(__DIR__ . "/../views/html_header.php");
        include(__DIR__ . "/../$template.php");
        include(__DIR__ . "/../views/html_footer.php");
    }
}
