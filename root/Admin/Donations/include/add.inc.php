<?php
require_once '../../../../config/config.php';

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



    return;
   


    /*************************INSERT TO DONORS******************************************************************************/
    $donor = $conn->prepare("INSERT INTO donation_items (Reference,donor_name,donor_region,donor_province,donor_municipality,
    donor_barangay,donor_email,donor_contact,donationDate) VALUES (?,?,?,?,?,?,?,?,?)");
    try {
        if (!$donor) {
            throw new Exception('There was a problem connecting to the database');
        } else {
            $donor->bind_param('sssssssss', $reference_id, $Fname, $Region, $Province, $Municipality, $Barangay, $Email, $Contact, $Date);
            if (!$donor->execute()) {
                throw new Exception('There was a problem executing the query' . $conn->error);
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
    /*************************UPDATE REFERENCE EVERY TRANSACTION******************************************************************************/
    $reference_id++;
    $ref = $conn->prepare("UPDATE donation_items_picking  set reference_id=? ");
    try {
        if (!$ref) {
            throw new Exception('There was a problem connecting to the database');
        } else {
            $ref->bind_param('i', $reference_id);
            if (!$ref->execute()) {
                throw new Exception('There was a problem executing the query' . $conn->error);
            } else {
                $response = [
                    "status" => "Success",
                    "message" => "Your data is added successfully",
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
}
