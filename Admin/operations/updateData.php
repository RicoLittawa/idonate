<?php



if (isset($_GET['donor_id'])){
    include '../include/connection.php';
    $donor_id = mysqli_real_escape_string($conn, $_GET['donor_id']); 
    $sql="SELECT * FROM donation_items where donor_id = '$donor_id'";
    $result= mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)==1)
    {
        $donor= mysqli_fetch_array($result);
        $res = [
            'status' => 200,
            'message' => 'Donor found',
            'data' => $donor
            
        ];
        echo json_encode($res);
        return;
    }else
    {
        $res = [
            'status' => 422,
            'message' => 'donor not found'
        ];
        echo json_encode($res);
        return;
    }
    }