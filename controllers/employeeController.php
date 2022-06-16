<?php

require_once MODELS . "employeeModel.php";

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

function getAllEmployees()
{
    $employees = get();
    if (isset($employees)) {
        require_once VIEWS . "/employee/employeeDashboard.php";
    } else {
        error("There is a database error, try again.");
    }
}

function getEmployee($request)
{
    $action = $request["action"];
    $employee = null;
    if (isset($request["id"])) {
        $employee = getById($request["id"]);
    }
    require_once VIEWS . "/employee/employee.php";
}

function createEmployee($request)
{
    $action = $request["action"];
    if (sizeof($_POST) > 0) {
        $employee = create($_POST);

        if ($employee[0]) {
            header("Location: index.php?controller=employee&action=getAllEmployees");
        } else {
            echo $employee[1];
        }
    } else {
        require_once VIEWS . "/employee/employee.php";
    }
}

function updateEmployee($request)
{
    $action = $request["action"];
    if (sizeof($_POST) > 0) {
        $employee = update($_POST);

        if ($employee[0]) {
            header("Location: index.php?controller=employee&action=getAllEmployees");
        } else {
            $employee = $_POST;
            $error = "The data entered is incorrect, check that there is no other employee with that email.";
            require_once VIEWS . "/employee/employee.php";
        }
    } else {
        require_once VIEWS . "/employee/employee.php";
    }
}

function deleteEmployee($request)
{
    $action = $request["action"];
    $employee = null;
    if (isset($request["id"])) {
        $employee = delete($request["id"]);
        header("Location: index.php?controller=employee&action=getAllEmployees");
    }
}

function error($errorMsg)
{
    require_once VIEWS . "/error/error.php";
}