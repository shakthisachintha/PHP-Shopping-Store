<?php
include_once(__DIR__ . '/BaseController.php');
include_once(__DIR__ . '/../entities/User.php');
include_once(__DIR__ . '/../entities/Order.php');

class AuthController extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function show_index(){
        $this->render('views/pages/html_index');
    }

    public function show_login_register(){
        $this->render('views/pages/html_login_register');
    }

    public function handle_login(array $request)
    {
        $order = new Order();
        $order->set_amount(100.50);
        $order->set_user(new User());
        $arr = $order->attributes_to_array();
        // $this->databaseService->create_record('user', $arr);
        print_r($request);
    }

    public function handle_register(array $request)
    {
        $request['type'] = UserType::Customer;
        $user = User::createNew($request);
        if (User::register_new_user($user, $request['password']))
            $this->authService->login($user);
        else
            echo $this->render('views/errors/reg_failed');
    }

    public function handle_logout()
    {
        echo "handle_logout";
    }
}
