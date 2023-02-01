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
					<div class="form-group">
						<label for="">Can Goods & Noodles</label><button class="btn" id="removeCN" type="button"><i style="color: green;" class="fa-solid fa-eye"></i></i></button>
						<table class="table cnTB col" id="cnTB">
						<thead><tr>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody class="cnBody" id="cnBody"><tr>
						<td><input type="text" class="form-control" id="productName"></td>
						<td><input type="text" class="form-control" id="quantity"></td>
						<td><button type="button" class="btn btn-success addCan" id="addCan"><i class="fa-solid fa-plus"></i></button></td>
					</tr>
					</tbody>
					</table>
					</div>
					<div class="form-group hygineES">
						<label for="">Hygiene Essentials</label><button class="btn" id="removeHY" type="button"><i style="color: green;" class="fa-solid fa-eye"></i></i></button>
						<table class="table hyTB col" id="hyTB">
						<thead><tr>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody class="hyBody" id="hyBody"><tr>
						<td><input type="text" class="form-control" id="productName"></td>
						<td><input type="text" class="form-control" id="quantity"></td>
						<td><button type="button" class="btn btn-success addCan" id="addCan"><i class="fa-solid fa-plus"></i></button></td>
					</tr>
					</tbody>
					</table>
					</div>
					<div class="form-group">
						<label for="">Infant Items(*Formula not included)</label><button class="btn" id="removeII" type="button"><i style="color: green;" class="fa-solid fa-eye"></i></i></button>
						<table class="table iiTB col" id="iiTB">
						<thead><tr>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody class="iiBody" id="iiBody"><tr>
						<td><input type="text" class="form-control" id="productName"></td>
						<td><input type="text" class="form-control" id="quantity"></td>
						<td><button type="button" class="btn btn-success addCan" id="addCan"><i class="fa-solid fa-plus"></i></button></td>
					</tr>
					</tbody>
					</table>
					</div>
					<div class="form-group">
						<label for="">Drinking Water</label><button class="btn" id="removeDW" type="button"><i style="color: green;" class="fa-solid fa-eye"></i></i></button>
						<table class="table dwTB col" id="dwTB">
						<thead><tr>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Unit</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody class="dwBody" id="dwBody"><tr>
						<td><input type="text" class="form-control" id="productName"></td>
						<td><input type="text" class="form-control" id="quantity"></td>
						<td><select class="form-control" name="unitDrink" id="">
							<option value="">Choose</option>
							<option value="">250ml</option>
							<option value="">300ml</option>
							<option value="">350ml</option>
							<option value="">500ml</option>
							<option value="">1L</option>
							<option value="">1.5L</option>
							<option value="">2L</option>
							<option value="">2.5L</option>
							<option value="">3L</option>
							<option value="">4L</option>
							<option value="">5L</option>
							<option value="">6L</option>
						</select></td>
						<td><button type="button" class="btn btn-success addCan" id="addCan"><i class="fa-solid fa-plus"></i></button></td>
					</tr>
					</tbody>
					</table>
					</div>
					<div class="form-group">
						<label for="">Meats/Grains</label><button class="btn" id="removeMG" type="button"><i style="color: green;" class="fa-solid fa-eye"></i></i></button>
						<table class="table mgTB col" id="mgTB">
						<thead><tr>
							<th>Product Name</th>
							<th>Type</th>
							<th>Quantity</th>
							<th>Unit</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody class="mgBody" id="mgBody"><tr>
						<td><input type="text" class="form-control" id="productName"></td>
						<td><select class="form-control" name="unitDrink" id="">
							<option value="">Choose</option>
							<option value="">Frozen</option>
							<option value="">Fresh</option>
							<option value="">None</option>
						</select></td>
						<td><input type="text" class="form-control" id="quantity"></td>
						<td><select class="form-control" name="unitDrink" id="">
							<option value="">Choose</option>
							<option value="">Kilograms</option>
							<option value="">Grams</option>
						</select></td>
						<td><button type="button" class="btn btn-success addCan" id="addCan"><i class="fa-solid fa-plus"></i></button></td>
					</tr>
					</tbody>
					</table>
					</div>
					<div class="form-group">
						<label for="">Medicine</label><button class="btn" id="removeME" type="button"><i style="color: green;" class="fa-solid fa-eye"></i></i></button>
						<table class="table meTB col" id="meTB">
						<thead><tr>
							<th>Product Name</th>
							<th>Type</th>
							<th>Quantity</th>
							<th>Unit</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody class="meBody" id="meBody"><tr>
						<td><input type="text" class="form-control" id="productName"></td>
						<td><select class="form-control" name="unitDrink" id="">
							<option value="">Choose</option>
							<option value="">Tablet</option>
							<option value="">Capsule</option>
							<option value="">Liquid</option>
						</select></td>
						<td><input type="text" class="form-control" id="quantity"></td>
						<td><select class="form-control" name="unitDrink" id="">
							<option value="">Choose</option>
							<option value="">Milligrams</option>
							<option value="">Grams</option>
							<option value="">Micrograms</option>
						</select></td>
						<td><button type="button" class="btn btn-success addCan" id="addCan"><i class="fa-solid fa-plus"></i></button></td>
					</tr>
					</tbody>
					</table>
					</div>
					<div class="form-group">
						<label for="">Others (Type n/a if there is no type or unit)</label><button class="btn" id="removeO" type="button"><i style="color: green;" class="fa-solid fa-eye"></i></i></button>
						<table class="table oTB col" id="oTB">
						<thead><tr>
							<th>Product Name</th>
							<th>Type</th>
							<th>Quantity</th>
							<th>Unit</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody class="oBody" id="oBody"><tr>
						<td><input type="text" class="form-control" id="productName"></td>
						<td><input type="text" class="form-control" id="productName"></td>
						<td><input type="text" class="form-control" id="quantity"></td>
						<td><input type="text" class="form-control" id="productName"></td>
						<td><button type="button" class="btn btn-success addCan" id="addCan"><i class="fa-solid fa-plus"></i></button></td>
					</tr>
					</tbody>
					</table>
					</div>
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
	$(document).ready(function() {
		var count=0;
  function add_NewCan(count){
				
				var appendCanNoodles='';
				appendCanNoodles += '<tr><td><input type="text" class="form-control" id="productName"></td><td><input type="text" class="form-control" id="quantity"></td>';
				var removeBtn='';
				if (count>0){
					removeBtn= '<button type="button" name="remove" id="remove" class="btn btn-danger"><i class="fa-solid fa-minus"></i></button>'
				}
				appendCanNoodles += '<td>'+removeBtn+'</td></tr>';
				return appendCanNoodles;
			}
			
			$(document).on('click','#addCan',function(){

			count++;
				$('.canBody').append(add_NewCan(count));
			})
 			 $(document).on('click','#remove', function(){
			$(this).closest('tr').remove();
				});	
			//hide hygine
			$(document).on('click','#removeHY',function(){
				$('.hygine').hide();
				$('#removeHY').hide();
				var showHY= '<button id="showHY" type="button" class="btn"><i style="color:red;" class="fa-sharp fa-solid fa-eye-slash"></i></button>'
				$('.hygineES').append(showHY);

			})
			//show hygine
			$(document).on('click','#showHY',function(){
				$('.hygine').show();
				$('#removeHY').show();
				$('#showHY').remove()	
					})

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

		}


		});
	});
</Script>

</body>
</html>