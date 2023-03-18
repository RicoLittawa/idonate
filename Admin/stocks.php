<?php include 'include/protect.php' ;
require_once 'include/connection.php';

$sql= "SELECT firstname,profile FROM adduser WHERE uID=? ";
$stmt= $conn->prepare($sql);
$stmt->bind_param('i',$userID );
try{
  $stmt->execute();
  $result= $stmt->get_result();
  if($result->num_rows == 0) {
    echo "Invalid email or password.";
  }
  else{
    while($row= $result->fetch_assoc()){
     $firstname=  $row['firstname'];
     $profile=  $row['profile'];

    }
  }

}

catch(Exception $e){
  echo "Error". $e->getMessage();

}
function fill_select_category($conn){
  $output='';
  $selectCateg= "SELECT * from category";
  $stmt=$conn->prepare($selectCateg);
  $stmt->execute();
  $result=$stmt->get_result();
  foreach ($result as $row) {
		$categoryName = htmlentities($row['category']);
		$categCode = htmlentities($row['categCode']);
		$output .= '<option value="' . $categCode . '">' . $categoryName . '</option>';
	}
  
	return $output;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
	<link rel="stylesheet" href="css/mdb.min.css">
	<link rel="stylesheet" href="css/style.css">

	<title>Stocks</title>
</head>
<body>
<div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
    <button type="button" id="menuBtn" class="menuBtn"><i class="fa-solid fa-bars"></i></button>
  <nav class="side-menu">
    <ul class="nav">
      <li class="nav-item">
        <a href="adminpage.php" class="nav-link">
          <i class='bx bxs-dashboard'></i>
          <span class="text">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="donations.php" class="nav-link">
          <i class='bx bxs-box'></i>
          <span class="text">Donors</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="request.php" class="nav-link">
          <i class='bx bxs-envelope'></i>
          <span class="text">Requests</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link active">
          <i class='bx bxs-package active'></i>
          <span class="text">Stocks</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="users.php" class="nav-link">
          <i class='bx bxs-user-plus' ></i>
          <span class="text">Users</span>
        </a>
      </li>
    </ul>
  </nav>
 
    </div>

<!--Main content -->
  <div class="main-content">
  <!--Header -->
  <div class="mb-4 custom-breadcrumb">
  <div class="crumb">
    <h1 class="fs-1 breadcrumb-title">Stocks</h1>
    <nav class="bc-nav d-flex">
      <h6 class="mb-0">
        <a href="request.php" class="text-muted bc-path">Home</a>
        <span>/</span>
        <a href="#" class="text-reset bc-path active">Stocks</a>
      </h6>  
    </nav>
  </div>
  <div class="ms-auto">
    <div class="dropdown">
  <a
    class="dropdown-toggle border border-0"
    id="dropdownMenuButton"
    data-mdb-toggle="dropdown"
    aria-expanded="false"
  >
  <?php if ($profile==null){ ?>
    <img src="img/default-admin.png" class="rounded-circle w-100"alt="Avatar" />
  <?php }else{?>
    <img src="include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
  <?php }?>

  </a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <li><h6 class="dropdown-item">Hello <?php echo htmlentities($firstname);?>!</h6></li>
    <li><a class="dropdown-item" href="updateusers.php"><i class="fa-solid fa-pen"></i> Update Profile</a></li>
    <li><a class="dropdown-item" href="updatepassword.php"><i class="fa-solid fa-key"></i> Change Password</a></li>
    <li><a class="dropdown-item" href="include/logout.php"><i class="fa-sharp fa-solid fa-power-off"></i> Logout</a></li>
  </ul>
</div>
  </div>
</div>
 <!--Header -->


  <!--reports -->
  <div class="custom-container pb-3">
    <div class="card">
      <div class="card-body">
      <div  class="d-flex justify-content-end py-3">
      <div class="w-30">
          <select name="selectCategory" id="selectCategory" class="form-select">
            <option selected value="">Select</option>
            <?php echo fill_select_category($conn) ?>
          </select>
          </div>
      </div>
    
      <table class="table table-bordered" id="table_data">
      <thead>
        <tr>
          <th>Category</th>
          <th>Product name</th>
          <th>Type</th>
          <th>Unit</th>
          <th>Quantity</th>
          <th>Add Expiry</th>
        </tr>
      </thead>
      <tbody id="categoryBody">
        <!-- Rows generated by populateTable() function will be added here -->
      </tbody>
    </table>
      </div>
    </div>
<!--End of main content -->
    </div>
  </div>
</div>

  
	
	

	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>	
	<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
	<script type="text/javascript" src="scripts/mdb.min.js"></script>
  <script src="scripts/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script> 
  <script>
    $(document).ready(()=>{
     //Populate default state of table

     const populateTable = () => {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: 'include/stockstabledata.php',
      method: 'GET',
      dataType: 'json',
      success: (response) => {
        let product = response.product;
        let totalQuantity = response.totalQuantity;
        let category = response.category;
        let unit = response.unit;
        let type = response.type;

        let html = "";
        for (let i = 0; i < product.length; i++) {
          html += "<tr>";
          html += `<td>${category[i]}</td>`;

          if (totalQuantity[i] == 0) {
            html += `<td>${product[i]}<span class="badge rounded-pill badge-danger">Out of stock</span></td>`;
          } else {
            html += `<td>${product[i]}</td>`;
          }

          if (type[i] != null) {
            html += `<td>${type[i]}</td>`;
          } else {
            html += `<td><span class="badge rounded-pill badge-warning">Empty</span></td>`;
          }

          if (unit[i] != null) {
            html += `<td>${unit[i]}</td>`;
          } else {
            html += `<td><span class="badge rounded-pill badge-warning">Empty</span></td>`;
          }

          html += `<td>${totalQuantity[i]}</td>`;
          html += `<td><button id="addExpiry" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>`;
          html += "</tr>";
        }

        $('#categoryBody').append(html); // append rows to tbody element
        resolve(); // resolve promise
      },
      error: (jqXHR, textStatus, errorThrown) => {
        reject(errorThrown);
      }
    });
  });
};

populateTable().then(() => {
  $('#table_data').DataTable({ // initialize DataTables plugin
    "pagingType": "full_numbers",
    "lengthMenu": [
      [10, 25, 50, -1],
      [10, 25, 50, "All"]
    ],
    "responsive": true,
    "language": {
      "search": "_INPUT_",
      "searchPlaceholder": "Search Records"
    }
  });
}).catch((error) => {
  console.error(error);
});

$(document).on('change', '#selectCategory', function() {
  let categoryOptionValue = $(this).val();
  switch (categoryOptionValue) {
    case "":
      populateTable().then(html => $('#categoryBody').html(html));
      break;
    case "01":
      alert("working");
      $('#categoryBody').empty();
      break;
  }
});
         
        $(document).on('click','#addExpiry',()=>{
          alert('working')
        })

    })
  </script>





</body>
</html>