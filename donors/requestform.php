<?php 
  include 'include/connection.php';
  function fill_category_select_box($conn)
  {
    $output= '';
    $sql= "SELECT * From category order by categ_id ASC";
    $result = mysqli_query($conn,$sql);
	    foreach($result as $row){
      $output .= '<option value="'.$row['categ_id'].'">'.$row['category'].'</option>';
    }
    return $output;
  }
 
   function fill_region_select_box($conn){
     $output='';
             
     $sql = "SELECT * from refRegion ";
     $result = mysqli_query($conn,$sql);
     foreach($result as $row){
       $output .= '<option value="'.$row['regCode'].'">'.$row['regDesc'].'</option>';
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
   
  ?>



<!doctype html>
<html lang="en">
  <head>
    <title>Request</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/request.css">
    <link rel="stylesheet" href="css/donors.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    

  </head>
  <body>
  <nav class="navbar bg-light" id="myNavbar">
  <div class="container-fluid">
    
    <div>
    <ul class="nav nav-pills nav-fill">
        
        <li class="nav-item">
          <a class="nav-link " href="frontpage.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="donation.php">Donations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="howitworks.php">How it works?</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="whatisneeded.php">What is needed?</a>
        </li>
        <li class="nav-item dropdown ">
		   <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown">  Fill Up  </a>
		    <ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="requestform.php">Request Form</a></li>
			  <li><a class="dropdown-item" href="formoney.php">Money Donor Forms</a></li>
			 
		    </ul>
		</li>


  </ul>
    </div>
  </div>
</nav>


<div>
  <span class="moneydot"></span>
</div>
<div>
<span class="moneydot2"></span>
</div>
<div>
  <div ><a class="back" href="donation.php"><i style="font-size: 50px;" class="fa-solid fa-arrow-left"></i></a></div>
  <p class="paragleft">Set Request </p>
</div>
<div class="container" id="container">
 
	<!-- Request Form -->
       <div class="donorForm"> 

       <form id="requestform" enctype="multipart/form-data">
        
          
          <?php 
          $sql="SELECT * from set_request_pickings";
          $result=mysqli_query($conn,$sql);
          foreach ($result as $row){
            $referenceId= $row['reference_id'];
          }
          
          ?>
         <input type="hidden" name="ref_id" id="ref_id" value="<?php echo $referenceId ?>" readonly>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="fname">Fullname</label>
                <input class="form-control border-success" type="text" name="fname" id="fname" placeholder="">
              </div>
            </div>
         </div>
         <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="region">Select Region</label>
              <select class="custom-select border-success" name="region" id="region">
                <option value="-Select-">-Select-</option>
               <?php echo fill_region_select_box($conn) ?>             
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
              <label for="email">Email</label>
              <input class="form-control border-success" type="text" name="email" id="email">
               </div>
             </div> 
            </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="contact">Contact No.</label>
              <input class="form-control border-success" type="text" name="contact" id="contact">
              </div>
            </div>	 
          <div class="col">
              <div class="form-group">
                <label for="donation_date">Donation Date</label>
                <input class="form-control border-success" type="date" name="date" id="date">
                 </div>
                </div>
              </div>
        <div class="row">
          <div class="col">
            <label for="valid_id">Valid Id</label>
              <div class="custom-file">
                <input type="file" name="idImg" class="custom-file-input" id="idImg">
                <label class="custom-file-label" for="customFile">Choose file</label>
                 </div>
               </div>
              </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
             <label for="note">Donor's note (Optional)</label>
              <textarea style="display:center ;" class="form-control border-success" type="text" name="note" id="note" placeholder="Donors Note" cols="80" rows="5" ></textarea>
              </div>
						</div>
          </div>
          <div class="row">
              <div class="col">
                <div class="form-group">
                <label class="form-group" style="font-weight: bold;">Donation Types & Quantity</label>  
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
      </div>
      
      
         <div class="site-footer" id="footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6"> 
            <h6>About</h6>
            <p class="text-justify">IDONATE is an online platform created for CDRRMO. With the use of the internet, 
            this web-based system will lessen the manual process. It will also automate sending the acknowledgement receipt to the donors.
             Donors may see how their donations are used with the help of a web-based donation system.</p>
          </div>
          <div class="col-xs-6 col-md-3">
            <h6>Contacts</h6>
            <ul class="footer-links">
              <li><h1>Emergency Hotline: (043) 702-3902</h1></li>
              <li><h1>Office Number: (043)- 984-4300 /(043)-727-2768</h1></li>
              <li><h1>Email: cdrrmobatangas@yahoo.com.ph</h1></li>  
              <li><h1>Location: Brgy.  Bolbok 4200, Batangas City Philippines</h1></li>            
            </ul>
          </div>
          <div class="logo"> <img src="img/logo.png" alt=""></div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2022 All Rights Reserved
            </p>
          </div>
        </div>
      </div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jQuery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/sweetalert2.all.min.js"></script>
   
    <script>
      $(document).ready(function(){
        $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
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

	$('#requestform').append(add_input_field());
	$(document).on('click','.btnRemove', function(){
      $(this).closest('tr').remove();
    });
	$('#requestform').append('<button  type="button" class="btn submit-request" id="testBtn">Save</button>');
	
	$(document).on('click', '.btnAdd',function(){
		$('.dynamicAdd').append(appendedTable);
	});
	$('#testBtn').click(function(e){
		var valid = this.form.checkValidity();
        if(valid) { 
            e.preventDefault();
            var fd = new FormData();
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
	
        var ref_id= $('#ref_id').val();
        var fname = $('#fname').val();
        var province = $('#province').val();
        var region = $('#region').val();
		    var municipality = $('#municipality').val();
		    var barangay = $('#barangay').val();
        var email = $('#email').val();
        var donation_date = $('#date').val();
        var contact= $('#contact').val();
	    	var variant= $('#variant').val();
        var note= $('#note').val();
		    var quantity= $('#quantity').val();
        var emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var varnumbers = /^\d+$/;
        var inValid = /\s/;
        var extension = $('#idImg').val().split('.').pop().toLowerCase();
        var form = $('#requestform')[0];
        var fd = new FormData(form);
alert (donation_date)
        return;
        fd.append('ref_id',ref_id);
          fd.append('fname',fname);
          fd.append('municipality',municipality);
          fd.append('barangay',barangay);
          fd.append('province',province);
          fd.append('region',region);
          fd.append('email',email);
          fd.append('date',donation_date);
          fd.append('contact',contact);
          fd.append('note',note);
          fd.append('variant',variant);
          fd.append('quantity',quantity);
          fd.append('category_arr',category_arr);
          fd.append("saveBtn",true);
          fd.append('itemName_arr',itemName_arr);
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
           else if($('#idImg').val()==''){
             Swal.fire('Fields', "Please insert an image",'warning');
             return false;
           }
           else if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1){
             Swal.fire('Image', "Invalid file extension.",'warning');
             $("#requestform").find('[type=file]').val('').trigger('change');
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
            var data = {saveBtn: '',ref_id:ref_id,fname,province:province,region:region,municipality:municipality,barangay:barangay,contact:contact,
			email:email,donation_date:donation_date,variant:variant,quantity:quantity,category_arr:category_arr,itemName_arr:itemName_arr,note:note};
            
      Swal.fire({
            title: 'Confirmation',
            text: "Are sure that all the informations are correct?",
            icon: 'warning',
            showDenyButton: true,
            confirmButtonColor: '#48bf53',
            confirmButtonText: 'Submit',
            denyButtonText: 'Back',
          }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
             url: 'addrequest.php',
              method: 'POST',
               data:fd,
              dataType:'text',
               processData:false,
              contentType:false,  
              success: function(data) {
                if(data == "Success"){
                  $("#requestform")[0].reset();
                  $("#requestform").find('[type=file]').val('').trigger('change');

                  Swal.fire({
                  title: 'Success',
                  text: "Thank you for donating",
                  icon: 'success',
                  confirmButtonColor: '#48bf53',
                  confirmButtonText: 'Continue',
                  allowOutsideClick: false
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href="whatisneeded.php?inserted";
                    }
                  }) 
                } else {
                  Swal.fire('Error', data,'error')
                }
              
            
                 
            }
       });

          } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
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
			swal.fire('Warning', 'Select Province', 'warning');
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
			swal.fire('Warning', 'Select Province', 'warning');
		}
	 });
	
	});
</script>
  </body>
</html>