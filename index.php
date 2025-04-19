<?php

require_once __DIR__ . '/vendor/autoload.php';

$controller = isset($_GET['c']) ? $_GET['c'] : 'Inicio';
$action = isset($_GET['a']) ? $_GET['a'] : 'Index';

$controller = "Proyecto\\Clinica\\Controller\\" . "C_" . ucwords($controller);
if (!class_exists($controller) && !method_exists($controller, $action)) {
   $controller = "Proyecto\\Clinica\\Controller\\C_Error";
}
$controller = new $controller;

$id = isset($_GET['id']) ? $_GET['id'] : null;

call_user_func_array([$controller, $action], [$id]);