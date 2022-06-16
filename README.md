Intro:   http://localhost/php-mvc-pattern-basics/

## Table of Contents

- [Getting Started](#getting-started)
- [Dependencies](#dependencies)
- [Contents](#contents)
- [1. Prepare the constants](#1-prepare-the-constants)
- [2. Application entry point](#2-application-entry-point)
- [3. Main Views](#3-main-views)
- [4. Controllers](#4-controllers)
- [5. Models](#5-models)
- [6. Views](#6-views)

## Getting Started

First of all, you will need to clone this repo:

```bash
$ git clone https://github.com/DogSoulDev/php-mvc-pattern-basics
or https://github.com/assembler-school/repository-name
```

## Dependencies

- [Bootstrap](https://getbootstrap.com/)

## Contents

When you're creating a MVC project from scratch it's very important to follow correctly the creation steps in order to understand the execution flow. That is why in this workshop we have detailed the steps to follow for a correct operation of the application:

## 1. Prepare the constants

> In order to call dynamically all the CSS, JS and PHP files, we must configure our project constants that will be accessed during the execution of the application.
> These files will be located in `./config/`

### 1.1. `./config/baseConstants.php`

```php
<?php

$documentRoot = getcwd();

//BASE PATH -> FOR REFERENCE FILES
define("BASE_PATH", $documentRoot);

//BASE URL -> FOR LINK CSS
$uri = $_SERVER['REQUEST_URI'];

if (isset($uri) && $uri !== null) {
    $uri = substr($uri, 1);
    $uri = explode('/', $uri);
    $uri = "http://$_SERVER[HTTP_HOST]" . "/" . $uri[0];
} else {
    $uri = null;
}

define("BASE_URL", $uri);
```

### 1.2. `./config/constants.php`

```php
<?php

include_once "baseConstants.php";

//CONTROLLERS
define("CONTROLLERS", BASE_PATH . '/controllers/');

//VIEWS
define("VIEWS", BASE_PATH . '/views/');

//MODELS
define("MODELS", BASE_PATH . '/models/');

//RESOURCES
define("RESOURCES", BASE_PATH . '/resources/');
```

### 1.3. `./config/db.php`

```php
<?php

define('HOST', 'localhost');
define('DB', 'mvc_basics');
define('USER', 'root');
define('PASSWORD', '');
define('CHARSET', 'utf8mb4');
```

For this part, you will need to create your local database. In this project, we created a SQL file with all the basic operations. You just need to execute the [db.sql](./resources/db.sql) file in your database manager.

## 2. Application entry point

> All the user requests must be done in the entry point, we will use query params in order to indicate which controller and function must be executed.

### 2.1. `./index.php`

First of all, we need to require once the previous created constants files.

```php
<?php

include_once "config/constants.php";
include_once "config/db.php";
```

Then we create the logic to manage what controller and action is called in the query params.

```php
if (isset($_GET['controller'])) {
    $controller = getControllerPath($_GET['controller']);
    $fileExists = file_exists($controller);
    if ($fileExists) {
        require_once $controller;
    } else {
        $errorMsg = "The page you are trying to access does not exist.";
        require_once VIEWS . "error/error.php";
    }
} else {
    require_once VIEWS . "main/main.php";
}

function getControllerPath($controller): string
{
    return CONTROLLERS . $controller . "Controller.php";
}
```

## 3. Main Views

> As you can see in the previous step, we had two default views, now we're gonna create them.

### 3.1. `./views/main/main.php`

This is the main view that is loaded only if the user doesn't specify any controller or it doesn't exists.

```html
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <h1>Welcome to MVC Pattern Basics!</h1>
    <div class="list-group">
        <a class="list-group-item list-group-item-action" href="?controller=employee&action=getAllEmployees">Employee Controller</a>
</body>

</html>
```

### 3.2. `./views/error/error.php`

This view will be always loaded when the user specifies a bad parameter. As you can see, we print an error message that we will see in the last steps.

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo "<h1>". $errorMsg ."</h1>";
    ?>
</body>
</html>
```

## 4. Controllers

> This are the PHP files that are called in the [index.php](./index.php) file. Here we will implement the functionalities of each controller.

### `./controllers/employeeController.php`

Before we start, we need to require the model, that will be responsible of calling the database queries to obtain or modify the information. We will create the model later.

```php
<?php

require_once MODELS . "employeeModel.php";
```

Now, we know that this is the controller that the user wants to load, but we also need to know which function to execute.

```php
$action = "";

if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
}

if (function_exists($action)) {
    call_user_func($action, $_REQUEST);
} else {
    error("Invalid user action");
}
```

We are going to create the `getAllEmployees` function, as you can see, there is a `get()` function that is not created yet, this is a function of the model that we will create in the following step.

```php
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
```

Also we create the `error` function in order to load the error view when something goes wrong.

```php
function error($errorMsg)
{
    require_once VIEWS . "/error/error.php";
}
```

## 5. Models

> As we said before, the models are responsible of calling the database queries to obtain or modify the information.

### 5.1. Connection to the database

In order to send queries to the database, we need to create the connection.

#### 5.1.1. `./models/helper/dbConnection.php`

```php
<?php

// Create connection
function conn()
{
    try {
        $connection = "mysql:host=" . HOST . ";"
            . "dbname=" . DB . ";"
            . "charset=" . CHARSET . ";";

        $options = [
            PDO::ATTR_ERRMODE           =>  PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES  => FALSE,
        ];

        $pdo = new PDO($connection, USER, PASSWORD, $options);

        return $pdo;
    } catch (PDOException $e) {
        require_once(VIEWS . "/error/error.php");
    }
}
```

### 5.2. `./models/employeeModel.php

First, we must require the previous database connection file in order to execute the database queries.

```php
require_once("helper/dbConnection.php");
```

In this model we will create the `get` function that we are executing in the `employeeController.php`.

```php
function get()
{
    $query = conn()->prepare("SELECT e.id, e.name, e.email, g.name as 'gender', e.city, e.age, e.phone_number
    FROM employees e
    INNER JOIN genders g ON e.gender_id = g.id
    ORDER BY e.id ASC;");

    try {
        $query->execute();
        $employees = $query->fetchAll();
        return $employees;
    } catch (PDOException $e) {
        return [];
    }
}
```

## 6. Views

> View are the frontend part of the MVC pattern. Inside them we should create all the necessary code to show the information to the user.

### 6.1. `./views/employee/employeeDashboard.php`

This will be the file that shows all the records of the database.

```php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <h1>Employee Dashboard page!</h1>
    <style type="text/css">

    </style>
    <table class="table">
        <thead>
            <tr>
                <th class="tg-0pky">ID</th>
                <th class="tg-0pky">Name</th>
                <th class="tg-0lax">Email</th>
                <th class="tg-0lax">Gender</th>
                <th class="tg-0lax">City</th>
                <th class="tg-0lax">Age</th>
                <th class="tg-0lax">Phone Number</th>
                <th class="tg-0lax">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($employees as $index => $employee) {
                echo "<tr>";
                echo "<td class='tg-0lax'>" . $employee["id"] . "</td>";
                echo "<td class='tg-0lax'>" . $employee["name"] . "</td>";
                echo "<td class='tg-0lax'>" . $employee["email"] . "</td>";
                echo "<td class='tg-0lax'>" . $employee["gender"] . "</td>";
                echo "<td class='tg-0lax'>" . $employee["city"] . "</td>";
                echo "<td class='tg-0lax'>" . $employee["age"] . "</td>";
                echo "<td class='tg-0lax'>" . $employee["phone_number"] . "</td>";
                echo "<td colspan='2' class='tg-0lax'>
                <a class='btn btn-secondary' href='?controller=employee&action=getEmployee&id=" . $employee["id"] . "'>Edit</a>
                <a class='btn btn-danger' href='?controller=employee&action=deleteEmployee&id=" . $employee["id"] . "'>Delete</a>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a id="home" class="btn btn-primary" href="?controller=employee&action=createEmployee">Create</a>
    <a id="home" class="btn btn-secondary" href="./">Back</a>
</body>
</html>
```
