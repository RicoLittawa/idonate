<?php 
require_once 'connection.php';

//Select province
if (isset($_POST['regCode'])){
    $regCode =$_POST['regCode'];
 
    $prov= "SELECT provDesc, provCode from refprovince where regCode=?";
    $stmt=$conn->prepare($prov);
    $stmt->bind_param('i',$regCode);
    $stmt->execute();
    $result = $stmt->get_result();
    echo"<option value='-Select-'>-Select Province-</option>";
    while ($row = $result->fetch_assoc()) {
       
        echo "
        <option value='".$row['provCode']."'>".$row['provDesc']."</option>";
    }
    $stmt->close();
    $conn->close();
}
 

//Select municipality
if (isset($_POST['provCode'])){
    $provCode =$_POST['provCode'];
 
    $city= "SELECT citymunDesc, citymunCode from refcitymun where provCode=?";
    $stmt=$conn->prepare($city);
    $stmt->bind_param('i',$provCode);
    $stmt->execute();
    $result = $stmt->get_result();
    echo"<option value='-Select-'>-Select Municipality-</option>";
    while ($row = $result->fetch_assoc()) {
        echo "
        <option value='".$row['citymunCode']."'>".$row['citymunDesc']."</option>";
}
$stmt->close();
$conn->close();
}

//Select Barangay
if (isset($_POST['citymunCode'])){
    $citymunCode =$_POST['citymunCode'];
 
    $barangay= "SELECT brgyDesc, brgyCode from refbrgy where citymunCode=?";
    $stmt=$conn->prepare($barangay);
    $stmt->bind_param('i',$citymunCode);
    $stmt->execute();
    $result = $stmt->get_result();
    echo"<option value='-Select-'>-Select Barangay-</option>";
    while ($row = $result->fetch_assoc()) {
        echo "
        <option value='".$row['brgyCode']."'>".$row['brgyDesc']."</option>";
}
$stmt->close();
$conn->close();
}

//Select categ for unit
if (isset($_POST['categCode'])){
    $categCode =$_POST['categCode'];
    
    $categ= "SELECT unit, categCode from unit_measure where categCode=?";
    $stmt=$conn->prepare($categ);
    $stmt->bind_param('i',$categCode);
    $stmt->execute();
    $result = $stmt->get_result();
    echo"<option value='-Select-'>-Select Unit-</option>";
    while ($row = $result->fetch_assoc()) {
       
        echo "
        <option value='".$row['id']."'>".$row['unit']."</option>";
    }
    $stmt->close();
    $conn->close();
}