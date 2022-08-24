<?php
include_once(__DIR__ . "/src/config.php");
$url = HOST . ":" . PORT_NUMBER;

function open_browser(string $url)
{
    switch (PHP_OS_FAMILY) {
        case 'Darwin':
            shell_exec("open http://$url");
            break;
        case 'Windows':
            shell_exec("start http://$url");
            break;
        case 'Linux':
            shell_exec("xdg-open http://$url");
            break;
        default:
            break;
    }
}

$pid = pcntl_fork();
if ($pid == -1) {
    die('Could not start server!');
} else if ($pid) {
    shell_exec("php -S " . $url);
    pcntl_wait($status); //Protect against Zombie children
} else {
    sleep(1);
    open_browser($url);
}
