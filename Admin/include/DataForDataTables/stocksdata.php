<?php
require_once '../connection.php';

$query = "SELECT category, productName, type, unit, SUM(quantity) as totalQuantity
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
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$data = array(); // Create an empty array for the rows
while ($row = $result->fetch_assoc()) {
  // Add each row to the array
  $data[] = array(
    'category' => $row['category'],
    'product' => $row['productName'],
    'quantity' => $row['totalQuantity'],
    'type' => $row['type'],
    'unit' => $row['unit'],
  );
}

// Output the data in JSON format
header('Content-Type: application/json');
echo json_encode(array('data' => $data));
