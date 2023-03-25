<?php 
require_once 'connection.php';
//Get Can/Noodles
$cannoodles= "SELECT productName,sum(quantity) as totalQuantity from categcannoodles GROUP BY productName";
$stmt= $conn->prepare($cannoodles);
$stmt->execute();
$result = $stmt->get_result();
$CanNoodlesProduct = array();
$CanNoodlesQuantity = array();

while ($row = $result->fetch_assoc()) {
    array_push($CanNoodlesProduct, $row['productName']);
    array_push($CanNoodlesQuantity, $row['totalQuantity']);
}

//Get Hygine Essential
$hygine= "SELECT productName,sum(quantity) as totalQuantity from categhygineessential GROUP BY productName";
$stmt= $conn->prepare($hygine);
$stmt->execute();
$result = $stmt->get_result();
$HygineEssentialProduct = array();
$HygineEssentialQuantity = array();

while ($row = $result->fetch_assoc()) {
    array_push($HygineEssentialProduct, $row['productName']);
    array_push($HygineEssentialQuantity, $row['totalQuantity']);
}

//Get Infant Items
$infant= "SELECT productName,sum(quantity) as totalQuantity from categinfant GROUP BY productName";
$stmt= $conn->prepare($infant);
$stmt->execute();
$result = $stmt->get_result();
$InfantItemsProduct = array();
$InfantItemsQuantity = array();

while ($row = $result->fetch_assoc()) {
    array_push($InfantItemsProduct, $row['productName']);
    array_push($InfantItemsQuantity, $row['totalQuantity']);
}

//Get Drinking Water
$query= "SELECT productName,sum(quantity) as totalQuantity from categdrinkingwater GROUP BY productName";
$stmt= $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$DrinkingWaterProduct = array();
$DrinkingWaterQuantity = array();

while ($row = $result->fetch_assoc()) {
    array_push($DrinkingWaterProduct, $row['productName']);
    array_push($DrinkingWaterQuantity, $row['totalQuantity']);
}

//Get Meat/Grains
$mg= "SELECT productName,sum(quantity) as totalQuantity, unit from categmeatgrains GROUP BY productName";
$stmt= $conn->prepare($mg);
$stmt->execute();
$result = $stmt->get_result();
$MeatGrainsProduct = array();
$MeatGrainsQuantity = array();
$MeatGrainsUnit = array();

while ($row = $result->fetch_assoc()) {
    array_push($MeatGrainsProduct, $row['productName']);
    array_push($MeatGrainsQuantity, $row['totalQuantity']);
    array_push($MeatGrainsUnit, $row['unit']);
}

//Get Meat/Grains
$medicine= "SELECT productName,sum(quantity) as totalQuantity, unit from categmedicine GROUP BY productName";
$stmt= $conn->prepare($medicine);
$stmt->execute();
$result = $stmt->get_result();
$MedicineProduct = array();
$MedicineQuantity = array();
$MedicineUnit = array();

while ($row = $result->fetch_assoc()) {
    array_push($MedicineProduct, $row['productName']);
    array_push($MedicineQuantity, $row['totalQuantity']);
    array_push($MedicineUnit, $row['unit']);
}


//Get Others
$others= "SELECT productName,sum(quantity) as totalQuantity, unit from categothers GROUP BY productName";
$stmt= $conn->prepare($others);
$stmt->execute();
$result = $stmt->get_result();
$OthersProduct = array();
$OthersQuantity = array();
$OthersUnit = array();

while ($row = $result->fetch_assoc()) {
    array_push($OthersProduct, $row['productName']);
    array_push($OthersQuantity, $row['totalQuantity']);
    array_push($OthersUnit, $row['unit']);
}


$data = array(
    'CanNoodlesProduct' => $CanNoodlesProduct,
    'CanNoodlesQuantity' => $CanNoodlesQuantity,
    'HygineEssentialProduct' => $HygineEssentialProduct,
    'HygineEssentialQuantity' => $HygineEssentialQuantity,
    'InfantItemsProduct' => $InfantItemsProduct,
    'InfantItemsQuantity' => $InfantItemsQuantity,
    'DrinkingWaterProduct' => $DrinkingWaterProduct,
    'DrinkingWaterQuantity' => $DrinkingWaterQuantity,
    'MeatGrainsProduct' => $MeatGrainsProduct,
    'MeatGrainsQuantity' => $MeatGrainsQuantity,
    'MeatGrainsUnit' => $MeatGrainsUnit,
    'MedicineProduct' => $MedicineProduct,
    'MedicineQuantity' => $MedicineQuantity,
    'MedicineUnit' => $MedicineUnit,
    'OthersProduct' => $OthersProduct,
    'OthersQuantity' => $OthersQuantity,
    'OthersUnit' => $OthersUnit,
   
);

// Encode the array as JSON and echo it out
echo json_encode($data);
 $stmt->close();
 $conn->close();


