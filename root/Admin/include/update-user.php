<?php
require_once '../../../config/config.php';
/*****************Update account*********************************/
if (isset($_POST['updateBtn'])) {
    $uID = $_POST["uID"];
    $fname = trim($_POST["fname"]);
    $lname = trim($_POST["lname"]);
    $position = trim($_POST["position"]);
    $email = trim($_POST["email"]);
    $address = trim($_POST["address"]);
    $Image = $_FILES['profileImg']['name'];
    if ($Image == null) {
        $sql = "UPDATE adduser set firstname=?,lastname=?,position=?,email=?,address=? where uID=?";
        $stmt = $conn->prepare($sql);
        try {
            if (!$stmt) {
                throw new Exception('There was a problem executing the query.');
            } else {
                $stmt->bind_param("sssssi", $fname, $lname, $position, $email, $address, $uID);
                if (!$stmt->execute()) {
                    throw new Exception('There was a problem executing the query.');
                } else {
                    echo "success";
                }
            }
        } catch (Exception $e) {
            if ($e->getCode() == 1062) {
                // Handle duplicate email error
                echo "Email already exists";
            } else {
                // Handle other errors
                echo $e->getMessage();
            }
        }
    } else {
        $selectOldImg = "SELECT profile from adduser where uID=?";
        $stmt = $conn->prepare($selectOldImg);
        $stmt->bind_param('i', $uID);
        $stmt->execute();
        $oldRes = $stmt->get_result();
        $old = $oldRes->fetch_assoc();
        $oldImg = $old['profile'];
        $path = "../include/profile/" . $oldImg;
        if ($oldImg != null) {
            if (file_exists($path)) {
                unlink($path);
            }
        }
        /*****************Update account*********************************/

        /*****************Upload new image**********************************/
        $filePath = '../../include/profile/';
        $filename = $uID . '_' . basename($_FILES['profileImg']['name']);
        $filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $fileSize = $_FILES['profileImg']['size'];
        $fileError = $_FILES['profileImg']['error'];
        if (move_uploaded_file($_FILES['profileImg']['tmp_name'], $filePath . $filename)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $sql = "UPDATE adduser set firstname=?,lastname=?,position=?,email=?,address=?,profile=? where uID=?";
                    $stmt = $conn->prepare($sql);
                    try {
                        if (!$stmt) {
                            throw new Exception('There was a problem executing the query.');
                        } else {
                            $stmt->bind_param("ssssssi", $fname, $lname, $position, $email, $address, $filename, $uID);
                            if (!$stmt->execute()) {
                                throw new Exception('There was a problem executing the query.');
                            } else {
                                echo "success";
                            }
                        }
                    } catch (Exception $e) {
                        if ($e->getCode() == 1062) {
                            // Handle duplicate email error
                            echo "Error: Email already exists";
                        } else {
                            // Handle other errors
                            echo $e->getMessage();
                        }
                    }
                    
                }
            }
        }
        /*****************Upload new image**********************************/
    }
}

/*****************Update Password**********************************/
if (isset($_POST['updatePassword'])) {
    $passUID = $_POST['uID'];
    $currentPass = $_POST['currentPass'];
    $newPass = $_POST['newPass'];

    $pass = "SELECT pwdUsers from adduser where uID= ?";
    $stmt = $conn->prepare($pass);
    $stmt->bind_param('i', $passUID);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($pw = $result->fetch_assoc()) {
        $hash = $pw['pwdUsers'];
        if (password_verify($currentPass, $hash)) {
            $updatePass = "UPDATE adduser set pwdUsers=? where uID=?";
            $stmt = $conn->prepare($updatePass);
            $hashPW = password_hash($newPass, PASSWORD_DEFAULT);
            $stmt->bind_param('si', $hashPW, $passUID);
            $stmt->execute();
            echo "success";
            $stmt->close();
        } else {
            echo "Password does not match to any account";
        }
    }
    $conn->close();
}
/*****************Update Password**********************************/
