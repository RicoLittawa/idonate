<?php
require_once '../../../../config/config.php';

if (isset($_POST["saveBtn"])) {
    try {
        $id = $_POST["templateId"];
        $prevImage = $_POST["filename"];
        $certificate = $_FILES["certificate"]["name"];

        // Check if a new certificate file has been uploaded
        if (!empty($certificate)) {
            $validPath = "../../include/Certificate Template/" . $prevImage;
            if (!unlink($validPath)) {
                throw new Exception("Failed to delete previous certificate file.");
            }
            $deletePrevCert = $conn->prepare("DELETE from template_certi where id=?");
            if (!$deletePrevCert) {
                throw new Exception(
                    "Failed to prepare delete statement: " . $conn->error
                );
            }
            $deletePrevCert->bind_param("i", $id);
            if (!$deletePrevCert->execute()) {
                throw new Exception(
                    "Failed to delete previous certificate from database: " . $conn->error
                );
            }
            $filePath = "../../include/Certificate Template/";
            $filename = $filePath . basename($_FILES["certificate"]["name"]);
            $filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $fileSize = $_FILES["certificate"]["size"];
            $fileError = $_FILES["certificate"]["error"];
            if (
                move_uploaded_file(
                    $_FILES["certificate"]["tmp_name"],
                    $filePath . $certificate
                )
            ) {
                $updateCert = $conn->prepare(
                    "INSERT INTO template_certi (template) value(?)"
                );
                if (!$updateCert) {
                    throw new Exception(
                        "Failed to prepare insert statement: " . $conn->error
                    );
                }
                $updateCert->bind_param("s", $certificate);
                if (!$updateCert->execute()) {
                    throw new Exception(
                        "Failed to insert new certificate into database: " . $conn->error
                    );
                }
                echo "uploaded";
            } else {
                throw new Exception("Failed to upload new certificate file.");
            }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
