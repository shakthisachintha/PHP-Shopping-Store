<?php
session_start();

class AuthService
{
    function is_logged(): bool
    {
        if (isset($_SESSION['errors'])) {
            return true;
        } else {
            return false;
        }
    }

    function register(): void
    {
    }

    function login(): void{
        
    }

    function logout(): void
    {
        unset($_SESSION["user"]);
    }
}
