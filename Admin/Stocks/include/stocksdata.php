<?php
require_once '../../include/connection.php';
$data= array();
try{
  $query = "SELECT category, productName, type, unit, quantity,distributed
FROM (
    SELECT 'Can and Noodles' AS category, productName, type, unit, quantity,distributed FROM categcannoodles
    UNION ALL
    SELECT 'Drinking Water' AS category, productName, type, unit, quantity,distributed  FROM categdrinkingwater
    UNION ALL
    SELECT 'Hygine Essentials' AS category, productName, type, unit, quantity,distributed  FROM categhygineessential
    UNION ALL
    SELECT 'Infant Items' AS category, productName, type, unit, quantity,distributed  FROM categinfant
    UNION ALL
    SELECT 'Meat and Grains' AS category, productName, type, unit, quantity,distributed  FROM categmeatgrains
    UNION ALL
    SELECT 'Medicine' AS category, productName, type, unit, quantity,distributed  FROM categmedicine
    UNION ALL
    SELECT 'Others' AS category, productName, type, unit, quantity,distributed  FROM categothers
) AS allProducts
GROUP BY productName
ORDER BY productName ASC";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows < 0) {
  throw new Exception("There was a problem getting the status.");
}else{
  while ($row = $result->fetch_assoc()) {
    // Add each row to the array
    $data[] = array(
      'category' => $row['category'],
      'product' => $row['productName'],
      'quantity' => $row['quantity'],
      'type' => $row['type'],
      'unit' => $row['unit'],
      'distributed' => $row['distributed'],
    );
  }
  
  // Output the data in JSON format
  header('Content-Type: application/json');
  echo json_encode(array('data' => $data));
  }
}

catch(Exception $e){
  echo $e->getMessage();
}

