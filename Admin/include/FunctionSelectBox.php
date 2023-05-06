<?php
require_once 'connection.php';
//Fill region selectbox
function fill_region_select_box($conn)
{
	$output = '';
	$sql = "SELECT * FROM refregion";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	foreach ($result as $row) {
		$regid = htmlentities($row['regCode']);
		$regname = htmlentities($row['regDesc']);
		$output .= '<option value="' . $regid . '">' . $regname . '</option>';
	}
	return $output;
}
//Fill category
function add_category($conn)
{
	$output = '';
	$sql = "SELECT * from category";

	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	foreach ($result as $row) {
		$category = htmlentities($row['category']);
		$categCode = htmlentities($row['categCode']);
		$output .= '
		<li><a class="dropdown-item select-category"  href="#" data-value="' . $categCode . '">' . $category . '</a></li>';
	}
	return $output;
}

function add_category_create($conn)
{
	$output = '';
	$sql = "SELECT * from category";

	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	foreach ($result as $row) {
		$category = htmlentities($row['category']);
		$categCode = htmlentities($row['categCode']);
		$output .= '<option " value="' . $categCode . '">' . $category . '</option>';
	}
	return $output;
}

//Count donors
function count_donors($conn)
{
	$output = '';
	$donors = "SELECT COUNT(*) FROM donation_items";
	$stmt = $conn->prepare($donors);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	$count = $row["COUNT(*)"];
	$output .= '<h1 class="m-md-1 text-dark">' . $count . '</h1>';

	return $output;
}
//Count Request
function count_request($conn)
{
	$output = '';
	$request = "SELECT COUNT(*) FROM request";
	$stmt = $conn->prepare($request);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	$count = $row["COUNT(*)"];
	$output .= '<h1 class="m-md-1 text-dark">' . $count . '</h1>';
	return $output;
}
//Count distributed
function count_distributed($conn)
{
	$output = '';
	$distributed = "SELECT  sum(distributed) as totalQuantity FROM (
        SELECT  distributed FROM categcannoodles
        UNION ALL
        SELECT  distributed FROM categdrinkingwater
        UNION ALL
        SELECT  distributed FROM categhygineessential
        UNION ALL
        SELECT  distributed FROM categinfant
        UNION ALL
        SELECT distributed FROM categmeatgrains
        UNION ALL
        SELECT distributed FROM categmedicine
        UNION ALL
        SELECT  distributed FROM categothers
    ) as allProducts ";
	$stmt = $conn->prepare($distributed);
	$stmt->execute();
	$result = $stmt->get_result();

	while ($row = $result->fetch_assoc()) {
		$count = $row["totalQuantity"];
		$output .= '<h1 class="m-md-1 text-dark">' . $count . '</h1>';
	}
	return $output;
}
