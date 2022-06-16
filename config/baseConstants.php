<?php

//Get the current directory
$documentRoot = getcwd();

//Defining the constant BASE_PATH to use on the constructors uris
define("BASE_PATH", $documentRoot);

//Building the uri BASE_URL
$uri = $_SERVER["REQUEST_URI"];

if(isset($uri) && $uri != null){
    $uri = substr($uri, 1);
    $uri = explode("/", $uri);
    $uri = "http://$_SERVER[HTTP_HOST]" . "/" . $uri[0];
}else{
    $uri = null;
}

define("BASE_URL", $uri);