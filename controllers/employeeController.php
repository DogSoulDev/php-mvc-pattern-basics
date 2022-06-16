<?php

require_once MODELS . "employeeModel.php";

$action="";

if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}


if(function_exists($action)){
    call_user_func($action, $_REQUEST);
}else{
    error("Invalid user action");
}



function getAllEmployees()
{

    $employees = get();
    

    if(isset($employees)){
        $msg="";
        require_once VIEWS . "/employee/employeeDashboard.php";
    }else{
        error("There is a Data Base error, try again.");
    }
}


function getEmployee($request)
{
 
    $employee = getById($_GET["id"]);

    if(isset($employee)){
        require_once VIEWS . "employee/employee.php";
    }else{
        error("This employee doesnt exists");
    }
}

function setEmployee($request){
 
    $newData = array();
    array_push($newData, $request["id"]);
    array_push($newData, $_POST["name"]);
    array_push($newData, $_POST["last_name"]);
    array_push($newData, $request["email"]);
    array_push($newData, $request["gender_id"]);
    array_push($newData, $request["age"]);
    array_push($newData, $request["phone_number"]);
    array_push($newData, $request["city"]);
    array_push($newData, $_POST["street_address"]);
    array_push($newData, $_POST["state"]);    
    array_push($newData, $_POST["postal_code"]);
    
    
    $employee = setById($newData);
    $msg ="data setted";
    getAllEmployees();
}

function deleteEmployee($request){
    delete($request["id"]);

   
    $numOfEmployees = getNumEmployees();
    setIdEmployees($numOfEmployees);
    setIdGender($numOfEmployees);

    
    getAllEmployees();
}

function createEmployee(){
    require_once VIEWS . "/employee/employee.php";
}

function create($request){
    $newData = array();
    array_push($newData, $request["id"]);
    array_push($newData, $_POST["name"]);
    array_push($newData, $_POST["last_name"]);
    array_push($newData, $request["email"]);
    array_push($newData, $request["gender_id"]);
    array_push($newData, $request["age"]);
    array_push($newData, $request["phone_number"]);
    array_push($newData, $request["city"]);
    array_push($newData, $request["street_address"]);
    array_push($newData, $request["state"]);
    array_push($newData, $request["postal_code"]);

    
    $employee = createNewEmployee($newData);
    $msg ="data setted";

    
    $numOfEmployees = getNumEmployees();
    setIdEmployees($numOfEmployees);
    setIdGender($numOfEmployees);

    
    getAllEmployees();
}


function error($errorMsg)
{
    require_once VIEWS . "/error/error.php";
}