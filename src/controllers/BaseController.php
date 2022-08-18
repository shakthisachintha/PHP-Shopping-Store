<?php
include_once(__DIR__ . '/../services/AuthService.php');
include_once(__DIR__ . '/../services/DatabaseService.php');

class BaseController
{
    protected AuthService $authService;
    protected DatabaseService $databaseService;

    function __construct()
    {
        $this->authService = new AuthService();
        $this->databaseService = new DatabaseService();
    }

    function render($template, $param = array()){
        extract($param, EXTR_SKIP);
        include($template);
    }
}
