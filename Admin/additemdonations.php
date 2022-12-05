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
			$categCode= htmlentities($row['categCode']);
			$categname= htmlentities($row["category"]);
      $output .= '<option value="'.$categCode.'">'.$categname.'</option>';
    }
    return $output;
  }
  function fill_variant_box($conn)
  {
    $output= '';
    $sql= "SELECT * From variant order by variantCode ASC";
    $result = mysqli_query($conn,$sql);
	    foreach($result as $row){
			$variantCode= htmlentities($row['variantCode']);
			$variantName= htmlentities($row["variant"]);
      $output .= '<option value="'.$variantCode.'">'.$variantName.'</option>';
    }
    return $output;
  }
  
 
  function fill_region_select_box($conn){
	$output='';
	$sql = "SELECT * FROM refregion";
    $result = mysqli_query($conn,$sql);
	foreach($result as $row){
		$regid= htmlentities($row['regCode']);
		$regname= htmlentities($row['regDesc']);
	$output .= '<option value="'.$regid.'">'.$regname.'</option>';
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
	<link rel="stylesheet" href="css/donations.css">
  	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

	<title>Add donations</title>
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
				<a href="archive.php">
				<i class='bx bxs-file-archive'></i>
					<span class="text">Archive</span>
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
			<li>
				<a class="settings" href="settings.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
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
							<a class="active" href="donations.php" style="font-size: 18px;">Back</a>
						</li>
					</ul>
				</div>   
			</div>

<div class="table-data">
	<div class="add">
		<div class="head">
			<h3>Add Donations</h3>					
        <div>
        </div>
		</div>
		<form id="add-form">
  			<?php 
				$referenceId = "";
				$sql = "SELECT * FROM donation_items_picking";
                $result = mysqli_query($conn,$sql);
				foreach($result as $row){
					$referenceId = $row['reference_id'];
				}
                
			?>
          <input type="hidden"  id="reference_id" value="<?php echo htmlentities($referenceId); ?>" readonly>
		  <div class="row">
			<div class="col">
				<div class="form-group">
				<label for="fname">Fullname</label>
				<input class="form-control border-success" type="text" name="fname" id="fname">
            </div>
			</div>
			<div class="col">
            <div class="form-group">
              <label for="region">Select Region</label>
              <select class="custom-select border-success" name="region" id="region">
              <option value="-Select-">-Select Region-</option>
              <?php echo fill_region_select_box($conn); ?>
            </select>
			</div> 
			</div>
			<div class="col">
				<div class="form-group">
				<label for="province">Province</label>
				<select class="custom-select border-success" name="province" id="province">
				</select>
				</div>
			</div>
			<div class="col">
			<div class="form-group">
				<label for="municipality">Municipality</label>
				<select class="custom-select border-success" name="municipality" id="municipality">
				</select>
				</div>
			
		  	</div>	
		</div>
		<div class="row"> 
		<div class="col">
			<div class="form-group">
				<label for="barangay">Barangay</label>
				<select class="custom-select border-success" name="barangay" id="barangay">
				</select>
				</div>
			
		  	</div>	
		<div class="col">
			<div class="form-group">
				<label for="donor_contact"> Contact</label>
				<input class="form-control border-success" type="text" id="contact" name="contact">
			</div>
		</div>
		</div>
		
            <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control border-success" type="text" name="email" id="email">
            </div>
			
            <div class="form-group">
            <label for="donation_date">Donation Date</label>
            <input class="form-control border-success" type="date" name="donation_date" id="donation_date">
            </div>
           
			
            <div class="row">
				<div class="col">
					<div class="form-group">
					<label class="form-group titleColumn" style="font-weight: bold;">Donation Types & Quantity</label>
						<!-- <button style="float: right;" type="button" name="addVar" class="btn" id="addVar"><i style="color: green;font-size:40px;" class="fa-sharp fa-solid fa-plus"></i> 
								</button> -->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group variantSelect">
						<label for="variant">Select Variant</label>
						<select class="custom-select border-success variant" name="variant" id="variant">
							<option value="">Select</option><?php echo fill_variant_box($conn); ?></select>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="">Quantity</label>
							<input class="form-control quantity border-success" type="text" name="quantity" id="quantity">
						</div>
					</div>

				</div>

          </form>
				
  			
			</div>
		</main>
	
	</section>
	
	

	<script src="scripts/sidemenu.js"></script>
	<script src="scripts/jQuery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="scripts/sweetalert2.all.min.js"></script>	
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
 	<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
 
 <script>
	$(document).ready(function(){
    function add_input_field(){
	  $('#testBtn').remove();
	  $('#cancelBtn').remove();

      var html='';
	 
	  html+='<table class="table table-bordered"><tr><th>Category</th><th>Item Name</th><th>Button</th></tr>';
	  html+='<tbody class="dynamicAdd"><tr>';
	  html+='<td><select class="custom-select category border-success" name="category" id="category"><option value="-Select-">-Select-</option><?php echo fill_category_select_box($conn); ?></select></td>'
	  html+='<td><input class="form-control border-success name_items" id="name_items" name="name_items" autocomplete="off"></td>';
	  html+= '<td><button type="button" class="btn btn-success btnAdd" id="btnAdd">Add</button></td>'
	  html+='</tr></tbody></table>';

     
      return html;
    }
	var appendedTable = '<tr>'+
	'<td><select class="custom-select category border-success" name="category" id="category"><option value="-Select-">-Select-</option><?php echo fill_category_select_box($conn); ?></select></td>'+
	'<td><input class="form-control border-success name_items" id="name_items" name="name_items" autocomplete="off"></td>'+
	'<td><button type="button" class="btn btn-danger btnRemove" id="btnRemove">Remove</button></td></tr>';

	$('#add-form').append(add_input_field());
	$(document).on('click','.btnRemove', function(){
      $(this).closest('tr').remove();
    });
	$('#add-form').append('<button  type="button" class="btn addDonate" id="testBtn">Save</button>');
	$('#add-form').append('<button type="button" class="btn  cancelBtn" id="cancelBtn">Cancel</button>');
	
	$(document).on('click', '.btnAdd',function(){
		$('.dynamicAdd').append(appendedTable);
	});
	$('#testBtn').click(function(e){
		var valid = this.form.checkValidity();
        if(valid) { 
            e.preventDefault();
  
        var category_arr=[];
        var itemName_arr=[];

        var category = $('.category');
        var name_items = $('.name_items');
        // var test_qty = 0;
        for (var i = 0;i<category.length;i++){  
            category_arr.push($(category[i]).val());
            itemName_arr.push($(name_items[i]).val());
            // test_qty += parseInt($(quantity[i]).val());    
        }
	
        var reference_id= $('#reference_id').val();
        var fname = $('#fname').val();
        var province = $('#province').val();
        var region = $('#region').val();
		var municipality = $('#municipality').val();
		var barangay = $('#barangay').val();
        var email = $('#email').val();
        var donation_date = $('#donation_date').val();
        var contact= $('#contact').val();
		var variant= $('#variant').val();
		var quantity= $('#quantity').val();
        var emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var varnumbers = /^\d+$/;
        var inValid = /\s/;

          if(fname==""){
              $('#fname').removeClass('border-success');
              $('#fname').addClass('border-danger');
              return false;
          }
          else if(region=="-Select-"){
              Swal.fire('Select', "Please select a region",'warning');
              return false;
          }
		  else if(province=="-Select-"){
              Swal.fire('Select', "Please select a province",'warning');
              return false;
          }
		  else if(municipality=="-Select-"){
              Swal.fire('Select', "Please select a municipality",'warning');
              return false;
          }
		  else if(barangay=="-Select-"){
              Swal.fire('Select', "Please select a barangay",'warning');
              return false;
          }
          else if(contact==""){
              $('#contact').removeClass('border-success');
              $('#contact').addClass('border-danger');
          }
          else if (inValid.test($('#contact').val())==true){
              Swal.fire('Contact', "Whitespace is prohibited.",'warning');
              $('#contact').removeClass('border-success');
              $('#contact').addClass('border-danger');
              return false;
            }
          else if(varnumbers.test($('#contact').val())==false) {
              Swal.fire('Number', "Numbers only.",'warning');
              $('#contact').removeClass('border-success');
              $('#contact').addClass('border-danger');
              return false;
            } 
          else if(contact.length !=11){
              Swal.fire('Contact', "Enter Valid Contact Number",'warning'); 
              $('#contact').removeClass('border-success');
              $('#contact').addClass('border-danger');
              return false;
            }
          else if(email==""){
              $('#email').removeClass('border-success');
              $('#email').addClass('border-danger');
              return false;
          }
          else if(emailVali.test($('#email').val())==false){
              Swal.fire('Email', "Invalid email address",'warning'); 
              $('#email').removeClass('border-success');
              $('#email').addClass('border-danger');
              return false;
          }
        
          else if(donation_date==""){

              $('#donation_date').removeClass('border-success');
              $('#donation_date').addClass('border-danger');
              return false;
          }
		  else if (quantity==""){
                  Swal.fire('Fields', "Quantity is empty",'warning');
                  return false;
              }
			  
		 else if (inValid.test($('#quantity').val())==true){ 
                  Swal.fire('Quantity', "Whitespace is prohibited.",'warning');
                  return false;
              }
		else if(varnumbers.test($('#quantity').val())==false) {
              Swal.fire('Number', "Numbers only.",'warning');
              $('#contact').removeClass('border-success');
              $('#contact').addClass('border-danger');
              return false;
            } 
			else if(variant=="-Select-"){
              Swal.fire('Select', "Please select a variant",'warning');
              return false;
          }
          else{
              for(var j=0;j<category.length;j++){
            
               if ($(category[j]).val()=="-Select-"){
                  Swal.fire('Fields', "Please select a category",'warning');
                  return false;
              }
           else if ($(name_items[j]).val()==""){
                  Swal.fire('Fields', "Item name is empty",'warning');
                  return false;
              }
             
              }
            var data = {saveBtn: '',reference_id:reference_id,fname,province:province,region:region,municipality:municipality,barangay:barangay,contact:contact,
			email:email,donation_date:donation_date,variant:variant,quantity:quantity,category_arr:category_arr,itemName_arr:itemName_arr};
            
            $.ajax({
            url:'include/add.inc.php',
            method:'POST',
            data: data,
            success:function(data){
                 if(data == "Data added"){
                    Swal.fire({
                    title: 'Success',
                    text: "Successfully Added",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href="donations.php?inserted";
                      }
                    }) 
                  } else {
                    Swal.fire('Error', data,'error')
                  }
            },
            error: function(data){
                 Swal.fire('Error', "There were some errors while inserting the data.",'error')
               }

         });
          }
                      
        }
	});  
});


</script>
<script>
	$(document).ready(function(){
	 $('#region').on('change',function(){
		var regCode= $(this).val();
		if (regCode){
			$.ajax({
				url:'include/region.php',
				type:'POST',
				data: 'regCode='+regCode,
				success: function (data){
					$('#province').html(data);
				}

			});
		}
		else{
			swal.fire('Warning', 'Select region', 'warning');
		}
	 });
	 $('#province').on('change',function(){
		var provCode= $(this).val();
		if (provCode){
			$.ajax({
				url:'include/region.php',
				type:'POST',
				data: 'provCode='+provCode,
				success: function (data){
					$('#municipality').html(data);
				}

			});
		}
		else{
			swal.fire('Warning', 'Select province', 'warning');
		}
	 });
	 $('#municipality').on('change',function(){
		var citymunCode= $(this).val();
		if (citymunCode){
			$.ajax({
				url:'include/region.php',
				type:'POST',
				data: 'citymunCode='+citymunCode,
				success: function (data){
					$('#barangay').html(data);
				}

			});
		}
		else{
			swal.fire('Warning', 'Select municipality', 'warning');
		}
	 });
	
	});
</script>
<Script>
	$(document).ready(function(){
		$('#add-form').on('focus', '#name_items', function (e) {

		$(this).autocomplete({
		source: 'include/viewid.php',
		minLength:1,
		select: function(event,ui){
			$('#name_items').val(ui.item.value);	
		}

		}).data('ui-autocomplete')._renderItem= function(ul, item){
		return $('<li class="ui-autocomplete-row"></li>').data('item.autocomplete', item)
		.append(item.label)
		.appendTo(ul);

		};


		})
	});
</Script>

</body>
</html>