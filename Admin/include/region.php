<?php
require_once 'connection.php';

// Check if request is set and not empty
if (isset($_POST) && !empty($_POST)) {

    // Select province
    if (isset($_POST['regCode'])) {
        $regCode = $_POST['regCode'];
        $prov = "SELECT provDesc, provCode from refprovince where regCode=?";
        $stmt = $conn->prepare($prov);
        $stmt->bind_param('i', $regCode);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['provCode'] . "'>" . $row['provDesc'] . "</option>";
        }
        $stmt->close();
    }

    // Select municipality
    if (isset($_POST['provCode'])) {
        $provCode = $_POST['provCode'];
        $city = "SELECT citymunDesc, citymunCode from refcitymun where provCode=?";
        $stmt = $conn->prepare($city);
        $stmt->bind_param('i', $provCode);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['citymunCode'] . "'>" . $row['citymunDesc'] . "</option>";
        }
        $stmt->close();
    }

    // Select Barangay
    if (isset($_POST['citymunCode'])) {
        $citymunCode = $_POST['citymunCode'];
        $barangay = "SELECT brgyDesc, brgyCode from refbrgy where citymunCode=?";
        $stmt = $conn->prepare($barangay);
        $stmt->bind_param('i', $citymunCode);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['brgyCode'] . "'>" . $row['brgyDesc'] . "</option>";
        }
        $stmt->close();
    }

    $conn->close();
}
