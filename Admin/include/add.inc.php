<?php
require_once 'connection.php';

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
    foreach ($checkRes as $res) {
        /*************************IF CAN/NOODLES IS CHECKED******************************************************************************/
        if ($res == 'cannoodles') {
            $pnCN_arr = $_POST['pnCN_arr'];
            $qCN_arr = $_POST['qCN_arr'];
            foreach ($pnCN_arr as $index => $cn) {
                $list = "INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,null,null,?)";
                $stmt = $conn->prepare($list);
                try {
                    if (!$stmt) {
                        throw new Exception('There was a problem executing the query.');
                    } else {
                        $stmt->bind_param('iss', $reference_id, $cn, $qCN_arr[$index]);
                        if (!$result = $stmt->execute()) {
                            throw new Exception('There was a problem executing the query.');
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit();
                }

                $checkProductExist = "SELECT quantity FROM categcannoodles WHERE LOWER(productName) = LOWER(?)";
                $stmt = $conn->prepare($checkProductExist);
                try {
                    if (!$stmt) {
                        throw new Exception('There was a problem executing the query.');
                    } else {
                        $stmt->bind_param('s', $cn);
                        $stmt->execute();
                        $exist = $stmt->get_result();
                        if ($exist->num_rows > 0) {
                            // Product already exists, update the quantity
                            $existedProduct = $exist->fetch_assoc();
                            $newQuantity = $existedProduct['quantity'] + $qCN_arr[$index];
                            $updateProduct = "UPDATE categcannoodles SET quantity = ? WHERE LOWER(productName) = LOWER(?)";
                            $stmt = $conn->prepare($updateProduct);
                            if (!$stmt) {
                                throw new Exception('There was a problem executing the query.');
                            } else {
                                $stmt->bind_param('is', $newQuantity, $cn);
                                $stmt->execute();
                            }
                        } else {
                            // Product does not exist, insert a new entry
                            $insertNewProduct = "INSERT INTO categcannoodles ( productName, quantity) VALUES (LOWER(?) , ?)";
                            $stmt = $conn->prepare($insertNewProduct);
                            if (!$stmt) {
                                throw new Exception('There was a problem executing the query.');
                            } else {
                                $stmt->bind_param('ss', $cn, $qCN_arr[$index]);
                                $stmt->execute();
                            }
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit();
                }
            }
        }
        /*************************IF CAN/NOODLES IS CHECKED******************************************************************************/

        /*************************IF HYGINE ESSENTIALS IS CHECKED******************************************************************************/
        if ($res == 'hygine') {
            $pnHY_arr = $_POST['pnHY_arr'];
            $qHY_arr = $_POST['qHY_arr'];
            foreach ($pnHY_arr as $index => $hy) {
                $list = "INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,null,null,?)";
                $stmt = $conn->prepare($list);
                try {
                    if (!$stmt) {
                        throw new Exception('There was a problem executing the query.');
                    } else {
                        $stmt->bind_param('iss', $reference_id, $hy, $qHY_arr[$index]);
                        if (!$result = $stmt->execute()) {
                            throw new Exception('There was a problem executing the query.');
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit();
                }

                $checkProductExist = "SELECT quantity FROM categhygineessential WHERE LOWER(productName) = LOWER(?)";
                $stmt = $conn->prepare($checkProductExist);
                try {
                    if (!$stmt) {
                        throw new Exception('There was a problem executing the query.');
                    } else {
                        $stmt->bind_param('s', $hy);
                        $stmt->execute();
                        $exist = $stmt->get_result();
                        if ($exist->num_rows > 0) {
                            // Product already exists, update the quantity
                            $existedProduct = $exist->fetch_assoc();
                            $newQuantity = $existedProduct['quantity'] + $qHY_arr[$index];
                            $updateProduct = "UPDATE categhygineessential SET quantity = ? WHERE LOWER(productName) = LOWER(?)";
                            $stmt = $conn->prepare($updateProduct);
                            if (!$stmt) {
                                throw new Exception('There was a problem executing the query.');
                            } else {
                                $stmt->bind_param('is', $newQuantity, $hy);
                                $stmt->execute();
                            }
                        } else {
                            // Product does not exist, insert a new entry
                            $insertNewProduct = "INSERT INTO categhygineessential ( productName, quantity) VALUES (LOWER(?) , ?)";
                            $stmt = $conn->prepare($insertNewProduct);
                            if (!$stmt) {
                                throw new Exception('There was a problem executing the query.');
                            } else {
                                $stmt->bind_param('ss', $hy, $qHY_arr[$index]);
                                $stmt->execute();
                            }
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit();
                }
            }
        }
        /*************************IF HYGINE ESSENTIALS IS CHECKED******************************************************************************/

        /*************************IF INFANT ITEMS IS CHECKED******************************************************************************/
        if ($res == 'infant') {
            $pnII_arr = $_POST['pnII_arr'];
            $qII_arr = $_POST['qII_arr'];
            foreach ($pnII_arr as $index => $ii) {
                $list = "INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,null,null,?)";
                $stmt = $conn->prepare($list);
                try {
                    if (!$stmt) {
                        throw new Exception('There was a problem executing the query.');
                    } else {
                        $stmt->bind_param('iss', $reference_id, $ii, $qII_arr[$index]);
                        if (!$result = $stmt->execute()) {
                            throw new Exception('There was a problem executing the query.');
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit();
                }

                $checkProductExist = "SELECT quantity FROM categinfant WHERE LOWER(productName) = LOWER(?)";
                $stmt = $conn->prepare($checkProductExist);
                try {
                    if (!$stmt) {
                        throw new Exception('There was a problem executing the query.');
                    } else {
                        $stmt->bind_param('s', $ii);
                        $stmt->execute();
                        $exist = $stmt->get_result();
                        if ($exist->num_rows > 0) {
                            // Product already exists, update the quantity
                            $existedProduct = $exist->fetch_assoc();
                            $newQuantity = $existedProduct['quantity'] + $qII_arr[$index];
                            $updateProduct = "UPDATE categinfant SET quantity = ? WHERE LOWER(productName) = LOWER(?)";
                            $stmt = $conn->prepare($updateProduct);
                            if (!$stmt) {
                                throw new Exception('There was a problem executing the query.');
                            } else {
                                $stmt->bind_param('is', $newQuantity, $ii);
                                $stmt->execute();
                            }
                        } else {
                            // Product does not exist, insert a new entry
                            $insertNewProduct = "INSERT INTO categinfant ( productName, quantity) VALUES (LOWER(?) , ?)";
                            $stmt = $conn->prepare($insertNewProduct);
                            if (!$stmt) {
                                throw new Exception('There was a problem executing the query.');
                            } else {
                                $stmt->bind_param('ss', $ii, $qII_arr[$index]);
                                $stmt->execute();
                            }
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit();
                }
            }
        }
        /*************************IF INFANT ITEMS IS CHECKED******************************************************************************/

        /*************************IF DRINKING WATER IS CHECKED******************************************************************************/
        if ($res == 'drink') {
            $pnDW_arr = $_POST['pnDW_arr'];
            $qDW_arr = $_POST['qDW_arr'];
            foreach ($pnDW_arr as $index => $dw) {
                $list = "INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,null,null,?)";
                $stmt = $conn->prepare($list);
                try {
                    if (!$stmt) {
                        throw new Exception('There was a problem executing the query.');
                    } else {
                        $stmt->bind_param('iss', $reference_id, $dw, $qDW_arr[$index]);
                        if (!$result = $stmt->execute()) {
                            throw new Exception('There was a problem executing the query.');
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit();
                }

                $checkProductExist = "SELECT quantity FROM categdrinkingwater WHERE LOWER(productName) = LOWER(?)";
                $stmt = $conn->prepare($checkProductExist);
                try {
                    if (!$stmt) {
                        throw new Exception('There was a problem executing the query.');
                    } else {
                        $stmt->bind_param('s', $dw);
                        $stmt->execute();
                        $exist = $stmt->get_result();
                        if ($exist->num_rows > 0) {
                            // Product already exists, update the quantity
                            $existedProduct = $exist->fetch_assoc();
                            $newQuantity = $existedProduct['quantity'] + $qDW_arr[$index];
                            $updateProduct = "UPDATE categdrinkingwater SET quantity = ? WHERE LOWER(productName) = LOWER(?)";
                            $stmt = $conn->prepare($updateProduct);
                            if (!$stmt) {
                                throw new Exception('There was a problem executing the query.');
                            } else {
                                $stmt->bind_param('is', $newQuantity, $dw);
                                $stmt->execute();
                            }
                        } else {
                            // Product does not exist, insert a new entry
                            $insertNewProduct = "INSERT INTO categdrinkingwater ( productName, quantity) VALUES (LOWER(?) , ?)";
                            $stmt = $conn->prepare($insertNewProduct);
                            if (!$stmt) {
                                throw new Exception('There was a problem executing the query.');
                            } else {
                                $stmt->bind_param('ss', $dw, $qDW_arr[$index]);
                                $stmt->execute();
                            }
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit();
                }
            }
        }
        /*************************IF DRINKING WATER IS CHECKED******************************************************************************/

        /*************************IF MEAT/GRAINS IS CHECKED******************************************************************************/
        if ($res == 'meat') {
            $pnMG_arr = $_POST['pnMG_arr'];
            $typeMG_arr = $_POST['typeMG_arr'];
            $qMG_arr = $_POST['qMG_arr'];
            $unitMG_arr = $_POST['unitMG_arr'];
            foreach ($pnMG_arr as $index => $mg) {
                $list = "INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,?,?,?)";
                $stmt = $conn->prepare($list);
                try {
                    if (!$stmt) {
                        throw new Exception('There was a problem executing the query.');
                    } else {
                        $stmt->bind_param('issss', $reference_id, $mg, $typeMG_arr[$index], $unitMG_arr[$index], $qMG_arr[$index]);
                        if (!$result = $stmt->execute()) {
                            throw new Exception('There was a problem executing the query.');
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit();
                }

                $checkProductExist = "SELECT quantity FROM categmeatgrains WHERE LOWER(productName) = LOWER(?)";
                $stmt = $conn->prepare($checkProductExist);
                try {
                    if (!$stmt) {
                        throw new Exception('There was a problem executing the query.');
                    } else {
                        $stmt->bind_param('s', $mg);
                        $stmt->execute();
                        $exist = $stmt->get_result();
                        if ($exist->num_rows > 0) {
                            // Product already exists, update the quantity
                            $existedProduct = $exist->fetch_assoc();
                            $newQuantity = $existedProduct['quantity'] + $qMG_arr[$index];
                            $updateProduct = "UPDATE categmeatgrains SET quantity = ? WHERE LOWER(productName) = LOWER(?)";
                            $stmt = $conn->prepare($updateProduct);
                            if (!$stmt) {
                                throw new Exception('There was a problem executing the query.');
                            } else {
                                $stmt->bind_param('is', $newQuantity, $mg);
                                $stmt->execute();
                            }
                        } else {
                            // Product does not exist, insert a new entry
                            $insertNewProduct = "INSERT INTO categmeatgrains (productName,type,quantity,unit) VALUES (LOWER(?) , ?, ?, ?)";
                            $stmt = $conn->prepare($insertNewProduct);
                            if (!$stmt) {
                                throw new Exception('There was a problem executing the query.');
                            } else {
                                $stmt->bind_param('ssss', $mg, $typeMG_arr[$index],$qMG_arr[$index] ,$unitMG_arr[$index]);
                                $stmt->execute();
                            }
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit();
                }
            }
        }
        /*************************IF MEAT/GRAINS IS CHECKED******************************************************************************/

        /*************************IF MEDICINE IS CHECKED******************************************************************************/
        if ($res == 'meds') {
            $pnME_arr = $_POST['pnME_arr'];
            $typeME_arr = $_POST['typeME_arr'];
            $qME_arr = $_POST['qME_arr'];
            $unitME_arr = $_POST['unitME_arr'];
            foreach ($pnME_arr as $index => $me) {
                $list = "INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,?,?,?)";
                $stmt = $conn->prepare($list);
                try {
                    if (!$stmt) {
                        throw new Exception('There was a problem executing the query.');
                    } else {
                        $stmt->bind_param('issss', $reference_id, $me, $typeME_arr[$index], $unitME_arr[$index], $qME_arr[$index]);
                        if (!$result = $stmt->execute()) {
                            throw new Exception('There was a problem executing the query.');
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit();
                }

                $checkProductExist = "SELECT quantity FROM categmedicine WHERE LOWER(productName) = LOWER(?)";
                $stmt = $conn->prepare($checkProductExist);
                try {
                    if (!$stmt) {
                        throw new Exception('There was a problem executing the query.');
                    } else {
                        $stmt->bind_param('s', $me);
                        $stmt->execute();
                        $exist = $stmt->get_result();
                        if ($exist->num_rows > 0) {
                            // Product already exists, update the quantity
                            $existedProduct = $exist->fetch_assoc();
                            $newQuantity = $existedProduct['quantity'] + $qME_arr[$index];
                            $updateProduct = "UPDATE categmedicine SET quantity = ? WHERE LOWER(productName) = LOWER(?)";
                            $stmt = $conn->prepare($updateProduct);
                            if (!$stmt) {
                                throw new Exception('There was a problem executing the query.');
                            } else {
                                $stmt->bind_param('is', $newQuantity, $me);
                                $stmt->execute();
                            }
                        } else {
                            // Product does not exist, insert a new entry
                            $insertNewProduct = "INSERT INTO categmedicine (productName,type,quantity,unit) VALUES (LOWER(?) , ?, ?, ?)";
                            $stmt = $conn->prepare($insertNewProduct);
                            if (!$stmt) {
                                throw new Exception('There was a problem executing the query.');
                            } else {
                                $stmt->bind_param('ssss', $me, $typeME_arr[$index],$qME_arr[$index] ,$unitME_arr[$index]);
                                $stmt->execute();
                            }
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit();
                }
            }
        }
        /*************************IF MEDICINE IS CHECKED******************************************************************************/

        /*************************IF OTHERS IS CHECKED******************************************************************************/
        if ($res == 'other') {
            $pnOT_arr = $_POST['pnOT_arr'];
            $typeOT_arr = $_POST['typeOT_arr'];
            $qOT_arr = $_POST['qOT_arr'];
            $unitOT_arr = $_POST['unitOT_arr'];
            if (empty($unitOT_arr)){
                $unitOT_arr =null;
            }
            if (empty($typeOT_arr)){
                $typeOT_arr =null;
            }
            foreach ($pnOT_arr as $index => $ot) {
                $list = "INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,?,?,?)";
                $stmt = $conn->prepare($list);
                try {
                    if (!$stmt) {
                        throw new Exception('There was a problem executing the query.');
                    } else {
                        $stmt->bind_param('issss', $reference_id, $ot, $typeOT_arr[$index], $unitOT_arr[$index], $qOT_arr[$index]);
                        if (!$result = $stmt->execute()) {
                            throw new Exception('There was a problem executing the query.');
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit();
                }

                $checkProductExist = "SELECT quantity FROM categothers WHERE LOWER(productName) = LOWER(?)";
                $stmt = $conn->prepare($checkProductExist);
                try {
                    if (!$stmt) {
                        throw new Exception('There was a problem executing the query.');
                    } else {
                        $stmt->bind_param('s', $ot);
                        $stmt->execute();
                        $exist = $stmt->get_result();
                        if ($exist->num_rows > 0) {
                            // Product already exists, update the quantity
                            $existedProduct = $exist->fetch_assoc();
                            $newQuantity = $existedProduct['quantity'] + $qOT_arr[$index];
                            $updateProduct = "UPDATE categothers SET quantity = ? WHERE LOWER(productName) = LOWER(?)";
                            $stmt = $conn->prepare($updateProduct);
                            if (!$stmt) {
                                throw new Exception('There was a problem executing the query.');
                            } else {
                                $stmt->bind_param('is', $newQuantity, $ot);
                                $stmt->execute();
                            }
                        } else {
                            // Product does not exist, insert a new entry
                            $insertNewProduct = "INSERT INTO categothers (productName,type,quantity,unit) VALUES (LOWER(?) , ?, ?, ?)";
                            $stmt = $conn->prepare($insertNewProduct);
                            if (!$stmt) {
                                throw new Exception('There was a problem executing the query.');
                            } else {
                                $stmt->bind_param('ssss', $ot, $typeOT_arr[$index],$qOT_arr[$index], $unitOT_arr[$index]);
                                $stmt->execute();
                            }
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit();
                }
            }
        }
        /*************************IF OTHERS IS CHECKED******************************************************************************/
    }

    /*************************INSERT TO DONORS******************************************************************************/
    $donor = "INSERT INTO donation_items (Reference,donor_name,donor_region,donor_province,donor_municipality,
         donor_barangay,donor_email,donor_contact,donationDate) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($donor);
    try {
        if (!$stmt) {
            throw new Exception('There was a problem executing the query.');
        } else {
            $stmt->bind_param('sssssssss', $reference_id, $Fname, $Region, $Province, $Municipality, $Barangay, $Email, $Contact, $Date);
            if (!$stmt->execute()) {
                throw new Exception('There was a problem executing the query.');
            }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }

    /*************************UPDATE REFERENCE EVERY TRANSACTION******************************************************************************/

    $reference_id++;
    $ref = "UPDATE donation_items_picking  set reference_id=? ";
    $stmt = $conn->prepare($ref);
    try {
        if (!$stmt) {
            throw new Exception('There was a problem executing the query.');
        } else {
            $stmt->bind_param('i', $reference_id);
            if (!$stmt->execute()) {
                throw new Exception('There was a problem executing the query.');
            } else {
                echo "success";
            }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
    $stmt->close();
    $conn->close();
}
