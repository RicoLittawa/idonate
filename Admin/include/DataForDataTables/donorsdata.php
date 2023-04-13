<?php 
require_once '../connection.php';

$getDonors =  "SELECT donor_id,donor_name,donor_email,donor_contact,donationDate,email_status,certificate FROM donation_items ORDER BY donor_id DESC";
$getDonorStatement= $conn->prepare($getDonors);
$getDonorStatement->execute();
$getDonorResult= $getDonorStatement->get_result();
while ($get= $getDonorResult->fetch_assoc()){
    $donorId= $get['donor_id'];
    $donorName= $get['donor_name'];
    $donorEmail= $get['donor_email'];
    $donorContact= $get['donor_contact'];
    $donationDate= $get['donationDate'];
    $emailStatus= $get['email_status'];
    $certificate= $get['certificate'];

    $data[]= array(
        'donorId'=> $donorId,
        'donorName'=> $donorName,
        'donorEmail'=> $donorEmail,
        'donorContact'=> $donorContact,
        'donationDate'=> $donationDate,
        'emailStatus'=> $emailStatus,
        'certificate'=> $certificate
    );

}
header('Content-Type: application/json');
echo json_encode(array('data' => $data));