<?php 
require_once 'connection.php';

//Fill region selectbox
function fill_region_select_box($conn)
{
	$output = '';
	$sql = "SELECT * FROM refregion";
	$stmt=$conn->prepare($sql);
    $stmt->execute();
	$result = $stmt->get_result(); 
	foreach ($result as $row) {
		$regid = htmlentities($row['regCode']);
		$regname = htmlentities($row['regDesc']);
		$output .= '<option value="' . $regid . '">' . $regname . '</option>';
	}
	return $output;
}
//fill category
function add_category($conn){
	$output = '';
	$sql= "SELECT * from category";
			  
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result(); 
	foreach ($result as $row) {
	  $category = htmlentities($row['category']);
	  $categCode = htmlentities($row['categCode']);
	  $output .= '<option " value="' . $categCode . '">' . $category . '</option>';
	}
	return $output;
  
  }