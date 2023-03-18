<?php
require_once 'connection.php';

$productArr= array();
$totalQuantityArr= array();
$categoryArr= array();
$typeArr= array();
$unitArr= array();

$sql= "SELECT category, productName, type, unit, SUM(quantity) as totalQuantity
        FROM (
            SELECT 'Can and Noodles' AS category, productName, type, unit, quantity FROM categcannoodles
            UNION ALL
            SELECT 'Drinking Water' AS category, productName, type, unit, quantity FROM categdrinkingwater
            UNION ALL
            SELECT 'Hygine Essentials' AS category, productName, type, unit, quantity FROM categhygineessential
            UNION ALL
            SELECT 'Infant Items' AS category, productName, type, unit, quantity FROM categinfant
            UNION ALL
            SELECT 'Meat and Grains' AS category, productName, type, unit, quantity FROM categmeatgrains
            UNION ALL
            SELECT 'Medicine' AS category, productName, type, unit, quantity FROM categmedicine
            UNION ALL
            SELECT 'Others' AS category, productName, type, unit, quantity FROM categothers
        ) AS allProducts
            GROUP BY productName
            ORDER BY productName ASC";
$stmt=$conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result(); 
while($row= $result->fetch_assoc()){
    array_push($productArr, $row['productName']);
    array_push($totalQuantityArr, $row['totalQuantity']);
    array_push($categoryArr, $row['category']);
    array_push($typeArr, $row['type']);
    array_push($unitArr, $row['unit']);



}


$dataArray = array(
    'product'=> $productArr,
    'totalQuantity'=>$totalQuantityArr,
    'category'=> $categoryArr,
    'type'=> $typeArr,
    'unit'=> $unitArr

);
echo json_encode($dataArray);
$stmt->close();
$conn->close();