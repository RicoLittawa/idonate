<?php
require_once '../../include/connection.php';
$category = "SELECT category,sum(quantity) as totalQuantity  FROM (
    SELECT 'Can and Noodles' AS category,quantity FROM categcannoodles
    UNION ALL
    SELECT 'Drinking Water' AS category,quantity FROM categdrinkingwater
    UNION ALL
    SELECT 'Hygine Essentials' AS category,quantity FROM categhygineessential
    UNION ALL
    SELECT 'Infant Items' AS category,quantity FROM categinfant
    UNION ALL
    SELECT 'Meat and Grains' AS category,quantity FROM categmeatgrains
    UNION ALL
    SELECT 'Medicine' AS category,quantity FROM categmedicine
    UNION ALL
    SELECT 'Others' AS category,quantity FROM categothers
    ) as allProducts 
    GROUP BY category";
$stmt = $conn->prepare($category);
$stmt->execute();
$result = $stmt->get_result();
$data = array(); 
while ($row = $result->fetch_assoc()) {
    $data[] = array(
        'category' => $row['category'],
        'quantity' => $row['totalQuantity'],
      );
}
header('Content-Type: application/json');
echo json_encode(array('data' => $data));