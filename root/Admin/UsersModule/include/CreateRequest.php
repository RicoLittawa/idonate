<?php
require_once '../../../../config/config.php';
require_once '../../include/protect.php';
//accept request
if (isset($_POST['createBtn'])) {
    $reqRef = $_POST['reqRef'];
    $request_date = date('Y-m-d', strtotime($_POST['request_date']));
    $evacQty = trim($_POST['evacQty']);
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $notes = $_POST['notes'];

    $user = $conn->prepare("SELECT firstname, lastname, email, position FROM adduser WHERE uID = ?");
    try {
        if (!$user) {
            throw new Exception('There was a problem executing the query' . $conn->error);
        } else {
            $user->bind_param('i', $userID);
            $user->execute();
            $userResult = $user->get_result();
            if ($userResult->num_rows < 0) {
                throw new Exception("Failed to fetch data from database" . $conn->error);
            } else {
                while ($row = $userResult->fetch_assoc()) {
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $email = $row['email'];
                    $position = $row['position'];
                }
            }
        }
    } catch (Exception $e) {
        $response = [
            "status" => "Error",
            "message" => $e->getMessage(),
            "icon" => "error",
        ];
        header("Content-Type: application/json");
        echo json_encode($response);
        exit();
    }

    $count = 0;
    $resultcount = 0;
    $status = "pending";
    $reqDetails = $conn->prepare("INSERT INTO request
 (userID, request_id, firstname, lastname, position, email, evacuees_qty, requestdate, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $reqReceive = $conn->prepare("INSERT INTO receive_request 
(userID, request_id, firstname, lastname, position, email, evacuees_qty, requestdate, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    try {
        if (!$reqDetails) {
            throw new Exception('There was a problem executing the query' . $conn->error);
        } else {
            $reqDetails->bind_param('iisssssss', $userID, $reqRef, $firstname, $lastname, $position, $email, $evacQty, $request_date, $status);
            $reqDetails->execute();
            // Insert data into receive_request table
            $reqReceive->bind_param('iisssssss', $userID, $reqRef, $firstname, $lastname, $position, $email, $evacQty, $request_date, $status);
            $reqReceive->execute();
            if (!$reqDetails->execute() && !$reqReceive->execute()){
                throw new Exception('There was a problem executing the query' . $conn->error);
            }else{
                $response = [
                    "status" => "Success",
                    "message" => "Your request is successfully created",
                    "icon" => "success",
                ];
                header("Content-Type: application/json");
                echo json_encode($response);
                exit();
            }

        }
    } catch (Exception $e) {
        $response = [
            "status" => "Error",
            "message" => $e->getMessage(),
            "icon" => "error",
        ];
        header("Content-Type: application/json");
        echo json_encode($response);
        exit();
    }

    foreach ($category as $categ) {
        $categDetails = $conn->prepare("INSERT INTO request_category (request_id,categoryName,quantity,notes) VALUES (?,?,?,?)");
        try {
            if (!$categDetails) {
                throw new Exception('There was a problem executing the query' . $conn->error);
            } else {
                $categDetails->bind_param('isss', $reqRef, $categ, $quantity[$count], $notes[$count]);
                if (!$categDetails->execute()) {
                    throw new Exception('There was a problem executing the query' . $conn->error);
                } else {
                    $resultcount++;
                    $count++;
                    exit();
                }
            }
        } catch (Exception $e) {
            $response = [
                "status" => "Error",
                "message" => $e->getMessage(),
                "icon" => "error",
            ];
            header("Content-Type: application/json");
            echo json_encode($response);
            exit();    
        }
    }
    $reqRef++;
    $requestRefUpdate = $conn->prepare("UPDATE ref_request set request_id=?");
    try {
        if (!$requestRefUpdate) {
            throw new Exception('There was a problem executing the query' . $conn->error);
        } else {
            $requestRefUpdate->bind_param('i', $reqRef);
            $requestRefUpdate->execute();
        }
    } catch (Exception $e) {
        $response = [
            "status" => "Error",
            "message" => $e->getMessage(),
            "icon" => "error",
        ];
        header("Content-Type: application/json");
        echo json_encode($response);
        exit();    

    }
}
