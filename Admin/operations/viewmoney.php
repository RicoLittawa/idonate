<?php



if (isset($_GET['money_id'])){
    include '../include/connection.php';
    $money_id = mysqli_real_escape_string($conn, $_GET['money_id']); 
    $sql="SELECT * FROM monetary_donations where money_id = '$money_id'";
    $result= mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)==1)
    {
        $donor= mysqli_fetch_array($result);
        $res = [
            'status' => 422,
            'message' => 'Donor found',
            'data' => $donor
            
        ];
        echo json_encode($res);
        return;
    }else
    {
        $res = [
            'status' => 404,
            'message' => 'donor not found'
        ];
        echo json_encode($res);
        return;
    }
    }