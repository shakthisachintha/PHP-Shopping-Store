<?php
include_once(__DIR__ . '/BaseController.php');
include_once(__DIR__ . '/../services/UserService.php');
include_once(__DIR__ . '/../entities/Order.php');

class AuthController extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function show_index()
    {
        $products = $this->ProductService->get_all();
        $this->render('views/pages/html_index', ["title" => "Home", "products"=>$products]);
    }

    public function show_login_register()
    {
        $this->render('views/pages/html_login_register', ["title" => "Login | Register"]);
    }

    public function handle_login(array $request)
    {
        $this->AuthService->login($request['email'], $request['password']);
    }

    public function handle_register(array $request)
    {
        $this->AuthService->register_new_user($request);
    }

    public function handle_logout()
    {
        $this->AuthService->logout();
    }
}
