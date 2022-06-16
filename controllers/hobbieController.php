<?php

require_once MODELS . "hobbieModel.php";

$action = "";

if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
}

if (function_exists($action)) {
    call_user_func($action, $_REQUEST);
} else {
    error("Invalid user action");
}

/* ~~~ CONTROLLER FUNCTIONS ~~~ */

function getAllHobbies()
{
    $hobbies = get();
    if (isset($hobbies)) {
        require_once VIEWS . "/hobbie/hobbieDashboard.php";
    }
}

function getHobbie($request)
{
    $action = $request["action"];
    $hobbie = null;
    if (isset($request["id"])) {
        $hobbie = getById($request["id"]);
    }
    require_once VIEWS . "/hobbie/hobbie.php";
}

function createHobbie($request)
{
    $action = $request["action"];
    if (sizeof($_POST) > 0) {
        $hobbie = create($_POST);

        if ($hobbie[0]) {
            header("Location: index.php?controller=hobbie&action=getAllHobbies");
        } else {
            echo $hobbie[1];
        }
    } else {
        require_once VIEWS . "/hobbie/hobbie.php";
    }
}

function updateHobbie($request)
{
    $action = $request["action"];
    if (sizeof($_POST) > 0) {
        $hobbie = update($_POST);

        if ($hobbie[0]) {
            echo "header dashboard";
            header("Location: index.php?controller=hobbie&action=getAllHobbies");
        } else {
            $hobbie = $_POST;
            $error = "The data entered is incorrect, check that there is no other hobbie with that email.";
            require_once VIEWS . "/hobbie/hobbie.php";
        }
    } else {
        require_once VIEWS . "/hobbie/hobbie.php";
    }
}

function deleteHobbie($request)
{
    $action = $request["action"];
    $hobbie = null;
    if (isset($request["id"])) {
        $hobbie = delete($request["id"]);
        header("Location: index.php?controller=hobbie&action=getAllHobbies");
    }
}

function error($errorMsg)
{
    require_once VIEWS . "/error/error.php";
}