<?php
require_once '../../../config/config.php';
//Get from request table
if (isset($_GET['requestId'])) {
	$reference = $_GET['requestId'];

	try {
		$getRequest = $conn->prepare("SELECT firstname,lastname,position,email,evacuees_qty,requestdate,status from receive_request where request_id=?");
		$getRequest->bind_param('i', $reference);
		if (!$getRequest->execute()) {
			throw new Exception('There was a problem executing the query' . $conn->error);
		} else {
			$getResult = $getRequest->get_result();
			if ($getResult->num_rows === 0) {
				throw new Exception("Failed to fetch data from database" . $conn->error);
			} else {
				$get = $getResult->fetch_assoc();
				$fname = $get['firstname'];
				$lname = $get['lastname'];
				$position = $get['position'];
				$requestemail = $get['email'];
				$evacuees_qty = $get['evacuees_qty'];
				$requestdate = $get['requestdate'];
				$dateTrimmed = str_replace('-', '', $requestdate);
				$status = $get['status'];
			}
		}
	} catch (Exception $e) {
		echo  $e->getMessage();
	}
}
