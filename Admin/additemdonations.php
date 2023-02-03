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
					<div class="form-group cn">
						<div class="form-check form-check-inline">
							<input class="form-check-input selectCateg" name="selector[]" data="selector[]" type="checkbox" id="inlineCheckbox1" value="cannoodles">
							<label class="form-check-label" for="inlineCheckbox1">1</label>
							</div>
						<label for="">Can Goods & Noodles</label><button class="btn" id="removeCN" type="button"><i style="color: green;" class="fa-solid fa-eye"></i></button>
						<table class="table cnTB col" id="cnTB">
						<thead><tr>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody class="cnBody" id="cnBody"><tr>
						<td><input type="text" class="form-control name_items pnCN" id="pnCN"></td>
						<td><input type="text" class="form-control qCN" id="qCN"></td>
						<td><button type="button" class="btn btn-success addCN" id="addCN"><i class="fa-solid fa-plus"></i></button></td>
					</tr>
					</tbody>
					</table>
					</div>
					<div class="form-group hy">
					<!-- <div class="form-check">
						<input class="form-check-input selectCateg" type="radio" name="exampleRadios" id="exampleRadios1" value="hygine" checked>
						<label class="form-check-label" for="exampleRadios1">
							Default radio
						</label>
						</div> -->
						<div class="form-check form-check-inline">
							<input class="form-check-input selectCateg" name="selector[]" data="selector[]"  type="checkbox" id="inlineCheckbox1" value="hygine">
							<label class="form-check-label" for="inlineCheckbox1">1</label>
							</div>
						<label for="">Hygiene Essentials</label><button class="btn" id="removeHY" type="button"><i style="color: green;" class="fa-solid fa-eye"></i></button>
						<table class="table hyTB col" id="hyTB">
						<thead><tr>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody class="hyBody" id="hyBody"><tr>
						<td><input type="text" class="form-control name_items pnHY" id="pnHY"></td>
						<td><input type="text" class="form-control qHY" id="qHY"></td>
						<td><button type="button" class="btn btn-success addHY" id="addHY"><i class="fa-solid fa-plus"></i></button></td>
					</tr>
					</tbody>
					</table>
					</div>
					<div class="form-group ii">
						<label for="">Infant Items(*Formula not included)</label><button class="btn" id="removeII" type="button"><i style="color: green;" class="fa-solid fa-eye"></i></button>
						<table class="table iiTB col" id="iiTB">
						<thead><tr>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody class="iiBody" id="iiBody"><tr>
						<td><input type="text" class="form-control name_items pnII" id="pnII"></td>
						<td><input type="text" class="form-control qII" id="qII"></td>
						<td><button type="button" class="btn btn-success addII" id="addII"><i class="fa-solid fa-plus"></i></button></td>
					</tr>
					</tbody>
					</table>
					</div>
					<div class="form-group dw">
						<label for="">Drinking Water</label><button class="btn" id="removeDW" type="button"><i style="color: green;" class="fa-solid fa-eye"></i></button>
						<table class="table dwTB col" id="dwTB">
						<thead><tr>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody class="dwBody" id="dwBody"><tr>
						<td><input type="text" class="form-control name_items pnDW" id="pnDW"></td>
						<td><input type="text" class="form-control qDW" id="qDW"></td>
						<td><button type="button" class="btn btn-success addDW" id="addDW"><i class="fa-solid fa-plus"></i></button></td>
					</tr>
					</tbody>
					</table>
					</div>
					<div class="form-group mg">
						<label for="">Meats/Grains</label><button class="btn" id="removeMG" type="button"><i style="color: green;" class="fa-solid fa-eye"></i></button>
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
						<td><input type="text" class="form-control name_items pnMG" id="pnMG"></td>
						<td><select class="form-control typeMG" name="typeMG" id="typeMG">
							<option value="">Choose</option>
							<option value="Frozen">Frozen</option>
							<option value="Fresh">Fresh</option>
							<option value="None">None</option>
						</select></td>
						<td><input type="text" class="form-control qMG" id="qMG"></td>
						<td><select class="form-control unitMG" name="unitMG" id="unitMG">
							<option value="">Choose</option>
							<option value="Kilograms">Kilograms</option>
							<option value="Grams">Grams</option>
						</select></td>
						<td><button type="button" class="btn btn-success addMG" id="addMG"><i class="fa-solid fa-plus"></i></button></td>
					</tr>
					</tbody>
					</table>
					</div>
					<div class="form-group me">
						<label for="">Medicine</label><button class="btn" id="removeME" type="button"><i style="color: green;" class="fa-solid fa-eye"></i></button>
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
						<td><input type="text" class="form-control name_items pnME" id="pnME"></td>
						<td><select class="form-control typeME" name="typeME" id="typeME">
							<option value="">Choose</option>
							<option value="Tablet">Tablet</option>
							<option value="Capsule">Capsule</option>
							<option value="Liquid">Liquid</option>
							<option value="None">None</option>
						</select></td>
						<td><input type="text" class="form-control qME" id="qME"></td>
						<td><select class="form-control unitME" name="unitME" id="unitME">
							<option value="">Choose</option>
							<option value="Milligrams">Milligrams</option>
							<option value="Grams">Grams</option>
							<option value="Micrograms">Micrograms</option>
							<option value="None">None</option>
						</select></td>
						<td><button type="button" class="btn btn-success addME" id="addME"><i class="fa-solid fa-plus"></i></button></td>
					</tr>
					</tbody>
					</table>
					</div>
					<div class="form-group ot">
						<label for="">Others (Type n/a if there is no type or unit)</label><button class="btn" id="removeOT" type="button"><i style="color: green;" class="fa-solid fa-eye"></i></button>
						<table class="table otTB col" id="otTB">
						<thead><tr>
							<th>Product Name</th>
							<th>Type</th>
							<th>Quantity</th>
							<th>Unit</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody class="otBody" id="otBody"><tr>
						<td><input type="text" class="form-control pnOT" id="pnOT"></td>
						<td><input type="text" class="form-control typeOT" id="typeOT"></td>
						<td><input type="text" class="form-control qOT" id="qOT"></td>
						<td><input type="text" class="form-control unitOT" id="unitOT"></td>
						<td><button type="button" class="btn btn-success addOT" id="addOT"><i class="fa-solid fa-plus"></i></button></td>
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
		
	</script>
 <script>
	$(document).ready(function() {
		var count=0;
  			function add_CN(count){
				
				var appendCN='';
				appendCN += '<tr><td><input type="text" class="form-control name_items pnCN" id="pnCN"></td><td><input type="text" class="form-control qCN" id="qCN"></td>';
				var removeCnBtn='';
				if (count>0){
					removeCnBtn= '<button type="button" name="removeCN" id="removeTbCn" class="btn btn-danger"><i class="fa-solid fa-minus"></i></button>'
				}
				appendCN += '<td>'+removeCnBtn+'</td></tr>';
				return appendCN;
			}
			function add_HY(count){
				
				var appendHY='';
				appendHY += '<tr><td><input type="text" class="form-control name_items pnHY" id="pnHY"></td><td><input type="text" class="form-control qHY" id="qHY"></td>';
				var removeHyBtn='';
				if (count>0){
					removeHyBtn= '<button type="button" name="removeHY" id="removeTbHy" class="btn btn-danger"><i class="fa-solid fa-minus"></i></button>'
				}
				appendHY += '<td>'+removeHyBtn+'</td></tr>';
				return appendHY;
			}
			function add_II(count){
				
				var appendII='';
				appendII += '<tr><td><input type="text" class="form-control name_items pnII" id="pnII"></td><td><input type="text" class="form-control qII" id="qII"></td>';
				var removeIiBtn='';
				if (count>0){
					removeIiBtn= '<button type="button" name="removeII" id="removeTbIi" class="btn btn-danger"><i class="fa-solid fa-minus"></i></button>'
				}
				appendII += '<td>'+removeIiBtn+'</td></tr>';
				return appendII;
			}
			function add_DW(count){
				
				var appendDW='';
				appendDW += '<tr><td><input type="text" class="form-control name_items pnDW" id="pnDW"></td><td><input type="text" class="form-control qDW" id="qDW"></td>';
				var removeDwBtn='';
				if (count>0){
					removeDwBtn= '<button type="button" name="removeDW" id="removeTbDw" class="btn btn-danger"><i class="fa-solid fa-minus"></i></button>'
				}
				appendDW += '<td>'+removeDwBtn+'</td></tr>';
				return appendDW;
			}
			function add_MG(count){
				
				var appendMG='';
				appendMG += '<tr><td><input type="text" class="form-control name_items pnMG" id="pnMG"></td>'+
				'<td><select class="form-control typeMG" name="typeMG" id="typeMG">'+
							'<option value="">Choose</option>'+
							'<option value="Frozen">Frozen</option>'+
							'<option value="Fresh">Fresh</option>'+
							'<option value="None">None</option>'+
						'</select></td>'+
						'<td><input type="text" class="form-control qMG" id="qMG"></td>'+
						'<td><select class="form-control unitMG" name="unitMG" id="unitMG">'+
							'<option value="">Choose</option>'+
							'<option value="Kilograms">Kilograms</option>'+
							'<option value="Grams">Grams</option>'+
						'</select></td>';
						
				var removeMgBtn='';
				if (count>0){
					removeMgBtn= '<button type="button" name="removeMG" id="removeTbMg" class="btn btn-danger"><i class="fa-solid fa-minus"></i></button>'
				}
				appendMG += '<td>'+removeMgBtn+'</td></tr>';
				return appendMG;
			}
			function add_ME(count){
				
				var appendME='';
				appendME += '<tr><td><input type="text" class="form-control name_items pnME" id="pnME"></td>'+
				'<td><select class="form-control typeME" name="typeME" id="typeME">'+
							'<option value="">Choose</option>'+
							'<option value="Tablet">Tablet</option>'+
							'<option value="Capsule">Capsule</option>'+
							'<option value="Liquid">Liquid</option>'+
							'<option value="None">None</option>'+
						'</select></td>'+
						'<td><input type="text" class="form-control qME" id="qME"></td>'+
						'<td><select class="form-control unitME" name="unitME" id="unitME">'+
							'<option value="">Choose</option>'+
							'<option value="">Milligrams</option>'+
							'<option value="">Grams</option>'+
							'<option value="">Micrograms</option>'+
							'<option value="">None</option>'+
						'</select></td>';
						
				var removeMeBtn='';
				if (count>0){
					removeMeBtn= '<button type="button" name="removeME" id="removeTbMe" class="btn btn-danger"><i class="fa-solid fa-minus"></i></button>'
				}
				appendME += '<td>'+removeMeBtn+'</td></tr>';
				return appendME;
			}
			function add_OT(count){
				
				var appendOT='';
				appendOT += '<tr><td><input type="text" class="form-control pnOT" id="pnOT"></td>'+
							'<td><input type="text" class="form-control typeOT" id="typeOT"></td>'+
							'<td><input type="text" class="form-control qOT" id="qOT"></td>'+
							'<td><input type="text" class="form-control unituOT" id="unituOT"></td>';
	
				var removeOtBtn='';
				if (count>0){
					removeOtBtn= '<button type="button" name="removeOT" id="removeTbOt" class="btn btn-danger"><i class="fa-solid fa-minus"></i></button>'
				}
				appendOT += '<td>'+removeOtBtn+'</td></tr>';
				return appendOT;
			}
			//add to cn
			$(document).on('click','#addCN',function(){
				count++;
				$('.cnBody').append(add_CN(count));
			})
 			 $(document).on('click','#removeTbCn', function(){
			$(this).closest('tr').remove();
				});	
			//add to hy
			$(document).on('click','#addHY',function(){
				count++;
				$('.hyBody').append(add_HY(count));
			})
 			 $(document).on('click','#removeTbHy', function(){
			$(this).closest('tr').remove();
				});
			//add to ii
			$(document).on('click','#addII',function(){
				count++;
				$('.iiBody').append(add_II(count));
			})
 			 $(document).on('click','#removeTbIi', function(){
			$(this).closest('tr').remove();
				});	
			//add to dw
			$(document).on('click','#addDW',function(){
				count++;
				$('.dwBody').append(add_DW(count));
			})
 			 $(document).on('click','#removeTbDw', function(){
			$(this).closest('tr').remove();
				});	
			//add to mg
			$(document).on('click','#addMG',function(){
				count++;
				$('.mgBody').append(add_MG(count));
			})
 			 $(document).on('click','#removeTbMg', function(){
			$(this).closest('tr').remove();
				});	
			//add to me
			$(document).on('click','#addME',function(){
				count++;
				$('.meBody').append(add_ME(count));
			})
 			 $(document).on('click','#removeTbMe', function(){
			$(this).closest('tr').remove();
				});	
			//add to ot
			$(document).on('click','#addOT',function(){
				count++;
				$('.otBody').append(add_OT(count));
			})
 			 $(document).on('click','#removeTbOt', function(){
			$(this).closest('tr').remove();
				});	
				
			
			




			//remove buttons

			//hide can/noodles
			$(document).on('click','#removeCN',function(){
				$('.cnTB').hide();
				$('#removeCN').hide();
				var showCN= '<button id="showCN" type="button" class="btn"><i style="color:red;" class="fa-sharp fa-solid fa-eye-slash"></i></button>'
				$('.cn').append(showCN);

			});
			//show can/noodles
			$(document).on('click','#showCN',function(){
				$('.cnTB').show();
				$('#removeCN').show();
				$('#showCN').remove()	
					});
			//hide hygine
			$(document).on('click','#removeHY',function(){
				$('.hyTB').hide();
				$('#removeHY').hide();
				var showHY= '<button id="showHY" type="button" class="btn"><i style="color:red;" class="fa-sharp fa-solid fa-eye-slash"></i></button>'
				$('.hy').append(showHY);

			})
			//show hygine
			$(document).on('click','#showHY',function(){
				$('.hyTB').show();
				$('#removeHY').show();
				$('#showHY').remove()	
					});
			//hide infant
			$(document).on('click','#removeII',function(){
				$('.iiTB').hide();
				$('#removeII').hide();
				var showII= '<button id="showII" type="button" class="btn"><i style="color:red;" class="fa-sharp fa-solid fa-eye-slash"></i></button>'
				$('.ii').append(showII);

			})
			//show infant
			$(document).on('click','#showII',function(){
				$('.iiTB').show();
				$('#removeII').show();
				$('#showII').remove()	
					});
			//hide drinking water
			$(document).on('click','#removeDW',function(){
				$('.dwTB').hide();
				$('#removeDW').hide();
				var showDW= '<button id="showDW" type="button" class="btn"><i style="color:red;" class="fa-sharp fa-solid fa-eye-slash"></i></button>'
				$('.dw').append(showDW);

			})
			//show drinking water
			$(document).on('click','#showDW',function(){
				$('.dwTB').show();
				$('#removeDW').show();
				$('#showDW').remove()	
					});
			//hide meat/grains
			$(document).on('click','#removeMG',function(){
				$('.mgTB').hide();
				$('#removeMG').hide();
				var showMG= '<button id="showMG" type="button" class="btn"><i style="color:red;" class="fa-sharp fa-solid fa-eye-slash"></i></button>'
				$('.mg').append(showMG);

			})
			//show meat/grains
			$(document).on('click','#showMG',function(){
				$('.mgTB').show();
				$('#removeMG').show();
				$('#showMG').remove()	
					});
			//hide medicine
			$(document).on('click','#removeME',function(){
				$('.meTB').hide();
				$('#removeME').hide();
				var showME= '<button id="showME" type="button" class="btn"><i style="color:red;" class="fa-sharp fa-solid fa-eye-slash"></i></button>'
				$('.me').append(showME);

			})
			//show medicine
			$(document).on('click','#showME',function(){
				$('.meTB').show();
				$('#removeME').show();
				$('#showME').remove()	
					});
			//hide others
			$(document).on('click','#removeOT',function(){
				$('.otTB').hide();
				$('#removeOT').hide();
				var showOT= '<button id="showOT" type="button" class="btn"><i style="color:red;" class="fa-sharp fa-solid fa-eye-slash"></i></button>'
				$('.ot').append(showOT);

			})
			//show others
			$(document).on('click','#showOT',function(){
				$('.otTB').show();
				$('#removeOT').show();
				$('#showOT').remove()	
					});
			var saveBtn= '<button type="button" style="float:right; height:50px;width:100px;" class="btn btn-success" id="saveD">Save</button>';
			$('#add-form').append(saveBtn);
			$(document).on('click','#saveD',function(e){
				e.preventDefault();

				var pnCN= $('.pnCN');
				var qCN= $('.qCN');
				var pnHY= $('.pnHY');
				var qHY= $('.qHY');
				var pnII= $('.pnII');
				var qII= $('.qII');
				var pnDW= $('.pnDW');
				var qDW= $('.qDW');
				//get data with select
				var pnMG= $('.pnMG');
				var qMG= $('.qMG');
				var typeMG= $('.typeMG');
				var unitMG= $('.unitMG');
				var pnME= $('.pnME');
				var qME= $('.qME');
				var typeME= $('.typeME');
				var unitME= $('.unitME');
				var pnOT= $('.pnOT');
				var qOT= $('.qOT');
				var typeOT= $('.typeOT');
				var unitOT= $('.unitOT');


				//no select
				var pnCN_arr= [];
				var qCN_arr= [];
				var pnHY_arr=[];
				var qHY_arr=[];
				var pnII_arr=[];
				var qII_arr=[];
				var pnDW_arr=[];
				var qDW_arr=[];

				//with select options
				var pnMG_arr=[];
				var qMG_arr=[];
				var typeMG_arr=[];
				var unitMG_arr=[];
				var pnME_arr=[];
				var qME_arr=[];
				var typeME_arr=[];
				var unitME_arr=[];
				var pnOT_arr=[];
				var qOT_arr=[];
				var typeOT_arr=[];
				var unitOT_arr=[];
				
				// const result = $('input[name="selector"]:checked').map( function () { 
				// 	return $(this).val(); 
				// })
				// .get()
				// .join(', ');
				var i=0;
				var result = [];
       $('.selectCateg:checked').each(function () {
           result[i++] = $(this).val();
       });   





				for (var i = 0;i<pnCN.length;i++){  
					pnCN_arr.push($(pnCN[i]).val());
					qCN_arr.push($(qCN[i]).val());
        		}
				for (var i = 0;i<pnHY.length;i++){  
					pnHY_arr.push($(pnHY[i]).val());
					qHY_arr.push($(qHY[i]).val());
           
        		}
				for (var i = 0;i<pnII.length;i++){  
					pnII_arr.push($(pnII[i]).val());
					qII_arr.push($(qII[i]).val());
           
        		}
				for (var i = 0;i<pnDW.length;i++){  
					pnDW_arr.push($(pnDW[i]).val());
					qDW_arr.push($(qDW[i]).val());
           
        		}
				for (var i = 0;i<pnMG.length;i++){  
					pnMG_arr.push($(pnMG[i]).val());
					typeMG_arr.push($(typeMG[i]).val());
					qMG_arr.push($(qMG[i]).val());
					unitMG_arr.push($(unitMG[i]).val());
           
        		}
				for (var i = 0;i<pnME.length;i++){  
					pnME_arr.push($(pnME[i]).val());
					typeME_arr.push($(typeME[i]).val());
					qME_arr.push($(qME[i]).val());
					unitME_arr.push($(unitME[i]).val());
           
        		}
				for (var i = 0;i<pnOT.length;i++){  
					pnOT_arr.push($(pnOT[i]).val());
					typeOT_arr.push($(typeOT[i]).val());
					qOT_arr.push($(qOT[i]).val());
					unitOT_arr.push($(unitOT[i]).val());
           
        		}
				var ref_id= $('#reference_id').val();
				var fname= $('#fname').val();
				var region= $('#region').val();
				var province= $('#province').val();
				var municipality= $('#municipality').val();
				var barangay= $('#barangay').val();
				var contact= $('#contact').val();
				var email= $('#email').val();
				var donation_date= $('#donation_date').val();

				var data={saveBtn: '',result:result,ref_id:ref_id,fname:fname,region:region,province:province,municipality:municipality,barangay:barangay,
					contact:contact,email:email,donation_date:donation_date,pnCN_arr:pnCN_arr,qCN_arr:qCN_arr,
					pnHY_arr:pnHY_arr,qHY_arr:qHY_arr,pnII_arr:pnII_arr,qII_arr:qII_arr,pnDW_arr:pnDW_arr,qDW_arr:qDW_arr,
					pnMG_arr:pnMG_arr,typeMG_arr:typeMG_arr,qMG_arr:qMG_arr,unitMG_arr:unitMG_arr,
					pnME_arr:pnME_arr,typeME_arr:typeME_arr,qME_arr:qME_arr,unitME_arr:unitME_arr,
					pnOT_arr:pnOT_arr,typeOT_arr:typeOT_arr,qOT_arr:qOT_arr,unitOT_arr:unitOT_arr}

				console.log(data);
				$.ajax({
					url:'include/add.inc.php',
					method:'POST',
					data: data,
					success: function(data){
						alert(data);
					}
				});
			})


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
		$('#add-form').on('focus', '.name_items', function (e) {

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