<?php

require_once MODELS . "jobModel.php";

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

function getAllJobs()
{
    $jobs = get();
    if (isset($jobs)) {
        require_once VIEWS . "/hobbie/jobsDashboard.php";
    }
}

function getHobbie($request)
{
    $action = $request["action"];
    $job = null;
    if (isset($request["id"])) {
        $job = getById($request["id"]);
    }
    require_once VIEWS . "/jobs/jobs.php";
}

function createHobbie($request)
{
    $action = $request["action"];
    if (sizeof($_POST) > 0) {
        $job = create($_POST);

        if ($job[0]) {
            header("Location: index.php?controller=job&action=getAllJobs");
        } else {
            echo $job[1];
        }
    } else {
        require_once VIEWS . "/jobs/jobs.php";
    }
}

function updateJob($request)
{
    $action = $request["action"];
    if (sizeof($_POST) > 0) {
        $job = update($_POST);

        if ($job[0]) {
            echo "header dashboard";
            header("Location: index.php?controller=job&action=getAllJobs");
        } else {
            $job = $_POST;
            $error = "The data entered is incorrect, check that there is no other hobbie with that email.";
            require_once VIEWS . "/jobs/jobs.php";
        }
    } else {
        require_once VIEWS . "/jobs/jobs.php";
    }
}

function deleteJob($request)
{
    $action = $request["action"];
    $job = null;
    if (isset($request["id"])) {
        $job = delete($request["id"]);
        header("Location: index.php?controller=job&action=getAllJobs");
    }
}

function error($errorMsg)
{
    require_once VIEWS . "/error/error.php";
}