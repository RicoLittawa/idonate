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
    $checkRes = $_POST['result'];

    function insertDonationItem10($conn, $reference, $productName, $quantity, $typeArray, $unitArray)
    {
        $list = $conn->prepare("INSERT INTO donation_items10 (Reference, productName, type, unit, quantity) VALUES (?, ?, ?, ?, ?)");
        try {
            if (!$list) {
                throw new Exception('There was a problem connecting to the database');
            } else {
                $list->bind_param('issss', $reference, $productName, $typeArray, $unitArray, $quantity);
                if (!$list->execute()) {
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
    };

    function checkProduct($conn, $productName, $quantityArray, $tableName, $typeArray, $unitArray)
    {
        $checkProductExist = $conn->prepare("SELECT type, unit, quantity, id FROM $tableName WHERE LOWER(productName) = LOWER(?)");
        try {
            if (!$checkProductExist) {
                throw new Exception('There was a problem connecting to the database');
            } else {
                $checkProductExist->bind_param('s', $productName);
                $checkProductExist->execute();
                $exist = $checkProductExist->get_result();
                if ($exist->num_rows > 0) {
                    $existingProducts = array();
    
                    while ($existedProduct = $exist->fetch_assoc()) {
                        $existingProducts[] = $existedProduct;
                    }
    
                    // Flag to track if an update has been performed
                    $isUpdated = false;
    
                    foreach ($existingProducts as $product) {
                        $existedType = $product['type'];
                        $existedUnit = $product['unit'];
                        $existedQuantity = $product['quantity'];
                        $existedId = $product['id'];
    
                        // Check if the type and unit match
                        if ($existedType === $typeArray && $existedUnit === $unitArray) {
                            // Update the quantity
                            $newQuantity = $existedQuantity + $quantityArray;
                            $updateProduct = $conn->prepare("UPDATE $tableName SET quantity = ? WHERE id = ?");
                            if (!$updateProduct) {
                                throw new Exception('There was a problem connecting to the database');
                            } else {
                                $updateProduct->bind_param('is', $newQuantity, $existedId);
                                $updateProduct->execute();
                                $isUpdated = true;
                            }
                        }
                    }
    
                    // If no update was performed, insert a new entry
                    if (!$isUpdated) {
                        $insertNewProduct = $conn->prepare("INSERT INTO $tableName (productName, type, quantity, unit) VALUES (?, ?, ?, ?)");
                        if (!$insertNewProduct) {
                            throw new Exception('There was a problem connecting to the database');
                        } else {
                            $insertNewProduct->bind_param('ssss', $productName, $typeArray, $quantityArray, $unitArray);
                            $insertNewProduct->execute();
                        }
                    }
                } 
                else {
                    // Product does not exist, insert a new entry
                    $insertNewProduct = $conn->prepare("INSERT INTO $tableName (productName, type, quantity, unit) VALUES (?, ?, ?, ?)");
                    if (!$insertNewProduct) {
                        throw new Exception('There was a problem connecting to the database');
                    } else {
                        $insertNewProduct->bind_param('ssss', $productName, $typeArray, $quantityArray, $unitArray);
                        $insertNewProduct->execute();
                    }
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
    


    foreach ($checkRes as $res) {
        /*************************IF CAN/NOODLES IS CHECKED******************************************************************************/
        if ($res == 'can-noodles') {
            $pnCN_arr = $_POST['pnCN_arr'];
            $qCN_arr = $_POST['qCN_arr'];
            foreach ($pnCN_arr as $index => $cn) {
                insertDonationItem10($conn, $reference_id, $cn, $qCN_arr[$index], null, null);
                checkProduct($conn, $cn, $qCN_arr[$index], "categcannoodles", null, null);
            }
        }
        /*************************IF CAN/NOODLES IS CHECKED******************************************************************************/

        /*************************IF HYGINE ESSENTIALS IS CHECKED******************************************************************************/
        if ($res == 'hygine-essentials') {
            $pnHY_arr = $_POST['pnHY_arr'];
            $qHY_arr = $_POST['qHY_arr'];
            foreach ($pnHY_arr as $index => $hy) {
                insertDonationItem10($conn, $reference_id, $hy, $qHY_arr[$index], null, null);
                checkProduct($conn, $hy, $qHY_arr[$index], "categhygineessential", null, null);
            }
        }
        /*************************IF HYGINE ESSENTIALS IS CHECKED******************************************************************************/

        /*************************IF INFANT ITEMS IS CHECKED******************************************************************************/
        if ($res == 'infant-items') {
            $pnII_arr = $_POST['pnII_arr'];
            $qII_arr = $_POST['qII_arr'];
            foreach ($pnII_arr as $index => $ii) {
                insertDonationItem10($conn, $reference_id, $ii, $qII_arr[$index], null, null);
                checkProduct($conn, $ii, $qII_arr[$index], "categinfant", null, null);
            }
        }
        /*************************IF INFANT ITEMS IS CHECKED******************************************************************************/

        /*************************IF DRINKING WATER IS CHECKED******************************************************************************/
        if ($res == 'drink-water') {
            $pnDW_arr = $_POST['pnDW_arr'];
            $qDW_arr = $_POST['qDW_arr'];
            foreach ($pnDW_arr as $index => $dw) {
                insertDonationItem10($conn, $reference_id, $dw, $qDW_arr[$index], null, null);
                checkProduct($conn, $dw, $qDW_arr[$index], "categdrinkingwater", null, null);
            }
        }
        /*************************IF DRINKING WATER IS CHECKED******************************************************************************/

        /*************************IF MEAT/GRAINS IS CHECKED******************************************************************************/
        if ($res == 'meat-grains') {
            $pnMG_arr = $_POST['pnMG_arr'];
            $typeMG_arr = $_POST['typeMG_arr'];
            $qMG_arr = $_POST['qMG_arr'];
            $unitMG_arr = $_POST['unitMG_arr'];
            foreach ($pnMG_arr as $index => $mg) {
                insertDonationItem10($conn, $reference_id, $mg, $qMG_arr[$index], $typeMG_arr[$index], $unitMG_arr[$index]);
                checkProduct($conn, $mg, $qMG_arr[$index], "categmeatgrains", $typeMG_arr[$index], $unitMG_arr[$index]);
            }
        }
        /*************************IF MEAT/GRAINS IS CHECKED******************************************************************************/

        /*************************IF MEDICINE IS CHECKED******************************************************************************/
        if ($res == 'medicine') {
            $pnME_arr = $_POST['pnME_arr'];
            $typeME_arr = $_POST['typeME_arr'];
            $qME_arr = $_POST['qME_arr'];
            $unitME_arr = $_POST['unitME_arr'];
            foreach ($pnME_arr as $index => $me) {
                insertDonationItem10($conn, $reference_id, $me, $qME_arr[$index], $typeME_arr[$index], $unitME_arr[$index]);
                checkProduct($conn, $me, $qME_arr[$index], "categmedicine", $typeME_arr[$index], $unitME_arr[$index]);
            }
        }
        /*************************IF MEDICINE IS CHECKED******************************************************************************/

        /*************************IF OTHERS IS CHECKED******************************************************************************/
        if ($res == 'others') {
            $pnOT_arr = $_POST['pnOT_arr'];
            $typeOT_arr = $_POST['typeOT_arr'];
            $qOT_arr = $_POST['qOT_arr'];
            $unitOT_arr = $_POST['unitOT_arr'];
            if (empty($unitOT_arr)) {
                $unitOT_arr = null;
            }
            if (empty($typeOT_arr)) {
                $typeOT_arr = null;
            }
            foreach ($pnOT_arr as $index => $ot) {
                insertDonationItem10($conn, $reference_id, $ot, $qOT_arr[$index], $typeOT_arr[$index], $unitOT_arr[$index]);
                checkProduct($conn, $ot, $qOT_arr[$index], "categmeatgrains", $typeOT_arr[$index], $unitOT_arr[$index]);
            }
        }
        /*************************IF OTHERS IS CHECKED******************************************************************************/
    }

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
