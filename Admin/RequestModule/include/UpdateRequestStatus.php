<?php
require_once '../../include/connection.php';
if (isset($_POST['saveStatus'])) {
    $reference = $_POST['reference'];
    $selectedStatus = $_POST['selectStatus'];

    switch ($selectedStatus) {
        //When status is set for ready for pickup
        case "Ready for Pick-up":
            $onProcessData = "SELECT productName,quantity from on_process where reciept_number=?";
            $onProcessDataStatement = $conn->prepare($onProcessData);
            try {
                if (!$onProcessDataStatement) {
                    throw new Exception('There are problem to the connection of query.');
                } else {
                    $onProcessDataStatement->bind_param('i', $reference);
                    $onProcessDataStatement->execute();
                    $onProcessResult = $onProcessDataStatement->get_result();
                    while ($onProcessRow = $onProcessResult->fetch_assoc()) {
                        $onProcessProduct = $onProcessRow['productName'];
                        $onProcessQuantity = $onProcessRow['quantity'];
                        //Get Stocks
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
                        WHERE productName = lower(?)
                        GROUP BY category";

                        $stocksCategoryStatement = $conn->prepare($stocksCategory);
                        $stocksCategoryStatement->bind_param('s', $onProcessProduct);
                        $stocksCategoryStatement->execute();
                        $stocksCategoryResult = $stocksCategoryStatement->get_result();


                        if ($stocksRow = $stocksCategoryResult->fetch_assoc()) {
                            $stocksQuantity = $stocksRow['quantity'];

                            // subtract the quantity from the on process to the category product quantity
                            $newQuantity = $stocksQuantity - $onProcessQuantity;
                            $categoryName = $stocksRow['category'];//Determine tables in db

                            //Get distributed
                            $distributedData= "SELECT distributed from " . strtolower($categoryName) . " WHERE productName = lower(?) ";
                            $distributedStatement= $conn->prepare($distributedData);
                            $distributedStatement->bind_param('s', $onProcessProduct);
                            $distributedStatement->execute();
                            $distributedResult= $distributedStatement->get_result();
                            if ($distributedRow= $distributedResult->fetch_assoc()){
                                $distributedQuantity= $distributedRow['distributed'];

                                $newDistributedQuantity= $distributedQuantity + $onProcessQuantity;
                            }

                            //update the category table with the new quantity
                            $updateStocks = "UPDATE  " . strtolower($categoryName) . " SET quantity = ? , distributed = ? WHERE productName = lower(?)";
                            $updateStockStatement = $conn->prepare($updateStocks);
                            $updateStockStatement->bind_param('iss', $newQuantity, $newDistributedQuantity , $onProcessProduct);
                            $success = $updateStockStatement->execute();
                            if ($success) {
                                $updateStatus = "UPDATE request set status= ? where request_id=?";
                                $updateStatusStatement = $conn->prepare($updateStatus);
                                $updateStatusStatement->bind_param('si', $selectedStatus, $reference);
                                $updateStatusStatement->execute();
                                echo 'success';
                            }
                        } else {
                            // handle error: product not found in any category table
                            throw new Exception("Product not found in any category table");
                        }
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            break;
        case "Request cannot be proccessed":
            $updateStatus = "UPDATE request set status= ? where request_id=?";
            $updateStatusStatement = $conn->prepare($updateStatus);
            $updateStatusStatement->bind_param('si', $selectedStatus, $reference);
            $updateStatusStatement->execute();
            echo 'success';
            break;
        case "Request completed":
            $currentDate = date('Y-m-d');
            $updateStatus = "UPDATE request set status= ?, recieveDate=? where request_id=?";
            $updateStatusStatement = $conn->prepare($updateStatus);
            $updateStatusStatement->bind_param('ssi', $selectedStatus,$currentDate, $reference);
            $updateStatusStatement->execute();
            echo 'success';
            break;
    }

}
