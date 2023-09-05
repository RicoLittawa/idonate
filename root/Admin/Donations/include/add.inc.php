<?php
require_once '../../../../config/config.php';
include '../../include/ResponseMessages.php';
if (isset($_POST["saveBtn"])) {
    $reference_id = $_POST['ref_id'];
    $Fname = trim($_POST['fname']);
    $Province = $_POST['province'];
    $Municipality = $_POST['municipality'];
    $Barangay = $_POST['barangay'];
    $Region = $_POST['region'];
    $Email = trim($_POST['email']);
    $Date = date('Y-m-d', strtotime($_POST['donation_date']));
    $Contact = trim($_POST['contact']);
    $category = $_POST["category"];
    $product = $_POST["product"];
    $quantity = $_POST["quantity"];
    $unit = $_POST["unit"];

    $checkIfInserted = false;
    foreach ($product as $index => $pr) {
        $insertProduct = $conn->prepare("INSERT INTO receiveitems (donator_id, product_category, productName, quantity, productUnit, identifiercode, expiryDate, receiveDate) VALUES (?, ?, ?, ?, ?, NULL, NULL, ?)");
        if (!$insertProduct) {
            errorMessage("There was a problem connecting to the database");
        }

        $insertProduct->bind_param("isssss", $reference_id, $category[$index], $pr, $quantity[$index], $unit[$index], $Date);
        if (!$insertProduct->execute()) {
            errorMessage('There was a problem executing the query' . $conn->error);
        } else {
            $checkIfInserted = true;
        }
    }

    if ($checkIfInserted) {
        /*************************INSERT TO DONORS******************************************************************************/
        $donor = $conn->prepare("INSERT INTO donation_items (Reference,donor_name,donor_region,donor_province,donor_municipality, donor_barangay,donor_email,donor_contact,donationDate) VALUES (?,?,?,?,?,?,?,?,?)");
        if (!$donor) {
            errorMessage('There was a problem connecting to the database');
        }

        $donor->bind_param('sssssssss', $reference_id, $Fname, $Region, $Province, $Municipality, $Barangay, $Email, $Contact, $Date);
        if (!$donor->execute()) {
            errorMessage('There was a problem executing the query' . $conn->error);
        }

        /*************************UPDATE REFERENCE EVERY TRANSACTION******************************************************************************/
        $newReference = $reference_id + 1;
        $ref = $conn->prepare("UPDATE donation_items_picking  SET reference_id=? ");
        if (!$ref) {
            errorMessage('There was a problem connecting to the database');
        }

        $ref->bind_param('i', $newReference);
        if (!$ref->execute()) {
            errorMessage('There was a problem executing the query' . $conn->error);
        } else {
            successMessage("Your data is added successfully");
        }
    }
}
