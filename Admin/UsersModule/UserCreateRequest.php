<?php require_once '../include/protect.php';
require_once '../include/profile.inc.php';
require_once '../include/FunctionSelectBox.php';
require_once '../include/connection.php';

$reqId= "SELECT * from ref_request";
$stmt=$conn->prepare($reqId);
$stmt->execute();
$reqResult= $stmt->get_result();
$refRow = $reqResult->fetch_assoc();
$requestRef = $refRow['request_id'];
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
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="stylesheet" href="../css/style.css">
  
	<title>User Details</title>
</head>
<body>
<div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
    <button type="button" id="menuBtn" class="menuBtn"><i class="fa-solid fa-bars"></i></button>
  <nav class="side-menu">
    <ul class="nav">
    <li class="nav-item">
        <a href="#" class="nav-link">
          <i class='bx bxs-dashboard'></i>
          <span class="text">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link active">
          <i class='bx bxs-cart-add active'></i>
          <span class="text">Create</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class='bx bxs-package'></i>
          <span class="text">History</span>
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
    <h1 class="fs-1 breadcrumb-title">Create Request</h1>
    <nav class="bc-nav d-flex">
      <h6 class="mb-0">
        <a href="#" class="text-muted bc-path">Home</a>
        <span>/</span>
        <a href="#" class="text-reset bc-path active">Create Request</a>
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
    <img src="../img/default-admin.png" class="rounded-circle w-100"alt="Avatar" />
  <?php }else{?>
    <img src="../include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
  <?php }?>

  </a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <li><h6 class="dropdown-item">Hello <?php echo htmlentities($firstname);?>!</h6></li>
    <li><a class="dropdown-item" href="updateusers.php"><i class="fa-solid fa-pen"></i> Update Profile</a></li>
    <li><a class="dropdown-item" href="updatepassword.php"><i class="fa-solid fa-key"></i> Change Password</a></li>
    <li><a class="dropdown-item" href="../include/logout.php"><i class="fa-sharp fa-solid fa-power-off"></i> Logout</a></li>
  </ul>
</div>
  </div>
</div>
 <!--Header -->

  <div class="custom-container pb-3">
  <div class="card">
  <div class="card-body overflow-auto">
 <div class="mt-2">

 <span>
  <button class="btn btn-success float-end w-20 h-50 btn-rounded" type="button" id="toggleFormBtn">
		<i class="fas fa-add"></i>Show Form</button>
  </span>
 </div>
	
			<br>
 <div id="registerForm" class="collapse mt-5" data-duration="500">
	<form class="pe-2 mb-3" id="add-request">

  <!-- 2 column grid layout with text inputs for the first and last names -->
  <input hidden type="text" id="requestRef" value="<?php echo htmlentities($requestRef) ?>">
  <input hidden type="text" id="userId" value="<?php echo htmlentities($userID) ?>">
  <div class="form-group mb-4">
    <label for="request_date">Request Date</label>
    <input class="form-control" id="request_date" type="date">
  </div>
  <!-- Email and Password inputs -->
  <div class="form-outline mb-4">
    <input type="text" id="evacQty" class="form-control"></input>
    <label class="form-label" for="evacQty">Evacuees/Families Quantity</label>
  </div>
  <div>
  <table  class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Available Category</th>
          <th>Est QTY</th>
          <th>Notes (Optional)</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="requestBody">
        <tr>
      
         <td> <!-- SELECT OPTION -->
          <select class="form-control category" name="category" id="category">
            <option value="">--</option>
            <?php echo add_category($conn); ?>
          </select>
         </td> <!-- SELECT OPTION -->
         <td>
            <input type="text" class="form-control quantity" id="quantity">
        </td>   
        <td><textarea class="form-control notes" id="notes" cols="30" rows="5" placeholder="e.g. We only need shampoo, soap, and mouthwash"></textarea></td>
         <td><button class="btn btn-success" type="button" id="addCategory"><i class="fa-solid fa-plus"></i></button></td>     
        </tr>
    
      </tbody>
    </table>
  </div>

 



  <!-- Submit button -->
  <button type="submit " id="addBtn" class="btn btn-success btn-block">
  <span class="submit-text">Create</span>
  <span class="spinner-border spinner-border-sm  d-none" role="status" aria-hidden="true"></span>
  </button>
</form>

    </div>

	<br>
  <br><br>
	<table  class="table table-striped table-bordered" id="table_data">
      <thead>
        <tr>
          <th>Reciept No.</th>
          <th>No. Evacuees/Families</th>
          <th>Request Date</th>
          <th>Recieve Date</th>
          <th>Status</th>
          <th>Action</th>
      
        </tr>
      </thead>
      <tbody>
      <?php 
        $createdRequest= "SELECT request_id,evacuees_qty,requestdate,recievedate,status from request where userID=?";
        $stmt= $conn->prepare($createdRequest);
        $stmt->bind_param('i',$userID);
        $stmt->execute();
        $createdRequestRes= $stmt->get_result();
        while ($reqRes= $createdRequestRes->fetch_assoc()){
          $request_date = $reqRes['requestdate'];
          $request_dateTrimmed = str_replace('-', '', $request_date);
          $reference= $reqRes['request_id'];
          $evacuees_qty= $reqRes['evacuees_qty'];
          $recieve_date= $reqRes['recievedate'];
          $status= $reqRes['status'];
        
      ?>
        <tr>
         <td><?php echo htmlentities($request_dateTrimmed)."-00".htmlentities($reference) ?></td>
         <td><?php echo htmlentities($evacuees_qty) ?></td>
         <td><?php echo htmlentities($request_date) ?></td>
         
         <td>
           <?php if($recieve_date===null){ ?>
           <span class="badge badge-info">Empty</span>
           <?php } else { ?>
            <?php echo htmlentities($recieve_date) ?>
          <?php }?>
         </td>
          <td>
            <?php if($status==='pending'){ ?>
            <span class="badge badge-warning"><?php echo htmlentities($status) ?></span>
            <?php } else { ?>
            <span class="badge badge-success"><?php echo htmlentities($status) ?></span>
            <?php }?>
          </td>
  
          
         <td></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
			</div>
  </div>
  </div>
  


    </div>
  </div>
</div>




	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>	
	<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
	<script type="text/javascript" src="../scripts/mdb.min.js"></script>
  <script src="scripts/main.js"></script>
  <script src="../scripts/sweetalert2.all.min.js"></script>
  <script src="../scripts/ToggleForm.js"></script>
  <script src="scripts/CreateRequest.js"></script>




</body>
</html>
