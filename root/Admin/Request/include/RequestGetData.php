<?php
require_once '../../../config/config.php';
//Get from request table
if (isset($_GET['requestId'])) {
	$reference = $_GET['requestId'];

	try {
		$getRequest = "SELECT firstname,lastname,position,email,evacuees_qty,requestdate,status from receive_request where request_id=?";
		$stmt = $conn->prepare($getRequest);
		$stmt->bind_param('i', $reference);
		$stmt->execute();
		$getResult = $stmt->get_result();
		$get = $getResult->fetch_assoc();

		if (!$get) {
			echo "Reference not found.";
		} else {
			$fname = $get['firstname'];
			$lname = $get['lastname'];
			$position = $get['position'];
			$requestemail = $get['email'];
			$evacuees_qty = $get['evacuees_qty'];
			$requestdate = $get['requestdate'];
			$dateTrimmed = str_replace('-', '', $requestdate);
			$status = $get['status'];

			// Do something with the retrieved data here
		}
	} catch (Exception $e) {
		echo  $e->getMessage();
	}
}
