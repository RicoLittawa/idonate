<?php 
require_once '../../include/connection.php';
//accept request
if (isset($_POST['createBtn'])){
$userId= $_POST['userId'];
$reqRef= $_POST['reqRef'];
$request_date= date('Y-m-d', strtotime($_POST['request_date']));
$evacQty= trim($_POST['evacQty']);
$category= $_POST['category'];
$quantity = $_POST['quantity'];
$notes = $_POST['notes'];

$user = "SELECT firstname, lastname, email, position FROM adduser WHERE uID = ?";
$stmt = $conn->prepare($user);
try {
    if (!$stmt) {
        throw new Exception("There was a problem executing the query.");
    } else {
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $userResult = $stmt->get_result();
        if ($userResult->num_rows == 0) {
            throw new Exception("User id does not exist");
        } else {
            while ($row = $userResult->fetch_assoc()) {
                $firstname= $row['firstname'];
                $lastname= $row['lastname'];
                $email= $row['email'];
                $position= $row['position'];
            }
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

$count= 0;
$resultcount=0;
$status= "pending";
$reqDetails= ("INSERT into request (userID,request_id,firstname,lastname,position,email,evacuees_qty,requestdate,status) VALUES(?,?,?,?,?,?,?,?,?)");
$stmt=$conn->prepare($reqDetails);
try{
    if (!$stmt){
        throw new Exception("There was a problem executing the query.");        
    }
    else{
        $stmt->bind_param('iisssssss', $userId,$reqRef,$firstname,$lastname,$position,$email,$evacQty,$request_date,$status);
        $stmt->execute();
        echo "success";
    }
}
catch(Exception $e){
    echo $e->getMessage();
}

 foreach ($category as $categ){
    $categDetails= "INSERT INTO request_category (request_id,categoryName,quantity,notes) VALUES (?,?,?,?)";
    $stmt=$conn->prepare($categDetails);
    try{
        if(!$stmt){
            throw new Exception("There was a problem executing the query.");
        }
        else{
            $stmt->bind_param('isss',$reqRef,$categ,$quantity[$count],$notes[$count]);
            if (!$stmt->execute()){
                throw new Exception("There was a problem executing the query.");
            }else{
                $resultcount++;
                $count++;
            }
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }

 }
 $reqRef++;
 $requestRefUpdate="UPDATE ref_request set request_id=?";
 $stmt=$conn->prepare($requestRefUpdate);
 try{
    if (!$stmt){
        throw new Exception("There was a problem executing the query.");
    }
    else{
        $stmt->bind_param('i',$reqRef);
        $stmt->execute();

    }
 }
 catch(Exception $e){
    echo $e->getMessage();
 }

 $stmt->close();
 $conn->close();
}