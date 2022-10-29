<?php 
require '../include/connection.php';

if(isset($_POST['delete_data']))
{
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $query = "DELETE FROM items WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Student Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
