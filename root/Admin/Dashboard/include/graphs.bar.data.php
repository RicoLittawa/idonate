<?php
require_once '../../../../config/config.php';
$category = "SELECT category, sum(quantity) as totalQuantity FROM (
        SELECT 'Can and Noodles' AS category, quantity FROM categcannoodles
        UNION ALL
        SELECT 'Drinking Water' AS category, quantity FROM categdrinkingwater
        UNION ALL
        SELECT 'Hygine Essentials' AS category, quantity FROM categhygineessential
        UNION ALL
        SELECT 'Infant Items' AS category, quantity FROM categinfant
        UNION ALL
        SELECT 'Meat and Grains' AS category, quantity FROM categmeatgrains
        UNION ALL
        SELECT 'Medicine' AS category, quantity FROM categmedicine
        UNION ALL
        SELECT 'Others' AS category, quantity FROM categothers
    ) as allProducts 
    GROUP BY category
    ORDER BY totalQuantity DESC";
$stmt = $conn->prepare($category);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
$labels = array();

while ($row = $result->fetch_assoc()) {
    array_push($labels, $row['category']);
    array_push($data, $row['totalQuantity']);
}

// Create an associative array with the data and labels
$dataArray = array(
    'label' => 'All Category',
    'data' => $data,
    'labels' => $labels
);

// Return the data as a JSON object
echo json_encode($dataArray);
$stmt->close();
$conn->close();
