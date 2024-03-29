<?php
require_once '../../../../config/config.php';
$data = array();
$getDonors =  "SELECT donor_id,donor_name,donor_email,donor_contact,donationDate,email_status,certificate,Reference FROM donation_items";
$getDonorStatement = $conn->prepare($getDonors);
try {
    if (!$getDonorStatement) {
        throw new Exception('There was a problem connecting to the database');
    } else {
        $getDonorStatement->execute();
        $getDonorResult = $getDonorStatement->get_result();
    }
    if ($getDonorResult->num_rows < 0) {
        throw new Exception("Failed to fetch data from database" . $conn->error);
    } else {
        while ($get = $getDonorResult->fetch_assoc()) {
            $donorId = $get['donor_id'];
            $donorName = $get['donor_name'];
            $donorEmail = $get['donor_email'];
            $donorContact = $get['donor_contact'];
            $donationDate = $get['donationDate'];
            $emailStatus = $get['email_status'];
            $certificate = $get['certificate'];
            $reference = $get['Reference'];
            $data[] = array(
                'donorId' => $donorId,
                'donorName' => $donorName,
                'donorEmail' => $donorEmail,
                'donorContact' => $donorContact,
                'donationDate' => $donationDate,
                'emailStatus' => $emailStatus,
                'certificate' => $certificate,
                'reference' => $reference
            );
        }
        header('Content-Type: application/json');
        echo json_encode(array('data' => $data));
    }
} catch (Exception $e) {
    echo $e->getMessage();
    $getDonorStatement->close();
    $conn->close();
}
