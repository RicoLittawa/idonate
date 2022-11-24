<?php
session_start();

	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="css/donations.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

	<title>Monetary Donors</title>
</head>
<body>


	<!-- SIDEBAR -->	
	<section id="sidebar">
		<a href="#" class="brand">
			
			<span ><img class="img" src="img/logo.png" alt=""></span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="adminpage.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="donations.php">
					<i class='bx bxs-box' ></i>
					<span class="text">Donations</span>
				</a>
			</li>
			<li>
				<a href="request.php">
					<i class='bx bxs-envelope' ></i>
					<span class="text">Requests</span>
				</a>
			</li>
			<li>
				<a href="archieve.php">
				<i class='bx bxs-file-archive'></i>
					<span class="text">Archieve</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="/Admin/login/logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i style="font-size:40px;" class='bx bx-menu' ></i>
			<form action="#">
				
			</form>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>Good Day
			<a href="#" class="profile"><span> <?php echo $_SESSION['name']; ?></span></a>
			
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Money Donations</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#" style="font-size: 18px;">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="donations.php" style="font-size: 18px;">Back</a>
						</li>
					</ul>
				</div>
				
			</div>
			
			<div class="table-data">
				<div class="add">
					<div class="head">
						<h3>Monetary Donors</h3>
						<i class='bx bx-search' ></i>	
						<i class='bx bx-filter' ></i>
						<div class="dropdown">
  <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
    Select Table
  </button>
  <div class="dropdown-menu">
  		<a class="dropdown-item" href="donations.php">Donations</a>
        <a class="dropdown-item" href="moneytable.php">Money Donors</a>
		<a class="dropdown-item" href="categorytables.php">Donation Items</a>
   
  </div>
</div>
					</div>
<table class="table table-striped table-bordered" style="width:100%" id="table_data">
    <thead>
      <tr>
		<th><input type="checkbox" name="" id="selectAll" class="col"></th>
        <th>Donor Name</th>
		<th>Province</th>
		<th>Street</th>
		<th>Region</th>
		<th>Email</th>
		<th>Contact</th>
		<th>Date</th>
		<th>Reference Number</th>
		<th>Amount</th>
		<th>Note</th>
		<th>Send Certificate</th>

      </tr>
    </thead>
    <tbody>
     <?php 
	 require_once 'include/connection.php';
	 $sql = "SELECT * FROM monetary_donations ORDER by money_id DESC";
	 $result = mysqli_query($conn,$sql);
	$data = $result->fetch_all(MYSQLI_ASSOC);
	$count= 0;
	foreach ($data as $row): ?>
	 <?php   $count = $count+ 1; ?>
	<tr>
	<td><input type="checkbox" name="single_select" class="single_select col" data-email="<?php echo htmlentities($row['money_email']); ?>" data-name="<?php echo htmlentities($row['money_name']); ?>"data-id="<?php echo htmlentities($row['money_id']); ?>"></input></td>
	<td><?php echo htmlentities($row['money_name']) ;?></td>
	<td><?php echo htmlentities($row['money_province']); ?></td>
	<td><?php echo htmlentities($row['money_street']); ?></td>
	<?php 
			
			 $sql2="SELECT * From regions";
		 	$result2=mysqli_query($conn,$sql2);
		
		 	foreach($result2 as $row1){
			if ($row['money_region']== $row1['region_id']){
				echo "<td>".htmlentities($row1['region_name'])."</td>
				";
				}
			}
		
		?>
	<td><?php echo htmlentities($row['money_email']); ?></td>
	<td><?php echo htmlentities($row['money_contact']) ;?></td>
	<td><?php echo htmlentities($row['money_date']); ?></td>
	<td><button type="button" data-toggle="modal" data-target="referenceImg"  class="viewRef btn col" value="<?php echo htmlentities($row['money_id']); ?>"><?php echo htmlentities($row['money_reference']); ?></button></td>
	<td>₱<?php echo htmlentities($row['money_amount']) ;?></td>
	<td><button class="btn Note" data-toggle="modal" data-target="viewNote" value="<?php echo htmlentities($row['money_id']); ?>"><i style="color: green;" class="fa-solid fa-message"></i></button></td>
	<td><button type="button" class="btn btn-info email_button" name="email_button" id="<?php echo $count;?>"
	data-email="<?php echo htmlentities($row['money_email']); ?>" data-name="<?php echo htmlentities($row['money_name']);  ?>" data-action="single" data-id="<?php echo htmlentities($row['money_id']); ?>">Send</button>
	</td>
	</tr>
	 
	
	 <?php endforeach; ?>
	  </tbody>
	  
  
  <tr>
		<td colspan="11"></td>
		<td>
     <button type="button" name="bulk_email" class="btn btn-info email_button" id="bulk_email" data-action="bulk" >Bulk</button></td>
	</tr>
	</table>
