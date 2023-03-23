<?php 
require_once 'connection.php';
//Get Can/Noodles
$cannoodles= "SELECT productName,sum(quantity) as totalQuantity from categcannoodles GROUP BY productName";
$stmt= $conn->prepare($cannoodles);
$stmt->execute();
$result = $stmt->get_result();
$productCn = array();
$quantityCn = array();

while ($row = $result->fetch_assoc()) {
    array_push($productCn, $row['productName']);
    array_push($quantityCn, $row['totalQuantity']);
}

//Get Hygine Essential
$hygine= "SELECT productName,sum(quantity) as totalQuantity from categhygineessential GROUP BY productName";
$stmt= $conn->prepare($hygine);
$stmt->execute();
$result = $stmt->get_result();
$productHy = array();
$quantityHy = array();

while ($row = $result->fetch_assoc()) {
    array_push($productHy, $row['productName']);
    array_push($quantityHy, $row['totalQuantity']);
}

//Get Infant Items
$infant= "SELECT productName,sum(quantity) as totalQuantity from categinfant GROUP BY productName";
$stmt= $conn->prepare($infant);
$stmt->execute();
$result = $stmt->get_result();
$productIi = array();
$quantityIi = array();

while ($row = $result->fetch_assoc()) {
    array_push($productIi, $row['productName']);
    array_push($quantityIi, $row['totalQuantity']);
}

//Get Drinking Water
$query= "SELECT productName,sum(quantity) as totalQuantity from categdrinkingwater GROUP BY productName";
$stmt= $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$productDw = array();
$quantityDw = array();

while ($row = $result->fetch_assoc()) {
    array_push($productDw, $row['productName']);
    array_push($quantityDw, $row['totalQuantity']);
}

//Get Meat/Grains
$mg= "SELECT productName,sum(quantity) as totalQuantity, unit from categmeatgrains GROUP BY productName";
$stmt= $conn->prepare($mg);
$stmt->execute();
$result = $stmt->get_result();
$productMg = array();
$quantityMg = array();
$unitMg = array();

while ($row = $result->fetch_assoc()) {
    array_push($productMg, $row['productName']);
    array_push($quantityMg, $row['totalQuantity']);
    array_push($unitMg, $row['unit']);
}

//Get Meat/Grains
$medicine= "SELECT productName,sum(quantity) as totalQuantity, unit from categmedicine GROUP BY productName";
$stmt= $conn->prepare($medicine);
$stmt->execute();
$result = $stmt->get_result();
$productMe = array();
$quantityMe = array();
$unitMe = array();

while ($row = $result->fetch_assoc()) {
    array_push($productMe, $row['productName']);
    array_push($quantityMe, $row['totalQuantity']);
    array_push($unitMe, $row['unit']);
}


//Get Others
$others= "SELECT productName,sum(quantity) as totalQuantity, unit from categothers GROUP BY productName";
$stmt= $conn->prepare($others);
$stmt->execute();
$result = $stmt->get_result();
$productOt = array();
$quantityOt = array();
$unitOt = array();

while ($row = $result->fetch_assoc()) {
    array_push($productOt, $row['productName']);
    array_push($quantityOt, $row['totalQuantity']);
    array_push($unitOt, $row['unit']);
}


$data = array(
    'productCn' => $productCn,
    'quantityCn' => $quantityCn,
    'productHy' => $productHy,
    'quantityHy' => $quantityHy,
    'productIi' => $productIi,
    'quantityIi' => $quantityIi,
    'productDw' => $productDw,
    'quantityDw' => $quantityDw,
    'productMg' => $productMg,
    'quantityMg' => $quantityMg,
    'unitMg' => $unitMg,
    'productMe' => $productMe,
    'quantityMe' => $quantityMe,
    'unitMe' => $unitMe,
    'productOt' => $productOt,
    'quantityOt' => $quantityOt,
    'unitOt' => $unitOt,
   
);

// Encode the array as JSON and echo it out
echo json_encode($data);
 $stmt->close();
 $conn->close();


