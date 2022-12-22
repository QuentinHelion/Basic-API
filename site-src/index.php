<?php

/**
 * @file
 * Router file.
 */

require_once('vendor/autoload.php');

$route = $_REQUEST["route"] ?? "";
$method = $_SERVER["REQUEST_METHOD"];

if (preg_match("/^api/", $route)) {

    $controller = new APP\Controllers\API();
    // $controller = new PAWeb\ReportInterface();
    //
    // if (preg_match("/(\/)/", $route)) {
    //     $route = preg_split("/(\/)/", $route);
    //     if ($method == "POST") {
    //         if ($route[1] == "report") {
    //             $controller->report();
    //             die();
    //         }
    //     }
    // }
}

header("Location: /error");
die();
