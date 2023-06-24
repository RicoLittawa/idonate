<?php
require_once '../../../../config/config.php';
$categories = array(
    'CanNoodles' => 'categcannoodles',
    'HygineEssential' => 'categhygineessential',
    'InfantItems' => 'categinfant',
    'DrinkingWater' => 'categdrinkingwater',
    'MeatGrains' => 'categmeatgrains',
    'Medicine' => 'categmedicine',
    'Others' => 'categothers'
);

$data = array();

foreach ($categories as $category => $table) {
    $stmt = $conn->prepare("SELECT productName, SUM(quantity) AS totalQuantity, unit, type FROM $table GROUP BY productName, unit");
    $stmt->execute();
    $result = $stmt->get_result();
    
    $product = array();
    $quantity = array();
    $unit = array();
    $type = array();
    
    while ($row = $result->fetch_assoc()) {
        $product[] = $row['productName'];
        $quantity[] = $row['totalQuantity'];
        $unit[] = $row['unit'];
        $type[] = $row['type'];
    }
    
    $data[$category.'Product'] = $product;
    $data[$category.'Quantity'] = $quantity;
    $data[$category.'Unit'] = $unit;
    $data[$category.'Type'] = $type;
}

header('Content-Type: application/json');
echo json_encode($data);

