<?php
include_once(__DIR__ . "/../entities/User.php");
session_start();

class AuthService
{
    function is_logged(): bool
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

    function login(User $user): void
    {
        $_SESSION['user'] = $user;
        RouterService::Redirect(build_route(''));
        return;
    }

    function logout(): void
    {
        unset($_SESSION["user"]);
        RouterService::Redirect(build_route(''));
    }
}
