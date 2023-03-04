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

	<title>Donors</title>
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
        <a href="#" class="nav-link active">
          <i class='bx bxs-box active'></i>
          <span class="text">Donors</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class='bx bxs-envelope'></i>
          <span class="text">Requests</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="stocks.php" class="nav-link">
          <i class='bx bxs-package'></i>
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
    <h1 class="fs-1 breadcrumb-title">Donor Details</h1>
    <nav class="bc-nav d-flex">
      <h6 class="mb-0">
        <a href="" class="text-reset bc-path">Home</a>
        <span>/</span>
        <a href="" class="text-reset bc-path active">Donor Details</a>
      </h6>  
    </nav>
  </div>
  <div style="margin-left: auto;">
    <div class="dropdown">
  <a
    class="dropdown-toggle"
    id="dropdownMenuButton"
    data-mdb-toggle="dropdown"
    aria-expanded="false"
    style="border: none;"
  >
  <?php if ($profile==null){ ?>
    <img src="img/default-admin.png" class="rounded-circle" style="width: 100px; border:1px green;" alt="Avatar" />
  <?php }else{?>
    <img src="include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle" style="width: 100px; height:100px; object-fit: cover; border:1px green;" alt="Avatar" />
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

  <div class="custom-container pb-3">
  <div class="card">
  <div class="card-body overflow-auto">
 <div class="mt-2">

 <button class="btn btn-success addPage float-end" style="width:200px; height:50px;">
  <i class="fa-solid fa-plus"></i> Add Donations</button>
 </div>
	
			<br>


	<br>
  <br><br>
  <!--Place table here --->
	<table class="table table-striped table-bordered" style="width:100%;" id="table_data">
			
			<thead>
			  <tr>
				<th><input type="checkbox" name="" id="selectAll" class="col"></th>
			
				<th>ID</th>
				<th>Fullname</th>
				<th>Email</th>
				<th>Contact</th>
				<th>Donation Date</th>
				<th>Send</th>
        <th>Certificate</th>
			  </tr>
			</thead>
			<tbody>
			 <?php
         $sql = "SELECT * FROM donation_items ORDER BY donor_id DESC";
         $result = mysqli_query($conn, $sql);
         $count = 0;
          foreach ($result as $row): ?>
					<?php $count = $count + 1; ?>
					<tr>
				   <td>
           <?php if ($row['email_status'] == 'not sent') { ?>
           <span><input type="checkbox" name="single_select" class="single_select col" data-email="<?php echo htmlentities(
            $row["donor_email"]); ?>" data-name="<?php echo htmlentities($row["donor_name"]);?>"
            data-id="<?php echo htmlentities($row["donor_id"]); ?>"></input></span> 
            <span><a href="updatedonate.php?editdonate=<?php echo $row["donor_id"]; ?>">
            <i style="color:green;" class="fa-solid fa-pen-to-square"></i></a></span>
        <?php } else { ?>
         <span><a href=""><i style="color:red;" class="fa-solid fa-trash"></i></a></span>
         <span><a href="updatedonate.php?editdonate=<?php echo $row[
      "donor_id"]; ?>"><i style="color:green;" class="fa-solid fa-pen-to-square"></i></a></span>
        <?php } ?>


            
				</td>
				<td><?php echo htmlentities($row["Reference"]); ?></td>
				<td><?php echo htmlentities($row["donor_name"]); ?></td>
				<td><?php echo htmlentities($row["donor_email"]); ?></td>
				<td><?php echo htmlentities($row["donor_contact"]); ?></td>
				<td><?php echo htmlentities($row["donationDate"]); ?></td>
        <td>
      <?php if ($row['email_status'] == 'not sent') { ?>
        <button type="button" class="btn btn-info email_button col" name="email_button" id="<?php echo $count; ?>" data-id="<?php echo htmlentities($row["donor_id"]); ?>" data-email="<?php echo htmlentities($row["donor_email"]); ?>" 
        data-name="<?php echo htmlentities($row["donor_name"]); ?>"  data-action="single">Send</button>
      <?php } else { ?>
        <span class="badge badge-success">Sent</span>
      <?php } ?>
      </td>
      <td>
        <?php if ($row['certificate']== 'cert empty') {?>
          <span><span class="badge badge-danger">Empty</span></span>
        <?php } else { ?>
          <button class="btn btn-success btnCert" value="<?php echo htmlentities($row['donor_id']) ?>" style="overflow:hidden;">
       Print</button>
          <?php } ?>
      </td>
				</tr>
				   
				<?php endforeach;?>
					
			</tbody>
			<tr>
				<td colspan="7"></td>
				<td>
			 <button type="button" name="bulk_email" class="btn btn-info email_button" id="bulk_email" data-action="bulk" >Bulk</button></td>
			</tr>
			
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
	<script type="text/javascript" src="scripts/mdb.min.js"></script>
  <script src="scripts/sweetalert2.all.min.js"></script>	
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
  <script src="scripts/main.js"></script>

  <!--Here is the scripts for functions -->
<script>
$(document).ready(function(){
  $('.email_button').click(function(){
    let $this = $(this);
    let id = $this.attr("id");
    let action = $this.data("action");
    let email_data = [];
    
    if(action == 'single')
    {
      email_data.push({
        email: $this.data("email"),
        name: $this.data("name"),
        uID: $this.data('id'),
      });
      $('#bulk_email').attr('disabled',true);
    }
    else
    {
      let $checkedBoxes = $('.single_select:checked');
      if ($checkedBoxes.length === 0) {
        $this.attr('disabled', true);
        return;
      }
      
      $checkedBoxes.each(function(){
        email_data.push({
          email: $(this).data("email"),
          name: $(this).data('name'),
          uID: $(this).data('id'),
        });
      });
    }
  
    $.ajax({
      url:"include/sendcerti.php",
      method:"POST",
      data:{email_data:email_data},
      beforeSend:function(){
        $this.html('Sending...');
        $this.addClass('btn btn-danger');
      },
      success:function(data){
        if(data == 'Inserted') {
          $this.html('sent');
          Swal.fire({
            icon: 'success',
            title: 'Sent',
            text:'Email has been sent',
          }).then(function() {
            location.reload();
          });
        } else {
          $this.text(data);
        }
      }
    });
  });
});

</script>

  <!--Select all checkbox --->
<script>
 $("#selectAll").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

});
</script>


<!--View cert -->
<script> 
	$(document).ready(function(){
		$('.btnCert').click(function(){

			let valueBtn = $(this);
			let id =valueBtn.val();
			  $.ajax({
			  	url:'include/viewid.php?viewCert='+id,
			  	type: 'GET',
			  	success: function(data){
				 printJS('./include/download-certificate/'+data, 'image')		   		
			  	}
			  });

		});
	});
</script>
<script>
  $(document).ready(function(){
    $('.addPage').click(function(){
      window.location.href = "additemdonations.php?fillupform";
    });
  })
</script>
</body>
</html>
