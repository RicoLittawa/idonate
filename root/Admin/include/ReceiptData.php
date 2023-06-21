<?php
require_once '../../../config/config.php';

if (isset($_GET['requestId'])) {
    $reference = $_GET['requestId'];
    try {
        $getRequest = $conn->prepare("SELECT * FROM receive_request WHERE request_id=?");
        $getRequest->bind_param('i', $reference);

        if (!$getRequest->execute()) {
            throw new Exception('There was a problem executing the query: ' . $conn->error);
        } else {
            $getResult = $getRequest->get_result();

            if ($getResult->num_rows === 0) {
                throw new Exception('Failed to fetch data from the database: ' . $conn->error);
            } else {
                $data = array();

                while ($get = $getResult->fetch_assoc()) {
                    $fname = $get['firstname'];
                    $lname = $get['lastname'];
                    $position = $get['position'];
                    $requestemail = $get['email'];
                    $evacuees_qty = $get['evacuees_qty'];
                    $requestdate = $get['requestdate'];
                    $formattedrequest = date('Y-m-d', strtotime($requestdate));
                    $dateTrimmed = str_replace('-', '', $formattedrequest);
                    $status = $get['status'];
                    $receivedate = $get['receivedate'];


                    $data[] = array(
                        'fname' => $fname,
                        'lname' => $lname,
                        'position' => $position,
                        'requestemail' => $requestemail,
                        'evacuees_qty' => $evacuees_qty,
                        'dateTrimmed' => $dateTrimmed,
                        "requestdate"=>$requestdate,
                        'status' => $status,
                        'receivedate' => $receivedate
                    );
                }

                // Retrieve additional data from the on_process table
                $onProcess = "SELECT * FROM on_process WHERE reciept_number=?";
                $stmt = $conn->prepare($onProcess);
                $stmt->bind_param('i', $reference);
                $stmt->execute();
                $result = $stmt->get_result();
                $onProcessData = array();

                while ($row = $result->fetch_assoc()) {
                    $onProcessData[] = $row;
                }
                $getCreatedRequest = $conn->prepare("SELECT categoryName,quantity from request_category where request_id=?");
                $getCreatedRequest->bind_param("i", $reference);
                $getCreatedRequest->execute();
                $getResult= $getCreatedRequest->get_result();
                $onCategoryData= array();

                while ($getCreated= $getResult->fetch_assoc()){
                    
                    $category = $getCreated["categoryName"];
                    $quantity = $getCreated["quantity"];
                    $getCategory = $conn->prepare("SELECT category from category where categCode=?");
                    $getCategory->bind_param("s",$category);
                    $getCategory->execute();
                    $categResult= $getCategory->get_result();
                    $categ= $categResult->fetch_assoc();
                    $fetchedCategory = $categ["category"];

                    $onCategoryData[] = array(
                        'category' => $fetchedCategory,
                        'quantity'=> $quantity,
                        'created'=>true
                    );

                }

                header('Content-Type: application/json');
                echo json_encode(array('requestData' => $data, 'onProcessData' => $onProcessData, "onCategoryData"=>$onCategoryData));
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>
