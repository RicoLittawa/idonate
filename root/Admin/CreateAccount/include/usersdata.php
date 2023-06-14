<?php
require_once '../../../../config/config.php';
$data = array(); // Create an empty array for the rows

try {
  $query = "SELECT * FROM adduser";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows < 0){
    throw new Exception("Failed to fetch data from database" . $conn->error);
  }else{
    while ($row = $result->fetch_assoc()) {
      // Add each row to the array
      $data[] = array(
        'uID' => $row['uID'],
        'firstname' => $row['firstname'],
        'lastname' => $row['lastname'],
        'position' => $row['position'],
        'email' => $row['email'],
        'address' => $row['address'],
        'role' => $row['role'],
        'status' => $row['status'],
        'profile' => $row['profile']
      );
    }
    header('Content-Type: application/json');
    echo json_encode(array('data' => $data));
  }

} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}
