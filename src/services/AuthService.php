<?php
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

    function login(): void
    {
    }

    function logout(): void
    {
        unset($_SESSION["user"]);
    }
}
