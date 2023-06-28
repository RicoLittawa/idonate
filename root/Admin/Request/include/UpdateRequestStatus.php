<?php
require_once '../../../../config/config.php';
include "../../include/sidebar.php";

if (isset($_POST['saveStatus'])) {
    $reference = $_POST['reference'];
    $selectedStatus = $_POST['selectStatus'];
    $manilaTimezone = new DateTimeZone('Asia/Manila');
    $currentDateTime = new DateTime('now', $manilaTimezone);
    $timestamp = $currentDateTime->format('Y-m-d H:i:s');
    switch ($selectedStatus) {
            //When status is set for ready for pickup
        case "Ready for Pick-up":
            $onProcessData = "SELECT productName, quantity FROM on_process WHERE reciept_number=?";
            $onProcessDataStatement = $conn->prepare($onProcessData);
            
            try {
                if (!$onProcessDataStatement) {
                    throw new Exception('There was a problem connecting to the database');
                } else {
                    $onProcessDataStatement->bind_param('i', $reference);
                    $onProcessDataStatement->execute();
                    $onProcessResult = $onProcessDataStatement->get_result();
            
                    $updateSuccess = true; // Flag to check if all updates are successful
            
                    while ($onProcessRow = $onProcessResult->fetch_assoc()) {
                        $onProcessProduct = $onProcessRow['productName'];
                        $onProcessQuantity = $onProcessRow['quantity'];
            
                        // Get Stocks
                        $stocksCategory = "SELECT category, quantity FROM (
                            SELECT 'categcannoodles' as category, quantity, productName FROM categcannoodles
                            UNION ALL
                            SELECT 'categdrinkingwater' as category, quantity, productName FROM categdrinkingwater
                            UNION ALL
                            SELECT 'categhygineessential' as category, quantity, productName FROM categhygineessential
                            UNION ALL
                            SELECT 'categinfant' as category, quantity, productName FROM categinfant
                            UNION ALL
                            SELECT 'categmeatgrains' as category, quantity, productName FROM categmeatgrains
                            UNION ALL
                            SELECT 'categmedicine' as category, quantity, productName FROM categmedicine
                            UNION ALL
                            SELECT 'categothers' as category, quantity, productName FROM categothers
                        ) as allProducts 
                        WHERE productName = LOWER(?) 
                        GROUP BY category";
            
                        $stocksCategoryStatement = $conn->prepare($stocksCategory);
                        $stocksCategoryStatement->bind_param('s', $onProcessProduct);
                        $stocksCategoryStatement->execute();
                        $stocksCategoryResult = $stocksCategoryStatement->get_result();
            
                        if ($stocksRow = $stocksCategoryResult->fetch_assoc()) {
                            $stocksQuantity = $stocksRow['quantity'];
            
                            // Subtract the quantity from the on process to the category product quantity
                            $newQuantity = $stocksQuantity - $onProcessQuantity;
                            $categoryName = $stocksRow['category']; // Determine tables in db
            
                            // Get distributed
                            $distributedData = "SELECT distributed FROM " . strtolower($categoryName) . " WHERE productName = LOWER(?)";
                            $distributedStatement = $conn->prepare($distributedData);
                            $distributedStatement->bind_param('s', $onProcessProduct);
                            $distributedStatement->execute();
                            $distributedResult = $distributedStatement->get_result();
            
                            if ($distributedRow = $distributedResult->fetch_assoc()) {
                                $distributedQuantity = $distributedRow['distributed'];
                                $newDistributedQuantity = $distributedQuantity + $onProcessQuantity;
                            }
            
                            // Update the category table with the new quantity
                            $updateStocks = "UPDATE " . strtolower($categoryName) . " SET quantity = ?, distributed = ? WHERE productName = LOWER(?)";
                            $updateStockStatement = $conn->prepare($updateStocks);
                            $updateStockStatement->bind_param('iss', $newQuantity, $newDistributedQuantity, $onProcessProduct);
                            $updateSuccess = $updateStockStatement->execute() && $updateSuccess;
                        } else {
                            // Handle error: product not found in any category table
                            throw new Exception("Product not found in any category table");
                        }
                    }
            
                    if ($updateSuccess) {
                        updateRequestStatus($conn, $selectedStatus, $reference);
                        $statusMessage = "is ready for pick-up";
                        addToNotification($conn, $reference, $statusMessage);
            
                        $response = [
                            "status" => "Success",
                            "message" => "Status is updated successfully",
                            "icon" => "success",
                        ];
            
                        header("Content-Type: application/json");
                        echo json_encode($response);
                        exit();
                    } else {
                        throw new Exception("Failed to update stocks for one or more products");
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
            break;
        case "Request cannot be completed":
            updateRequestStatus($conn, $selectedStatus, $reference);
            $statusMessage = "is cannot be completed";
            addToNotification($conn,$reference,$statusMessage);
            $response = [
                "status" => "Success",
                "message" => "Status is updated successfully",
                "icon" => "success",
            ];

            header("Content-Type: application/json");
            echo json_encode($response);
            exit();
            break;
        case "Request completed":
            $updateStatus1 = "UPDATE request set status= ?,status_timestamp=?, receivedate=? where request_id=?";
            $updateStatusStatement1 = $conn->prepare($updateStatus1);
            $updateStatusStatement1->bind_param('sssi', $selectedStatus, $timestamp, $timestamp, $reference);
            $updateStatusStatement1->execute();
            $updateStatus2 = "UPDATE receive_request set status= ?,status_timestamp=?,receivedate=? where request_id=?";
            $updateStatusStatement2 = $conn->prepare($updateStatus2);
            $updateStatusStatement2->bind_param('sssi', $selectedStatus, $timestamp, $timestamp, $reference);
            $updateStatusStatement2->execute();
            $statusMessage = "is completed";
            addToNotification($conn,$reference,$statusMessage);
            $response = [
                "status" => "Success",
                "message" => "Status is updated successfully",
                "icon" => "success",
            ];

            header("Content-Type: application/json");
            echo json_encode($response);
            exit();
            break;
    }
}
