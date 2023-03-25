<?php
require_once 'connection.php';

if (isset($_POST['submitProcess'])) {
  $request_id = $_POST['request_id'];
  $checkIfSave = false;

  //Check if array of can/noodles exists
  if (array_key_exists('CanNoodlesProduct', $_POST)) {
    $CanNoodlesProduct = $_POST['CanNoodlesProduct'];
    $CanNoodlesQuantity = $_POST['CanNoodlesQuantity'];

    foreach ($CanNoodlesProduct as $index => $itemCanNoodles) {
      $submitProcess = "INSERT INTO on_process (reciept_number,productName,quantity) VALUES(?,?,?)";
      $stmt = $conn->prepare($submitProcess);
      try {
        if (!$stmt) {
          throw new Exception("There are problem while executing query.");
        } else {
          $stmt->bind_param('iss', $request_id, $itemCanNoodles, $CanNoodlesQuantity[$index]);
          $result = $stmt->execute();
          if (!$result) {
            throw new Exception("There are problem saving your data.");
          } else {
            $checkIfSave = true;
          }
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
  }

  //Check if array of hygine essentials exists

  if (array_key_exists('HygineProduct', $_POST)) {
    $HygineProduct = $_POST['HygineProduct'];
    $HygineQuantity = $_POST['HygineQuantity'];

    foreach ($HygineProduct as $index => $itemHygine) {
      $submitProcess = "INSERT INTO on_process (reciept_number,productName,quantity) VALUES(?,?,?)";
      $stmt = $conn->prepare($submitProcess);
      try {
        if (!$stmt) {
          throw new Exception("There are problem while executing query.");
        } else {
          $stmt->bind_param('iss', $request_id, $itemHygine, $HygineQuantity[$index]);
          $result = $stmt->execute();
          if (!$result) {
            throw new Exception("There are problem saving your data.");
          } else {
            $checkIfSave = true;
          }
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
  }

  //Check if array of infant items exists

  if (array_key_exists('InfantProduct', $_POST)) {
    $InfantItemsProduct = $_POST['InfantProduct'];
    $InfantItemsQuantity = $_POST['InfantQuantity'];
    foreach ($InfantItemsProduct as $index => $itemInfant) {
      $submitProcess = "INSERT INTO on_process (reciept_number,productName,quantity) VALUES(?,?,?)";
      $stmt = $conn->prepare($submitProcess);
      try {
        if (!$stmt) {
          throw new Exception("There are problem while executing query.");
        } else {
          $stmt->bind_param('iss', $request_id, $itemInfant, $InfantItemsQuantity[$index]);
          $result = $stmt->execute();
          if (!$result) {
            throw new Exception("There are problem saving your data.");
          } else {
            $checkIfSave = true;
          }
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
  }

  //Check if array of drinking water exists

  if (array_key_exists('DrinkingWaterProduct', $_POST)) {
    $DrinkingWaterProduct = $_POST['DrinkingWaterProduct'];
    $DrinkingWaterQuantity = $_POST['DrinkingWaterQuantity'];
    foreach ($DrinkingWaterProduct as $index => $itemDrink) {
      $submitProcess = "INSERT INTO on_process (reciept_number,productName,quantity) VALUES(?,?,?)";
      $stmt = $conn->prepare($submitProcess);
      try {
        if (!$stmt) {
          throw new Exception("There are problem while executing query.");
        } else {
          $stmt->bind_param('iss', $request_id, $itemDrink, $DrinkingWaterQuantity[$index]);
          $result = $stmt->execute();
          if (!$result) {
            throw new Exception("There are problem saving your data.");
          } else {
            $checkIfSave = true;
          }
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
  }

  //Check if array of meat and Grains exists

  if (array_key_exists('MeatGrainsProduct', $_POST)) {
    $MeatGrainsProduct = $_POST['MeatGrainsProduct'];
    $MeatGrainsQuantity = $_POST['MeatGrainsQuantity'];
    foreach ($MeatGrainsProduct as $index => $itemMeatGrains) {
      $submitProcess = "INSERT INTO on_process (reciept_number,productName,quantity) VALUES(?,?,?)";
      $stmt = $conn->prepare($submitProcess);
      try {
        if (!$stmt) {
          throw new Exception("There are problem while executing query.");
        } else {
          $stmt->bind_param('iss', $request_id, $itemMeatGrains, $MeatGrainsQuantity[$index]);
          $result = $stmt->execute();
          if (!$result) {
            throw new Exception("There are problem saving your data.");
          } else {
            $checkIfSave = true;
          }
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
  }

  //Check if array of medicine exists

  if (array_key_exists('MedicineProduct', $_POST)) {
    $MedicineProduct = $_POST['MedicineProduct'];
    $MedicineQuantity = $_POST['MedicineQuantity'];
    foreach ($MedicineProduct as $index => $itemMedicine) {
      $submitProcess = "INSERT INTO on_process (reciept_number,productName,quantity) VALUES(?,?,?)";
      $stmt = $conn->prepare($submitProcess);
      try {
        if (!$stmt) {
          throw new Exception("There are problem while executing query.");
        } else {
          $stmt->bind_param('iss', $request_id, $itemMedicine, $MedicineQuantity[$count]);
          $result = $stmt->execute();
          if (!$result) {
            throw new Exception("There are problem saving your data.");
          } else {
            $checkIfSave = true;
          }
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
  }

  //Check if array of others exists

  if (array_key_exists('OthersProduct', $_POST)) {
    $OthersProduct = $_POST['OthersProduct'];
    $itemOthers = $_POST['OthersQuantity'];
    foreach ($OthersProduct as $index => $itemOthers) {
      $submitProcess = "INSERT INTO on_process (reciept_number,productName,quantity) VALUES(?,?,?)";
      $stmt = $conn->prepare($submitProcess);
      try {
        if (!$stmt) {
          throw new Exception("There are problem while executing query.");
        } else {
          $stmt->bind_param('iss', $request_id, $itemOthers, $itemOthers[$index]);
          $result = $stmt->execute();
          if (!$result) {
            throw new Exception("There are problem saving your data.");
          } else {
            $checkIfSave = true;
          }
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
  }

  if ($checkIfSave) {
    $status = "Request was processed";
    $updateStatus = "UPDATE request set status=? where request_id=? ";
    $stmt = $conn->prepare($updateStatus);
    $stmt->bind_param('si', $status, $request_id);
    $stmt->execute();

    echo  "success";
  }

  $conn->close();
}
