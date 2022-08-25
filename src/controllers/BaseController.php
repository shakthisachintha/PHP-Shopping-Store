<?php
include_once(__DIR__ . '/../services/AuthService.php');
include_once(__DIR__ . '/../services/DatabaseService.php');
include_once(__DIR__ . '/../services/RouterService.php');

class BaseController
{
    protected AuthService $AuthService;
    protected DatabaseService $DatabaseService;

    function __construct()
    {
        $this->AuthService = new AuthService();
        $this->DatabaseService = new DatabaseService();
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
