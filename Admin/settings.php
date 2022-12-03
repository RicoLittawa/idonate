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

	<title>Settings</title>
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
			<li>
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
				<a href="archive.php">
				<i class='bx bxs-file-archive'></i>
					<span class="text">Records</span>
				</a>
			</li>
			<li>
				<a href="categorytables.php">
					<i class='bx bxs-package'></i>
					<span class="text">Stocks</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li class="active">
				<a class="settings" href="settings.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="include/logout.php" class="logout">
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
				<div class="form-input">
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
					<h1>Settings</h1>
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
			</div>
			
			<div class="table-data">
				<div class="add">
					<div class="head">
						<h3>Configure</h3>
					</div>	
				<div class="modify">
					<form id="add_template" enctype="multipart/form-data">
						<div class="form-group">
						<label for="">Upload Certificate Template</label>
						</div>
						<?php
						require_once 'include/connection.php';
						 $sql="SELECT * from template_certi";
						$result= mysqli_query($conn,$sql);
						foreach($result as $row):				
						?>
						<input type="hidden" value="<?php echo htmlentities($row['id']); ?>" id="tempId">
						
						<div class="row">
							<div class="col">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="customFile" name="customFile">
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
							</div>
							<div class="col">
      						<button  type="button" id="upload" class="btn mt-0"><i style="color:green ;font-size:30px;" class="fa-solid fa-file-import"></i></button>
							<button type="button" id="viewImage" class="btn mt-0 certImg"  data-toggle="modal" data-target="template" value="<?php echo htmlentities($row['id']); ?>"><i style="color:green ;font-size:30px;" class="fa-solid fa-image"></i></button>
							<?php endforeach; ?>
						 </div>
						</div>	
						<!-- View Template -->
						<div class="modal fade" id="template">
							<div class="modal-dialog modal-dialog-centered d-flex modal-custom">
								<div class="modal-content flex-shrink-1 w-auto mx-auto">

								<!-- Modal Header -->
								<div class="modal-header">
									<h4 class="modal-title">Template</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									
								</div>
								
								

								<form>
								<div class="modal-body">
								<img src="" id="imageContainer" alt="" width="800px" height="100%" style="border-radius:10px;">
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
								</form>

									

								</div>
							</div>
							</div>	
					</form>
					<form action=""id="upCateg">
					<div class="form-group">
						<label for="">Add new category</label>
						</div>
						
						<div class="row">
							<div class="col">
								
								<input class="form-control" type="text" name="" id="">
							</div>
							<div class="col">
							<button  type="button" class="btn btn-success mt-0">Add</button>
							</div>
						</div>
					</form>
					<form action="" id="announce">
						<div class="form-group">
							<label for="">Announcement</label>
							<textarea class="form-control" name="" id="" cols="5" rows="4"></textarea>
						</div>
						<div class="mt-3">
							<button style="float: right;" class="btn btn-primary">Update</button>
						</div>
					</form>
				</div>
			</div>
		</main>
	
	</section>
	
	

	<script src="scripts/sidemenu.js"></script>
	<script src="scripts/jQuery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="scripts/sweetalert2.all.min.js"></script>	
	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  	<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
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
<!--Upload template -->
<script>
	$(document).ready(function(){
		$(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    	});
		$("#upload").click(function(){
			
			var form = $('#add_template')[0];
          	var fd = new FormData(form);
			var tempId= $("#tempId").val();
			fd.append("tempId",tempId);
			fd.append("upload",true);
			var extension = $('#customFile').val().split('.').pop().toLowerCase();
			if($('#customFile').val()==''){
             Swal.fire('Fields', "Please insert an image",'warning');
			 return false;
           }
           else if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1){
             Swal.fire('Image', "Invalid file extension.",'warning');
             $("#requestform").find('[type=file]').val('').trigger('change');
             return false;
           }
		   else{
			$.ajax({
				url: 'include/viewid.php',
              method: 'POST',
               data:fd,
              dataType:'text',
               processData:false,
              contentType:false,  
              success: function(data) {
				swal.fire('Photo',data,'success');
			  }
			});
		   }
			
		});
	});
</script>
<script>
	$(document).ready(function(){
		$('.certImg').click(function(){
			var valueBtn = $(this);
			var id =valueBtn.val();
			
			  $.ajax({
			  	url:'include/viewid.php?viewTemp='+id,
			  	type: 'GET',
			  	success: function(data){
					
			  			 $('#template').modal('show');
						   $('#imageContainer').attr('src','include/Certificate Template/'+data);		   		
			  	}
			  });



		});
	});
</script>
	

	

</body>
</html>
