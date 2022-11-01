<?php



if (isset($_GET['request_id'])){
    include '../include/connection.php';
    $request_id = mysqli_real_escape_string($conn, $_GET['request_id']); 
    $sql="SELECT * FROM set_request where request_id = '$request_id'";
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