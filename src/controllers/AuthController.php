<?php
include_once(__DIR__.'/BaseController.php');
include_once(__DIR__.'/../entities/User.php');

class AuthController extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function handle_login()
    {
        echo "handle_login";
    }

    public function handle_register()
    {
        
        $user = new User("10101");
        $user->set_email("shakthisachintha@gmail.com");
        $user->set_name("Shakthi Sachintha");
        $user->set_address("15/5A, Maitipe, Galle");
        $arr = $user->iterateAttributes();
        // self::$databaseService->create_record('user', $arr);
        print_r($arr);
    }

    public function handle_logout()
    {
        echo "handle_logout";
    }
}
