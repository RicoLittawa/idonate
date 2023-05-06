<?php
require_once '../../include/connection.php';

try {
  $query = "SELECT uID,firstname, lastname, position, email, address, role, status FROM adduser";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $result = $stmt->get_result();

  $data = array(); // Create an empty array for the rows
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
      'status' => $row['status']
    );
  }
  header('Content-Type: application/json');
  echo json_encode(array('data' => $data));
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}
// Output the data in JSON format