<!-- Reference Photo--->

<div class="modal fade" id="referenceImg">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Reference/Transaction Reciept</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		
      </div>
	
	


	<div class="modal-body">
	<img src="" id="imageContainer" alt="" width="465px" height="100%" style="border-radius:10px;">
	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
	 

		

    </div>
  </div>
</div>

<!--Note -->
<div class="modal" id="viewNote">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Donor's Note</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
		<div class="form-group">
			<label for="money_note">Note</label>
		<textarea class="form-control" name="money_note" id="money_note" cols="50" rows="5"></textarea>
		</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
			</div>
		</main>
	
	</section>
	
	

	<script src="scripts/sidemenu.js"></script>
	<script src="scripts/jQuery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>	
	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script src="scripts/sweetalert2.all.min.js"></script>
  	<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
	<script>
$(document).ready(function(){
	$('.email_button').click(function(){
	$(this).attr('disabled', 'disabled');
	var id = $(this).attr("id");
	var action = $(this).data("action");
	var money_data = [];
	if(action == 'single')
	{
	money_data.push({
		email: $(this).data("email"),
		name: $(this).data("name"),
		uID: $(this).data('id')
	});
	}
	else
	{
	$('.single_select').each(function(){
		if($(this). prop("checked") == true)
		{
		money_data.push({
		email: $(this).data("email"),
		name: $(this).data('name'),
		uID: $(this).data('id')
		});
	
		
		}
	
	});
	}
	console.log(money_data);
	 $.ajax({
	 url:"include/moneycerti.php",
	 method:"POST",
	 data:{money_data:money_data},
	 beforeSend:function(){
	 	$('#'+id).html('Sending...');
	 	$('#'+id).addClass('btn-danger');
	 },
	 success:function(data){

	 	if(data = 'Inserted')
          {
             $('#'+id).html('<i class="fa-sharp fa-solid fa-envelope-circle-check"></i>');
             $('#'+id).removeClass('btn-danger');
             $('#'+id).removeClass('btn-info');
             $('#'+id).addClass('btn-success');

 	    Swal.fire({
 	    	icon: 'success',
 	    	title: 'Sent',
 	    	text:'Email has been sent',
 	    	}).then(function() {
 	    	window.location = "archieveM.php";
 	    	});
          }
          else
          {
           $('#'+id).text(data);
          }
          $('.email_button='+id).attr('disabled', false);
		
	 }
	
	 });
	});
});
</script>

<script>
 $("#selectAll").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

});
</script>

<script>
	  $(document).ready(function () {
    $('#table_data').DataTable({
      "pagingType":"full_numbers",
      "lengthMenu":[
      [10,25,50,-1],
      [10,25,50,"All"]],
      responsive:true,
      language:{
        search:"_INPUT_",
        searchPlaceholder: "Search Records",
      }

    });
});
</script>

</script>
<!--View reference id -->
<script> 
	$(document).ready(function(){
		$('.viewRef').click(function(){

			var request_id = $(this).val();
			
		
			  $.ajax({
			  	url:'include/viewid.php?money_id='+request_id,
			  	type: 'GET',
			  	success: function(data){
					
			  			  $('#referenceImg').modal('show');
						    $('#imageContainer').attr('src','../donors/ReferencePhoto/'+data);		   		
			  	}
			  });

		});
	});
</script>
<script> 
	$(document).ready(function(){
		$('.Note').click(function(){

			var request_id = $(this).val();
		
			  $.ajax({
			  	url:'include/viewid.php?moneyNote='+request_id,
			  	type: 'GET',
			  	success: function(data){
			  			 $('#viewNote').modal('show');
						 $('#money_note').val(data);
						
			  			
			  	}
			  });

		});
	});
</script>
</body>
</html>
