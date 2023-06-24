<?php
require_once '../../../../config/config.php';
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
  header("Location: ../../error/ForbiddenPage.html");
  exit();
}
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
        'profile' => $row['profile'],
        'logged_in' => $row['logged_in'],
        'logged_out' => $row['logged_out'],
      );
    }
    header('Content-Type: application/json');
    echo json_encode(array('data' => $data));
  }

} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}
