<?php
    error_reporting(E_ALL);
    header('Content-Type: application/json');
    $arrayOrder = json_decode(file_get_contents('php://input'), true);
    print_r($arrayOrder);
?>