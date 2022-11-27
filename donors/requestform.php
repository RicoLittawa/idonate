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
             
    $sql = "SELECT * from regions ";
    $result = mysqli_query($conn,$sql);
    foreach($result as $row){
      $output .= '<option value="'.$row['region_id'].'">'.$row['region_name'].'</option>';
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
        <li class="nav-item">
          <a class="nav-link active" href="requestform.php">Request Form<i style="color: #83f28f;" class="fa-solid fa-plus"></i></a>
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
            <input class="form-control border-success" type="text" name="req_fname" id="req_fname" placeholder="">
            </div>
            </div>
            <div class="col">
              <div class="form-group">
            <label for="province">Province</label>
            <input class="form-control border-success" type="text" name="req_province" id="req_province">
            </div>
            </div>
            <div class="col">
              <div class="form-group">
            <label for="street">Street</label>
            <input class="form-control border-success" type="text" name="req_street" id="req_street">
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col">
              <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control border-success" type="text" name="req_email" id="req_email">
            </div>
              </div>
              <div class="col">
              <div class="form-group">
            <label for="donation_date">Donation Date</label>
            <input class="form-control border-success" type="date" name="req_date" id="req_date">
            </div>
            </div> 
            <div class="col">
              <div class="form-group">
            <label for="contact">Contact No.</label>
            <input class="form-control border-success" type="text" name="req_contact" id="req_contact">
            </div>
            </div>	  
            </div>
            <div class="row">
            <div class="col">
              <div class="form-group">
              <label for="region">Select Region</label>
              <select class="custom-select border-success" name="req_region" id="req_region">
              <option value="-Select-">-Select-</option>
              <?php echo fill_region_select_box($conn) ?>             
            </select>
            </div>
						</div>
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
              <textarea style="display:center ;" class="form-control border-success" type="text" name="req_note" id="req_note" placeholder="Donors Note" cols="80" rows="5" ></textarea>
              </div>
						</div>
          </div>
          <div class="row">
              <div class="col">
                <div class="form-group">
                <label class="form-group" style="font-weight: bold;">Donation Types & Quantity</label>  
            <button style="float: right;" class="btn btnAdditem" type="button" id="btnAdditem"><i style="color:green;font-size:40px;" class="fa-solid fa-plus"></i></button>
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
        count=0;
        function add_input_field(count){
          $('#testBtn').remove();
          var html='';
          html+='<div>'
          html+= '<div class="row"><div class="col"><div class="form-group"><label>Select Category</label><select class="custom-select req_category border-success"><option value="-Select-">-Select-</option><?php echo fill_category_select_box($conn); ?></select></div></div>';
          html += '<div class="col"><div class="form-group"><label>Name of items</label><input class="form-control border-success name_items" id="name_items" name="name_items"></div></div></div>'
          html+='<div class="row"><div class="col"><div class="form-group"><label>Quantity</label><input class="form-control req_quantity border-success"></div></div></div>';
          
          var remove_button='';
           if(count>0)
           {
            remove_button='<button type="button" name="remove" id="remove" class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>';
         }
         html+='<span>'+remove_button+'</span></div>';
          return html;
        }
        $('#requestform').append(add_input_field(count[0]))
        $('#requestform').append('<button  type="button"  class="btn btn-success reqbtn" id="testBtn">Submit</button>');
     
        $(document).on('click','#btnAdditem',function(){
          count++;
          $('#requestform').append(add_input_field(count))
          $('#requestform').append('<button type="button" class="btn btn-success reqbtn" id="testBtn">Submit</button>');
          $('#testBtn').click(function(e){
            var valid = this.form.checkValidity();
        if(valid) {
          e.preventDefault();
        var quantity_arr=[];
        var category_arr=[];
				var itemName_arr=[];
			
        var category = $('.req_category');
        var quantity = $('.req_quantity');
        var item_names=$('.name_items');
        
        for (var i = 0;i<category.length;i++){
          category_arr.push($(category[i]).val());
          quantity_arr.push($(quantity[i]).val());
          itemName_arr.push($(item_names[i]).val());
		      }     
          var form = $('#requestform')[0];
          
          var fd = new FormData(form);
          var ref_id = $('#ref_id').val();
          
          var req_fname = $('#req_fname').val();
          var req_province = $('#req_province').val();
          var req_street = $('#req_street').val();
          var req_region = $('#req_region').val();
          var req_email = $('#req_email').val();
          var req_donation_date = $('#req_date').val();
          var req_contact = $('#req_contact').val();
          var req_note= $('#req_note').val();
         
        

          fd.append('ref_id',ref_id);
          fd.append('req_fname',req_fname);
          fd.append('req_street',req_street);
          fd.append('req_province',req_province);
          fd.append('req_region',req_region);
          fd.append('req_email',req_email);
          fd.append('req_date',req_donation_date);
          fd.append('req_contact',req_contact);
          fd.append('req_note',req_note);
          fd.append('category_arr',category_arr);
          fd.append('quantity_arr',quantity_arr);
          fd.append('itemName_arr',itemName_arr);


         
          fd.append("saveBtn",true);
          var extension = $('#idImg').val().split('.').pop().toLowerCase();
          var emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          var varnumbers = /^\d+$/;
          var inValid = /\s/;
         
         
          
        //   for ( var pair of fd.entries()){
        //     console.log(pair[0]+','+pair[1]);
        //   }
        //  return;
       if(req_fname==""){
             $('#req_fname').removeClass('border-success');
             $('#req_fname').addClass('border-danger');
             return false;
       }
       else if(req_province==""){
             $('#req_province').removeClass('border-success');
             $('#req_province').addClass('border-danger');
             return false;
       }
       else if(req_street==""){
             $('#req_street').removeClass('border-success');
             $('#req_street').addClass('border-danger');
             return false;
       }
       else if(req_email==""){
             $('#req_email').removeClass('border-success');
             $('#req_email').addClass('border-danger');
             return false;
       }
       else if(emailVali.test($('#req_email').val())==false){
         Swal.fire('Email', "Invalid email address",'warning'); 
             $('#req_email').removeClass('border-success');
             $('#req_email').addClass('border-danger');
             return false;
       }
       else if(req_date==""){
         Swal.fire('Fields', "Please select a date",'warning');
             return false;
       }
       else if(req_contact==""){
             $('#req_contact').removeClass('border-success');
             $('#req_contact').addClass('border-danger');
             return false;
       }
       else if (inValid.test($('#req_contact').val())==true){
             Swal.fire('Contact', "Whitespace is prohibited.",'warning');
             $('#req_contact').removeClass('border-success');
             $('#req_contact').addClass('border-danger');
             return false;
           }
           else if(varnumbers.test($('#req_contact').val())==false) {
             Swal.fire('Number', "Numbers only.",'warning');
             $('#req_contact').removeClass('border-success');
             $('#req_contact').addClass('border-danger');
             return false;
           } 
           else if(req_contact.length !=11){
             Swal.fire('Contact', "Enter Valid Contact Number",'warning'); 
             $('#req_contact').removeClass('border-success');
             $('#req_contact').addClass('border-danger');
             return false;
           }
           else if(req_region==""){
             Swal.fire('Select', "Please select a region",'warning');
             return false;
           }
           else if($('#idImg').val()==''){
             Swal.fire('Fields', "Please insert an image",'warning');
           }
           else if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1){
             Swal.fire('Image', "Invalid file extension.",'warning');
             $("#requestform").find('[type=file]').val('').trigger('change');
             return false;
           }
           else{
             for (var j=0;j<category.length;j++){
                 if ($(category[j]).val()=="-Select-"){
                   Swal.fire('Select', "Please select a category",'warning');
                   return false;
                 }
                 else if ($(name_items[j]).val()==""){
                  Swal.fire('Fields', "Item name is empty",'warning');
                  return false;
                }
                 else if($(quantity[j]).val()==""){
                   Swal.fire('Select', "Quantity is empty",'warning');
                   return false;
                 }
                 else if (inValid.test($(quantity[j]).val())==true){	
                   Swal.fire('Quantity', "Whitespace is prohibited.",'warning');
                   return false;
                 }
                 else if(varnumbers.test($(quantity[j]).val())==false) {
                   Swal.fire('Number', "Numbers only.",'warning');
                   return false;			
                 }
             }
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
          $('#req_fname').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#req_province').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#req_street').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#req_email').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#req_date').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#req_contact').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
          
        });
        
//remove 
        $(document).on('click','#remove', function(){
          $(this).closest('div').remove();
           });
           //main page addbtn
      $('#testBtn').click(function(e){
        e.preventDefault();
        var valid = this.form.checkValidity();
        if(valid) {
        e.preventDefault();
        var quantity_arr=[];
        var category_arr=[];
				var itemName_arr=[];
			
        var category = $('.req_category');
        var quantity = $('.req_quantity');
        var item_names=$('.name_items');
        
        for (var i = 0;i<category.length;i++){
          category_arr.push($(category[i]).val());
          quantity_arr.push($(quantity[i]).val());
          itemName_arr.push($(item_names[i]).val());
		      }     
          var form = $('#requestform')[0];
          
          var fd = new FormData(form);
          var ref_id = $('#ref_id').val();
          
          var req_fname = $('#req_fname').val();
          var req_province = $('#req_province').val();
          var req_street = $('#req_street').val();
          var req_region = $('#req_region').val();
          var req_email = $('#req_email').val();
          var req_donation_date = $('#req_date').val();
          var req_contact = $('#req_contact').val();
          var req_note= $('#req_note').val();
          
          

          fd.append('ref_id',ref_id);
          fd.append('req_fname',req_fname);
          fd.append('req_street',req_street);
          fd.append('req_province',req_province);
          fd.append('req_region',req_region);
          fd.append('req_email',req_email);
          fd.append('req_date',req_donation_date);
          fd.append('req_contact',req_contact);
          fd.append('req_note',req_note);
          fd.append('category_arr',category_arr);
          fd.append('quantity_arr',quantity_arr);
          fd.append('itemName_arr',itemName_arr);


         
          fd.append("saveBtn",true);
          var extension = $('#idImg').val().split('.').pop().toLowerCase();
          var emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          var varnumbers = /^\d+$/;
          var inValid = /\s/;
         
         
          
        //   for ( var pair of fd.entries()){
        //     console.log(pair[0]+','+pair[1]);
        //   }
        //  return;
       if(req_fname==""){
             $('#req_fname').removeClass('border-success');
             $('#req_fname').addClass('border-danger');
             return false;
       }
       else if(req_province==""){
             $('#req_province').removeClass('border-success');
             $('#req_province').addClass('border-danger');
             return false;
       }
       else if(req_street==""){
             $('#req_street').removeClass('border-success');
             $('#req_street').addClass('border-danger');
             return false;
       }
       else if(req_email==""){
             $('#req_email').removeClass('border-success');
             $('#req_email').addClass('border-danger');
             return false;
       }
       else if(emailVali.test($('#req_email').val())==false){
         Swal.fire('Email', "Invalid email address",'warning'); 
             $('#req_email').removeClass('border-success');
             $('#req_email').addClass('border-danger');
             return false;
       }
       else if(req_date==""){
         Swal.fire('Fields', "Please select a date",'warning');
             return false;
       }
       else if(req_contact==""){
             $('#req_contact').removeClass('border-success');
             $('#req_contact').addClass('border-danger');
             return false;
       }
       else if (inValid.test($('#req_contact').val())==true){
             Swal.fire('Contact', "Whitespace is prohibited.",'warning');
             $('#req_contact').removeClass('border-success');
             $('#req_contact').addClass('border-danger');
             return false;
           }
           else if(varnumbers.test($('#req_contact').val())==false) {
             Swal.fire('Number', "Numbers only.",'warning');
             $('#req_contact').removeClass('border-success');
             $('#req_contact').addClass('border-danger');
             return false;
           } 
           else if(req_contact.length !=11){
             Swal.fire('Contact', "Enter Valid Contact Number",'warning'); 
             $('#req_contact').removeClass('border-success');
             $('#req_contact').addClass('border-danger');
             return false;
           }
           else if(req_region==""){
             Swal.fire('Select', "Please select a region",'warning');
             return false;
           }
           else if($('#idImg').val()==''){
             Swal.fire('Fields', "Please insert an image",'warning');
           }
           else if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1){
             Swal.fire('Image', "Invalid file extension.",'warning');
             $("#requestform").find('[type=file]').val('').trigger('change');
             return false;
           }
           else{
             for (var j=0;j<category.length;j++){
                 if ($(category[j]).val()=="-Select-"){
                   Swal.fire('Select', "Please select a category",'warning');
                   return false;
                 }
                 else if ($(name_items[j]).val()==""){
                  Swal.fire('Fields', "Item name is empty",'warning');
                  return false;
                }
                 else if($(quantity[j]).val()==""){
                   Swal.fire('Select', "Quantity is empty",'warning');
                   return false;
                 }
                 else if (inValid.test($(quantity[j]).val())==true){	
                   Swal.fire('Quantity', "Whitespace is prohibited.",'warning');
                   return false;
                 }
                 else if(varnumbers.test($(quantity[j]).val())==false) {
                   Swal.fire('Number', "Numbers only.",'warning');
                   return false;			
                 }
             }
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
      $('#req_fname').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#req_province').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#req_street').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#req_email').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#req_date').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#req_contact').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      });

    </script>
  </body>
</html>