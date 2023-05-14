<?php
require_once '../../../../config/config.php';
if (isset($_POST['keyword'])) {
  $keyword = "%" . $_POST['keyword'] . "%";
  $autoS = 'SELECT * FROM categ_products WHERE product_name LIKE ? ORDER BY product_name LIMIT 0,6';
  $stmt = $conn->prepare($autoS);
  $stmt->bind_param('s', $keyword);
  $stmt->execute();
  $result = $stmt->get_result();
  $response = array();
  if (!empty($result)) {
    while ($row = $result->fetch_assoc()) {
      $response[] = array(
        'product_name' => $row['product_name']
      );
    }
  }
  echo json_encode($response);
}
