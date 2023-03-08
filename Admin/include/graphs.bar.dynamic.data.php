<?php
if (isset($_GET['category'])){
    $category = $_GET['category'];
    if ($category==="01"){
        $label= "Can";
        $dataArray = array(
            'label' => 'Can',
        );
        echo json_encode($dataArray);
    }
    if ($category==="02"){
        $dataArray = array(
            'label' => 'HY',
        );
        echo json_encode($dataArray);
    }
   
   
}
