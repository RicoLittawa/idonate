<?php
function errorMessage($message)
{ //Error Message
    $response = [
        "status" => "Error",
        "message" => $message,
        "icon" => "error",
    ];

    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
}

function successMessage($message)
{ //Success Message
    $response = [
        "status" => "Success",
        "message" => $message,
        "icon" => "success",
    ];

    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
}
