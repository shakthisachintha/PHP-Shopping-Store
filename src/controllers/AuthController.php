<?php
include_once(__DIR__.'/BaseController.php');
include_once(__DIR__.'/../entities/User.php');
include_once(__DIR__.'/../entities/Order.php');

class AuthController extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function handle_login()
    {
        $order = new Order();
        $order->set_amount(100.50);
        $order->set_user(new User());
        $arr = $order->attributes_to_array();
        // $this->databaseService->create_record('user', $arr);
        print_r($arr);
    }

    public function handle_register()
    {
        
        $user = new User();
        $user->set_email("shaktm");
        $user->set_name("sa");
        $user->set_address("itipe, Galle");
        $arr = $user->attributes_to_array();
        $this->databaseService->create_record('user', $arr);
        // print_r($arr);
    }

    public function handle_logout()
    {
        echo "handle_logout";
    }
}
