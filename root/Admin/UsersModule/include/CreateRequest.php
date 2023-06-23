<?php
require_once '../../../../config/config.php';
require_once '../../include/protect.php';
//accept request
if (isset($_POST['createBtn'])) {
    $reqRef = $_POST['reqRef'];
    $request_id = $_POST['reqRef'];
    $request_date = $_POST['request_date'];
    $manilaTimezone = new DateTimeZone('Asia/Manila');
    $currentDateTime = new DateTime('now', $manilaTimezone);
    $currentDate = $currentDateTime->format('Y-m-d');
    $currentTime = $currentDateTime->format('H:i:s');
    $timestamp = $request_date . ' ' . $currentTime;
    $evacQty = trim($_POST['evacQty']);
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $notes = $_POST['notes'];
    try {
        $user = $conn->prepare("SELECT firstname, lastname, email, position FROM adduser WHERE uID = ?");

        if (!$user) {
            throw new Exception('There was a problem connecting to the database');
        } else {
            $user->bind_param('i', $userID);
            $user->execute();
            $userResult = $user->get_result();
            if ($userResult->num_rows === 0) {
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
        $count = 0;
        $resultcount = 0;
        $status = "pending";
        $reqDetails = $conn->prepare("INSERT INTO request
 (userID, request_id, firstname, lastname, position, email, evacuees_qty, requestdate, status,deleted_timestamp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,Null)");
        $reqReceive = $conn->prepare("INSERT INTO receive_request 
(userID, request_id, firstname, lastname, position, email, evacuees_qty, requestdate, status,deleted_timestamp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,Null)");

        $reqDetails->bind_param('iisssssss', $userID, $reqRef, $firstname, $lastname, $position, $email, $evacQty, $timestamp, $status);
        $reqDetails->execute();
        // Insert data into receive_request table
        $reqReceive->bind_param('iisssssss', $userID, $reqRef, $firstname, $lastname, $position, $email, $evacQty, $timestamp, $status);
        $reqReceive->execute();
        $response = [
            "status" => "Success",
            "message" => "Your request is successfully created",
            "icon" => "success",
        ];
        header("Content-Type: application/json");
        echo json_encode($response);

        foreach ($category as $categ) {
            $categDetails = $conn->prepare("INSERT INTO request_category (request_id,categoryName,quantity,notes) VALUES (?,?,?,?)");
            $categDetails->bind_param('isss', $reqRef, $categ, $quantity[$count], $notes[$count]);
            if (!$categDetails->execute()) {
                throw new Exception('There was a problem executing the query' . $conn->error);
            } else {
                $resultcount++;
                $count++;
            }
        }
        $reqRef++;
        $requestRefUpdate = $conn->prepare("UPDATE ref_request set request_id=?");
        $requestRefUpdate->bind_param('i', $reqRef);
        $requestRefUpdate->execute();

        //Admin Notification
        $current_timestamp = $currentDateTime->format('Y-m-d H:i:s');
        $selectRequesterId = $conn->prepare("SELECT firstname,lastname from adduser where uID=?");
        $selectRequesterId->bind_param("i", $userID);
        $selectRequesterId->execute();
        $requesterIdResult = $selectRequesterId->get_result();
            if ($requesterIdResult->num_rows === 0) {
                throw new Exception("Request id cannot be found");
            } else {
                $fetchedRequesterId = $requesterIdResult->fetch_assoc();
                $request_firstname = $fetchedRequesterId["firstname"];
                $request_lastname = $fetchedRequesterId["lastname"];
                $date = date('Y-m-d', strtotime($request_date));
                $receiptNumber = str_replace('-', '', $date);
                $message = "{$request_firstname} {$request_lastname} created a new request with receipt number {$receiptNumber}-00{$request_id}";
                $insertNotif = $conn->prepare("INSERT INTO admin_notification (message, timestamp) VALUES (?, ?)");
                $insertNotif->bind_param("ss", $message, $current_timestamp);
                $insertNotif->execute();
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
