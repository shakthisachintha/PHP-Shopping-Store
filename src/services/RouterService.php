<?php

class RouterService
{
    public static function Redirect(string $url, $permanent = false)
    {
        if (headers_sent() === false) {
            header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
        }

        exit();
    }

    public static function RedirectWithErrors(string $url, array $errors, bool $permanent = false)
    {
        $_SESSION['error'] = true;
        $_SESSION['errors'] = $errors;
        RouterService::Redirect($url, $permanent);
    }

    public static function RedirectBackWithSuccess(string $message){
        $_SESSION['success'] = true;
        $_SESSION['success_message'] = $message;
        RouterService::RedirectBack();
    }

    public static function RedirectBackWithErrors(array $errors)
    {
        $_SESSION['error'] = true;
        $_SESSION['errors'] = $errors;
        RouterService::RedirectBack();
    }

    public static function RedirectBack()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
