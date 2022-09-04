<?php
include_once(__DIR__ . '/../services/AuthService.php');
include_once(__DIR__ . '/../services/DatabaseService.php');
include_once(__DIR__ . '/../services/RouterService.php');
include_once(__DIR__ . '/../services/CategoryService.php');
include_once(__DIR__ . '/../services/ProductService.php');

class BaseController
{
    protected AuthService $AuthService;
    protected DatabaseService $DatabaseService;
    protected CategoryService $CategoryService;
    protected ProductService $ProductService;

    function __construct()
    {
        $this->AuthService = new AuthService();
        $this->DatabaseService = new DatabaseService();
        $this->CategoryService = new CategoryService();
        $this->ProductService = new ProductService();
    }

    function render($template, $param = array())
    {
        extract($param, EXTR_SKIP);
        $authService = $this->AuthService;
        include(__DIR__ . "/../views/html_header.php");
        include(__DIR__ . "/../$template.php");
        include(__DIR__ . "/../views/html_footer.php");
    }
}
