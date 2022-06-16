<?php

require_once "config/constant.php";
require_once "config/db.php";

if (isset($_REQUEST['controller'])) {
    $controller = getControllerPath($_REQUEST['controller']);
    $fileExists = file_exists($controller);
    if ($fileExists) {
        require_once $controller;
    } else {
        $errorMsg = "Error 404";
        require_once VIEWS . "error/error.php";
    }
} else {
    require_once VIEWS . "main/main.php";
}

function getControllerPath($controller): string
{
    return CONTROLLERS . $controller . "Controller.php";
}
?>