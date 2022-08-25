<?php
include_once(__DIR__ . '/BaseController.php');
// include_once(__DIR__ . '/../entities/User.php');
include_once(__DIR__ . '/../services/UserService.php');
include_once(__DIR__ . '/../entities/Order.php');

class AuthController extends BaseController
{
    private UserService $UserService;

    function __construct()
    {
        parent::__construct();
        $this->UserService = new UserService();
    }

    public function show_index()
    {
        $this->render('views/pages/html_index', ["title" => "Home"]);
    }

    public function show_login_register()
    {
        $this->render('views/pages/html_login_register', ["title" => "Login | Register"]);
    }

    public function handle_login(array $request)
    {
        print_r($request);
        $user = $this->UserService->get_user_by_email($request['email']);
        $this->AuthService->login($user);
    }

    public function handle_register(array $request)
    {
        $request['type'] = UserType::Customer;
        $user = $this->UserService->create_new($request);
        if ($this->UserService->register_new_user($user, $request['password']))
            $this->AuthService->login($user);
        else
            echo $this->render('views/errors/reg_failed');
    }

    public function handle_logout()
    {
        $this->AuthService->logout();
    }
}
