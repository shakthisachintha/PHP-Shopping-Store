<?php
include_once(__DIR__ . "/../entities/User.php");
session_start();

class AuthService
{
    private UserService $userService;

    function __construct()
    {
        $this->userService = new UserService();
    }

    function is_logged(): bool
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

    function is_admin(): bool
    {
        if ($this->is_logged() && $_SESSION['user']->get_userType() === UserType::Admin) {
            return true;
        }
        return false;
    }

    function get_current_user(): User | NULL
    {
        if (isset($_SESSION['user'])) return $_SESSION['user'];
        return NULL;
    }

    function login(string $email, string $password): void
    {
        $user = $this->userService->get_user_by_email($email);
        if (!$user) {
            RouterService::RedirectBackWithErrors(['Incorrect loging details! Please Check again and retry.']);
            return;
        }
        $correct_pw = $this->userService->verify_user_password($password, $user->get_id());
        if ($correct_pw) {
            unset($_SESSION["user"]);
            $_SESSION['user'] = $user;
            RouterService::Redirect(build_route(''));
            return;
        }
        RouterService::RedirectBackWithErrors(['Incorrect loging details! Please Check again and retry.']);
        return;
    }

    function register_new_user(array $user_data)
    {
        $user_data['type'] = UserType::Customer;
        $exsiting_user = $this->userService->get_user_by_email($user_data['email']);
        if ($exsiting_user) {
            RouterService::RedirectBackWithErrors(['User already registered! Try login instead.']);
            return;
        }
        $user = $this->userService->create_new($user_data);
        $registered = $this->userService->register_new_user($user, $user_data['password']);
        if ($registered) {
            RouterService::set_seesion_success("Hi! ". ucwords($user->get_name()) ."Registration completed, now you can continue shopping.");
            $this->login($user->get_email(), $user_data['password']);
            return;
        }
        RouterService::RedirectBackWithErrors(['User registration failed! Try again in few minutes.']);
    }

    function logout(): void
    {
        unset($_SESSION["user"]);
        session_destroy();
        RouterService::Redirect(build_route(''));
    }
}
