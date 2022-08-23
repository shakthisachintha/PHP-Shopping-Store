<?php 
include_once(__DIR__."/src/config.php");
$url = HOST.":".PORT_NUMBER;
shell_exec("open http://$url");
shell_exec("php -S ".$url);