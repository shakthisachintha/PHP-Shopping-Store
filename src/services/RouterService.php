<?php
class RouterService
{
    public static function Redirect($url, $permanent = false)
    {
        if (headers_sent() === false) {
            header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
        }

        exit();
    }

    public static function RedirectBack()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
