<?php
require_once '../../../../config/config.php';
include "../../include/sidebar.php";
if (isset($_POST['submitProcess'])) {
  $request_id = $_POST['request_id'];
  $checkIfSave = false;

  $categories = [
    'CanNoodles' => 'CanNoodlesProduct',
    'Hygine' => 'HygineProduct',
    'InfantItems' => 'InfantItemsProduct',
    'DrinkingWater' => 'DrinkingWaterProduct',
    'MeatGrains' => 'MeatGrainsProduct',
    'Medicine' => 'MedicineProduct',
    'Others' => 'OthersProduct'
  ];

  foreach ($categories as $category => $postKey) {
    if (array_key_exists($postKey, $_POST)) {
      $productArray = $_POST[$postKey];
      $quantityArray = $_POST[$category . 'Quantity'];

      foreach ($productArray as $index => $item) {
        $submitProcess = $conn->prepare("INSERT INTO on_process (reciept_number, productName, quantity) VALUES (?, ?, ?)");
        try {
          if (!$submitProcess) {
            throw new Exception("There was a problem connecting to the database");
          } else {
            $submitProcess->bind_param('iss', $request_id, $item, $quantityArray[$index]);
            $result = $submitProcess->execute();

            if (!$result) {
              throw new Exception("There is a problem saving your data");
            } else {
              $checkIfSave = true;
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
    }
  }

  if ($checkIfSave) {
    $status = "Request was processed";
    updateRequestStatus($conn,$status,$request_id);
    $statusMessage = "has been processed";
    addToNotification($conn,$request_id,$statusMessage);

    $response = [
      "status" => "Success",
      "message" => "Your data is accepted successfully",
      "icon" => "success",
    ];

    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
    $updateStatus->close();
  }

  $conn->close();
}
