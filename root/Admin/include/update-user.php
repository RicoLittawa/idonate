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
        try {
            $getEmail = $conn->prepare("SELECT COUNT(*) AS count FROM adduser WHERE email = ? AND uID <> ?");
            $getEmail->bind_param("si", $email, $uID);
            $getEmail->execute();
            $emailResult = $getEmail->get_result();
            $row = $emailResult->fetch_assoc();
            $count = $row['count'];
            if ($count > 0) {
                throw new Exception("Email already exist");
            } else {
                $updateUser = $conn->prepare("UPDATE adduser set firstname=?,lastname=?,position=?,email=?,address=? where uID=?");
                $updateUser->bind_param("sssssi", $fname, $lname, $position, $email, $address, $uID);
                if (!$updateUser->execute()) {
                    throw new Exception('There was a problem executing the query' . $conn->error);
                } else {
                    $response = array(
                        'status' => 'Success',
                        'message' => 'Your profile has been updated successfully',
                        'icon' => 'success'
                    );
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit();
                }
            }
        } catch (Exception $e) {
            $response = array(
                'status' => 'Error',
                'message' => $e->getMessage(),
                'icon' => 'error',
                'duplication' => false

            );
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    } else {
        $selectOldImg = $conn->prepare("SELECT profile from adduser where uID=?");
        $selectOldImg->bind_param('i', $uID);
        $selectOldImg->execute();
        try {
            $oldRes = $selectOldImg->get_result();
            if ($oldRes->num_rows === 0) {
                throw new Exception("Failed to fetch data from database" . $conn->error);
            } else {
                $old = $oldRes->fetch_assoc();
                $oldImg = $old['profile'];
                $path = "../include/profile/" . $oldImg;
                if ($oldImg != null) {
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }
            /*****************Update account*********************************/

            /*****************Upload new image**********************************/
            $filePath = 'profile/';
            $filename = $uID . '_' . basename($_FILES['profileImg']['name']);
            $filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $fileSize = $_FILES['profileImg']['size'];
            $fileError = $_FILES['profileImg']['error'];
            if (move_uploaded_file($_FILES['profileImg']['tmp_name'], $filePath . $filename)) {
                if ($fileError === 0) {
                    if ($fileSize < 10485760) {
                        $getEmail = $conn->prepare("SELECT COUNT(*) AS count FROM adduser WHERE email = ? AND uID <> ?");
                        $getEmail->bind_param("si", $email, $uID);
                        $getEmail->execute();
                        $emailResult = $getEmail->get_result();
                        $row = $emailResult->fetch_assoc();
                        $count = $row['count'];
                        if ($count > 0) {
                            throw new Exception("Email already exist");
                        } else {
                            $updateUserWithImage = $conn->prepare("UPDATE adduser set firstname=?,lastname=?,position=?,email=?,address=?,profile=? where uID=?");
                            $updateUserWithImage->bind_param("ssssssi", $fname, $lname, $position, $email, $address, $filename, $uID);
                            if (!$updateUserWithImage->execute()) {
                                throw new Exception('There was a problem executing the query' . $conn->error);
                            } else {
                                $getNewProfile = $conn->prepare("SELECT profile from adduser where uID=?");
                                $getNewProfile->bind_param("i", $uID);
                                if (!$getNewProfile->execute()) {
                                    throw new Exception('There was a problem executing the query' . $conn->error);
                                } else {
                                    $getNewProfileResult = $getNewProfile->get_result();
                                    if ($getNewProfileResult->num_rows === 0) {
                                        throw new Exception('Failed to fetch data from database');
                                    } else {
                                        $newProfile = $getNewProfileResult->fetch_assoc();
                                        $newFetchedProfile = $newProfile['profile'];
                                        $response = array(
                                            'status' => 'Success',
                                            'message' => 'Your profile has been updated successfully',
                                            'data' => $newFetchedProfile,
                                            'icon' => 'success'
                                        );
                                        header('Content-Type: application/json');
                                        echo json_encode($response);
                                        exit();
                                    }
                                }
                            }
                        }
                    } else {
                        throw new Exception("File is too large");
                    }
                } else {
                    throw new Exception("There are problem uploading the file");
                }
            } else {
                throw new Exception("There are problem uploading the file");
            }
            /*****************Upload new image**********************************/
        } catch (Exception $e) {
            $response = array(
                'status' => 'Error',
                'message' => $e->getMessage(),
                'icon' => 'error',
                'duplication' => false

            );
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    } //here end else
}

/*****************Update Password**********************************/
if (isset($_POST['updatePassword'])) {
    $passUID = $_POST['uID'];
    $currentPass = $_POST['currentPass'];
    $newPass = $_POST['newPass'];
    try {
        $getCurrentPassword =  $conn->prepare("SELECT pwdUsers from adduser where uID= ?");
        $getCurrentPassword->bind_param('i', $passUID);
        if (!$getCurrentPassword->execute()) {
            throw new Exception('There was a problem executing the query' . $conn->error);
        } else {
            $getCurrentPasswordResult = $getCurrentPassword->get_result();
            while ($pw = $getCurrentPasswordResult->fetch_assoc()) {
                $hash = $pw['pwdUsers'];
                if (password_verify($currentPass, $hash)) {
                    $updateUserPassword = $conn->prepare("UPDATE adduser set pwdUsers=? where uID=?");
                    $hashPW = password_hash($newPass, PASSWORD_DEFAULT);
                    $updateUserPassword->bind_param('si', $hashPW, $passUID);
                    $updateUserPassword->execute();
                    $response = array(
                        'status' => 'Success',
                        'message' => 'Your password is successfully changed',
                        'icon' => 'success',
                    );
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit();
                } else {
                    throw new Exception("Password does not match to any account");
                }
            }
        }
    } catch (Exception $e) {
        $response = array(
            'status' => 'Error',
            'message' => $e->getMessage(),
            'icon' => 'error',
        );
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}
/*****************Update Password**********************************/
