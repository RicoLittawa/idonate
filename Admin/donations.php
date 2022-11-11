<?php
session_start();

	?>
  <?php 
  include '../Admin/include/connection.php';
  function fill_category_select_box($conn)
  {
    $output= '';
    $sql= "SELECT * From category order by categ_id ASC";
    $result = mysqli_query($conn,$sql);
    foreach($result as $row){
      $output .= '<option value="'.$row['category'].'">"'.$row['category'].'"</option>';
    }
    return $output;
  }
  
  function fill_variant_select_box($conn){
    $output= '';
    $sql= "SELECT * From variant order by variant_id ASC";
    $result = mysqli_query($conn,$sql);
    foreach($result as $row){
      $output .= '<option value="'.$row['variant'].'">"'.$row['variant'].'"</option>';
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../Admin/css/donations.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

	<title>Donations</title>
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
				<a href="#">
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
				<a href="#">
					<i class='bx bxs-chat' ></i>
					<span class="text">Archive</span>
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
			<i class='bx bx-menu' ></i>
			<form action="#">
				<div class="form-input">
					<input type="text" placeholder="Search..." name="search" >
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
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
					<h1>Donations</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#" style="font-size: 18px;">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#" style="font-size: 18px;">Home</a>
						</li>
					</ul>
				</div>
				<!--Add modal -->
				
					<span><button class="adddata" type="button" data-toggle="modal" data-target="add"><i class="fa-solid fa-plus"></i> Add donations</button></span>
				   
			</div>
<div class="modal fade" id="add">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Donations</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
     
	  <form id="add-form" method="POST">
		<div class="modal-body">
		<span id="msg" class="text-center"></span>
  
		<input type="text"  value="" readonly>
          <div class="row">
            <div class="col">
            <label for="fname">Fullname</label>
            <input class="form-control" type="text" name="fname" id="fname" placeholder="">
      
            </div>
            <div class="col">
            <label for="province">Province</label>
            <input class="form-control" type="text" name="province" id="province">
            
            </div>
            </div>
            <div class="row">
            <div class="col">
            <label for="street">Street</label>
            <input class="form-control" type="text" name="street" id="street">
            
            </div>
            <div class="col">
              <label for="region">Select Region</label>
              <select class="custom-select" name="region" id="region">
              <option value="default">Choose Region</option>
              <?php 
              include '../Admin/include/connection.php';
                $sql = "SELECT * FROM regions";
                $result = mysqli_query($conn,$sql);
                while($row =mysqli_fetch_array($result))
                {
                  echo '<option value="'.$row['region_name'].'">'.$row['region_name'].'</option>';
                }
                
              ?>
            </select>
            
						</div>
            </div>	  
            <div class="row">
            <div class="col">
            <label for="email">Email</label>
            <input class="form-control" type="text" name="email" id="email">
            
            </div>
            <div class="col">
            <label for="donation_date">Donation Date</label>
            <input class="form-control" type="date" name="donation_date" id="donation_date">
            
            </div>
            </div>
          <div class="row">
          
            <div class="col">
              <label for="user-quantity">Quantity</label>
              <input class="form-control" type="text" name="quantity" id="quantity">
            
           
            </div>
            </div>
            <div class="row">
                        <div class="col">
                        <button type="button" name="btn_additem" class="btn btn-primary" id="btn_additem">Add  
                          </button>
                        </div>
                      </div>
                 

         
          

           
           


					  </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Save</button>
      </div>
	  </form>	

    </div>
  </div>
</div>
<!-- Update Modal-->
<div class="modal fade" id="updateModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Donations</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
     
	  <form class="validate-form" id="update-form" method="POST">
		<div class="modal-body">
		<span id="msgupdate" class="text-center"></span>
		<input type="hidden" name="donor_id" id="donor_id">
          <div class="row">
            <div class="col">
            <label for="fname">Fullname</label>
            <input class="form-control" type="text" name="donor_name" id="donor_name" placeholder="">
      
            </div>
            <div class="col">
            <label for="province">Province</label>
            <input class="form-control required" type="text" name="donor_province" id="donor_province">
            
            </div>
            </div>
            <div class="row">
            <div class="col">
            <label for="street">Street</label>
            <input class="form-control required" type="text" name="donor_street" id="donor_street">
            
            </div>
            <div class="col">
              <label for="region">Select Region</label>
              <select class="custom-select required" name="donor_region" id="donor_region">
              <option value="default">Choose Region</option>
              <?php 
              include '../Admin/include/connection.php';
                $sql = "SELECT * from regions ";
                $result = mysqli_query($conn,$sql);
                while($row =mysqli_fetch_array($result))
                {
                  echo '<option value="'.$row['region_name'].'">'.$row['region_name'].'</option>';
                }
                
              ?>
            </select>
            
						</div>
            </div>	  
            <div class="row">
            <div class="col">
            <label for="email">Email</label>
            <input class="form-control required error-email" type="text" name="donor_email" id="donor_email">
            
            </div>
            <div class="col">
            <label for="donation-date">Donation Date</label>
            <input class="form-control required" type="date" name="donationDate" id="donationDate">
            
            </div>
            </div>
            <div class="select_opt">
            <label for="donation_category">Select Category</label>
              <select class="custom-select required" name="donation_category" id="donation_category">
              <option value="default">Choose Category</option>
              <?php 
              include '../Admin/include/connection.php';
                $sql = "SELECT * from category ";
                $result = mysqli_query($conn,$sql);
                while($row =mysqli_fetch_array($result))
                {
                  echo '<option value="'.$row['category'].'">'.$row['category'].'</option>';
                }
                
              ?>
            </select>
            </div>
            <div class="select_opt">
            <label for="donation_variant">Select Variant</label>
              <select class="custom-select required" name="donation_variant" id="donation_variant">
              <option value="default">Choose Variant</option>
              <?php 
              include '../Admin/include/connection.php';
                $sql = "SELECT * from variant ";
                $result = mysqli_query($conn,$sql);
                while($row =mysqli_fetch_array($result))
                {
                  echo '<option value="'.$row['variant'].'">'.$row['variant'].'</option>';
                }
                
              ?>
            </select>
            </div>
          <div class="row">
            <div class="col">
              <label for="user-quantity">Quantity</label>
              <input class="form-control required" type="text" name="donation_quantity" id="donation_quantity">
            
            </div>
          </div>
					  
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Save</button>
      </div>
	  </form>	

    </div>
  </div>
</div>
<div class="table-data">
				<div class="add">
					<div class="head">
						<h3>Donations</h3>

					<button class="btn" id="refresh"><i class="fa-solid fa-rotate-right"></i></button>
						
            <div class="dropdown">
     <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
       Select Table
      </button>
     <div class="dropdown-menu">
        <a class="dropdown-item" href="donations.php">Donations</a>
        <a class="dropdown-item" href="moneytable.php">Money Donors</a>
      
  </div>
</div>
					</div>
					
					<table class="table table-striped table-bordered" style="width:100%" id="table_data">
			
    <thead>
      <tr>
        <th><input type="checkbox" name="" id="selectAll" class="col"></th>
        <th>Reference Number</th>
        <th>Fullname</th>
      
        <th>Donation Date</th>
        <th>Category</th>
        <th>Quantity</th>
        <th>Operations</th>
        <th>Certificate</th>
      </tr>
    </thead>
    <tbody>
      <?php
	   require ("../Admin/include/connection.php");
	    
	  $sql = "SELECT * FROM donation_items ORDER by donor_id DESC";
	  $result = mysqli_query($conn,$sql);
	 $data = $result->fetch_all(MYSQLI_ASSOC);
	 $count= 0;
	 foreach ($data as $row){
		$count = $count+ 1;
		echo'<tr>
    <td><input type="checkbox" name="single_select" class="single_select col" data-email="'.$row['donor_email'].'" data-name="'.$row['donor_name'].'"></input></td>
		<td>1234567</td>
    <td>'.$row['donor_name'].'</td>
		<td>'.$row['donationDate'].'</td>
		<td>'.$row['donation_category'].'</td>
		<td>'.$row['donation_quantity'].'</td>
		<td>
		<button type="button" class="btnDel btn col" value="'.$row['donor_id'].'"><i class="fa-solid fa-trash " style="color: red;"></i></button>
		<button type="button" data-toggle="modal" data-target="updateModal"  class="btnUpdate btn col" value="'.$row['donor_id'].'"><i class="fa-solid fa-pen-to-square" style="color: green;"></i></button>
		</td>
		<td><button type="button" class="btn btn-info email_button" name="email_button" id="'.$count.'"
		data-email="'.$row['donor_email'].'" data-name="'.$row['donor_name'].'" data-action="single">Send</button>
    </td>
	
		</tr>';
		

	 }
			
			?>
			
    </tbody>
	<tr>
		<td colspan="6"></td>
		<td>
     <button type="button" name="bulk_email" class="btn btn-info email_button" id="bulk_email" data-action="bulk" >Bulk</button></td>
	</tr>
	
  </table>
 
  			
			</div>
		</main>
	
	</section>
	
	

	<script src="../Admin/scripts/sidemenu.js"></script>
	<script src="../Admin/scripts/jQuery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<script src="../Admin/scripts/function.js"></script>
	<script src="../donors/js/sweetalert2.all.min.js"></script>	
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
  <!--Send certificate --->
  <script>
$(document).ready(function(){
 $('.email_button').click(function(){
  $(this).attr('disabled', true);
  
  var id = $(this).attr("id");
  var action = $(this).data("action");
  var email_data = [];
  if(action == 'single')
  {
   email_data.push({
    email: $(this).data("email"),
    name: $(this).data("name")
   });
  }
  else
  {
   $('.single_select').each(function(){
    if($(this). prop("checked") == true)
    {
     email_data.push({
      email: $(this).data("email"),
      name: $(this).data('name')
     });
 
    
    }
   
   });
  }
  
  $.ajax({
   url:"include/sendcerti.php",
   method:"POST",
   data:{email_data:email_data},
   beforeSend:function(){
    $('#'+id).html('Sending...');
    $('#'+id).addClass('btn-danger');
   },
   success:function(data){
    if(data = 'ok')
    {
     $('#'+id).html('<i class="fa-sharp fa-solid fa-envelope-circle-check"></i>');
     $('#'+id).removeClass('btn-danger');
     $('#'+id).removeClass('btn-info');
     $('#'+id).addClass('btn-success');
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
  <!--Select all checkbox --->
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


<script>
  $(document).ready(function(){
    var count= 0;
    function add_input_field(count){
      var html='';
      html += '<div class row>';
      html+= '<select class="form-control" name="category[]" id="category"><option value="">Choose Category</option><?php echo fill_category_select_box($conn); ?></select>';
      html += ' <select class="form-control" name="variant[]" id="variant"><option value="">Choose Variant</option><?php echo fill_variant_select_box($conn); ?></select>';
      html += '<input class="form-control" type="text" name="quantity[]" id="quantity">';
      html += '</div>';
      var remove_button='';
      if(count>0)
      {
        remove_button='<button type="button" name="remove" id="remove" class="btn btn-danger">Remove</button>'
      }
      html+='<span>'+remove_button+'</span>';
      return html;
    }
    $('#add-form').append(add_input_field(0));
    $(document).on('click', '#btn_additem',function(){
      count++;
      $('#add-form').append(add_input_field(count));

    });
    $(document).on('click','#remove', function(){
      $(this).closest('div').remove();
    });
  });
</script>

</body>
</html>