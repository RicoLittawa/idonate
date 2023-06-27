<?php
require_once "../../../../config/config.php";

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
            $filePath = "../../include/Certificate Template/";
            $filename = $filePath . basename($_FILES["certificate"]["name"]);
            $filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $fileSize = $_FILES["certificate"]["size"];
            $fileError = $_FILES["certificate"]["error"];
            if (move_uploaded_file($_FILES["certificate"]["tmp_name"],$filePath . $certificate)) {
                $updateCert = $conn->prepare(
                    "UPDATE template_certi set  template= ? where id=?"
                );
                if (!$updateCert) {
                    throw new Exception(
                        'There was a problem executing the query' . $conn->error
                    );
                }
                $updateCert->bind_param("si", $certificate, $id);
                if (!$updateCert->execute()) {
                    throw new Exception(
                        'There was a problem executing the query' . $conn->error
                    );
                } else {
                    $getNewTemplate = $conn->prepare("SELECT template from template_certi where id=?");
                    $getNewTemplate->bind_param("i", $id);
                    if (!$getNewTemplate->execute()) {
                        throw new Exception(
                            'There was a problem executing the query' . $conn->error
                        );
                    } else {
                        $newTemplateResult = $getNewTemplate->get_result();
                        if ($newTemplateResult->num_rows === 0) {
                            throw new Exception(
                                "Failed to fetch the data from database: " . $conn->error
                            );
                        }
                        $newTemp = $newTemplateResult->fetch_assoc();
                        $fetchedTemp = $newTemp['template'];
                        $response = [
                            "status" => "Success",
                            "message" => "Template is updated successfully",
                            "icon" => "success",
                            "data" => $fetchedTemp
                        ];
                        header("Content-Type: application/json");
                        echo json_encode($response);
                        exit();
                    }
                }
            } else {
                throw new Exception("Failed to upload new certificate file.");
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
