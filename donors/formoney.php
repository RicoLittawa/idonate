<?php  
require_once 'include/connection.php';

function fill_region_select_box($conn){
  $output='';
           
  $sql = "SELECT * from refregion ";
  $result = mysqli_query($conn,$sql);
  foreach($result as $row){
    $output .= '<option value="'.$row['regCode'].'">'.$row['regDesc'].'</option>';
  }
  return $output;
  

}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Money</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/money.css">
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
  <p class="paragleft">Thank you for <br>donating</p>
</div>
<div class="container" id="container">
 <!-- Request Form -->
  <div class="moneyForm"> 
    <form id="monetaryform" enctype="multipart/form-data">
       <span id="msg" class="text-center"></span>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="money_name">Fullname</label>
                <input class="form-control border-success" type="text" name="money_name" id="money_name" placeholder="">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="money_region">Select Region</label>
                  <select class="custom-select border-success" name="money_region" id="money_region">
                    <option value="">-Select-</option>
                    <?php echo htmlspecialchars_decode( Fill_region_select_box($conn) );?>
                   </select>
                  </div>
						    </div>
                <div class="col">
				          <div class="form-group">
                    <label for="money_province">Province</label>
                    <select class="custom-select border-success" name="money_province" id="money_province">
				            </select>
				          </div>
			          </div>
                <div class="col">
				          <div class="form-group">
                    <label for="money_municipality">Municipality</label>
                    <select class="custom-select border-success" name="money_municipality" id="money_municipality">
				            </select>
				          </div>
			          </div>
              </div>
            <div class="row">
            <div class="col">
				          <div class="form-group">
                    <label for="money_barangay">Barangay</label>
                    <select class="custom-select border-success" name="money_barangay" id="money_barangay">
				            </select>
				          </div>
			          </div>
              <div class="col">
               <div class="form-group">
                  <label for="money_contact">Contact Number</label>
                  <input class="form-control border-success" type="text" name="money_contact" id="money_contact">
                </div>
						  </div>
            </div>	  
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="money_email">Email</label>
                  <input class="form-control border-success" type="text" name="money_email" id="money_email">
                  </div>
                </div>
              <div class="col">
                <div class="form-group">
                  <label for="money_date">Donation Date</label>
                  <input class="form-control border-success" type="date" name="money_date" id="money_date">
                  </div>
                </div>
              </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="money_reference">Reference number</label>
                  <input class="form-control border-success" type="text" id="money_reference" name="money_reference">
                </div>
              </div>
            </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <spa>*Screen shot of receipt/reference number</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label class="custom-file-label" for="customFile">Choose file</label>
                <input type="file" class="custom-file-input" id="money_image" name="money_image">
             </div>
            </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="money_amount">Amount</label>
                <input class="form-control border-success" type="text" name="money_amount" id="money_amount">
              </div>
            </div>
          </div>
          <div class="note">
            <div class="form-group">
              <label for="money_note">Donor's note (Optional)</label>
              <textarea  class="form-control border-success" type="text" name="money_note" id="money_note" placeholder="Donors Note" cols="30" rows="10" ></textarea>
                </div>
						  </div>
            <div>
              <button type="button" id="submitBtn" class="btn btn-success monetary">Submit</button>
            </div>
          	
          </form>
        </div>
        
     </div>
    
<!---Footer --->
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
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

<script>
  /*Add monetary */
$(document).ready(function(){
  $("#submitBtn").click(function(event){
      event.preventDefault();
      var valid = this.form.checkValidity();
        if(valid) {
          var money_name = $('#money_name').val();
          var money_province = $('#money_province').val();
          var money_municipality = $('#money_municipality').val();
          var money_barangay = $('#money_barangay').val();
          var money_region = $('#money_region').val();
          var money_contact = $('#money_contact').val();
          var money_email = $('#money_email').val();
          var money_date = $('#money_date').val();
          var money_reference = $('#money_reference').val();
          var money_amount = $('#money_amount').val();
          var money_note = $('#money_note').val();
          

      
          var form = $('#monetaryform')[0];
          var fd = new FormData(form);
          var extension = $('#money_image').val().split('.').pop().toLowerCase();
          var emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          var varnumbers = /^\d+$/;
          var inValid = /\s/;
          
          fd.append("monetary_data",true); 
          fd.append("money_name",money_name); 
          fd.append("money_province",money_province); 
          fd.append("money_municipality",money_municipality); 
          fd.append("money_barangay",money_barangay); 
          fd.append("money_region",money_region); 
          fd.append("money_contact",money_contact); 
          fd.append("money_email",money_email); 
          fd.append("money_date",money_date); 
          fd.append("money_reference",money_reference);
          fd.append("money_amount",money_amount); 
          fd.append("money_note",money_note); 

        
          // if (money_name==""){
          //   $('#money_name').removeClass('border-success');
          //   $('#money_name').addClass('border-danger');
          //   return false;
          // }
          // else if(money_province==""){
          //   $('#money_province').removeClass('border-success');
          //   $('#money_province').addClass('border-danger');
          //   return false;
          // }
          // else if(money_street==""){
          //   $('#money_street').removeClass('border-success');
          //   $('#money_street').addClass('border-danger');
          //   return false;
          // }
          // else if(money_region==""){
          //   Swal.fire('Select', "Please select an option",'warning');
          //   return false;
          // }
          // else if(money_contact==""){
          //   $('#money_contact').removeClass('border-success');
          //   $('#money_contact').addClass('border-danger');
          //   return false;
          // }
          // else if (inValid.test($('#money_contact').val())==true){
          //   Swal.fire('Contact', "Whitespace is prohibited.",'warning');
          //   $('#money_contact').removeClass('border-success');
          //   $('#money_contact').addClass('border-danger');
          //   return false;
          // }
          // else if(varnumbers.test($('#money_contact').val())==false) {
          //   Swal.fire('Number', "Numbers only.",'warning');
          //   $('#money_contact').removeClass('border-success');
          //   $('#money_contact').addClass('border-danger');
          //   return false;
          // } 
          // else if(money_contact.length !=11){
          //   Swal.fire('Contact', "Enter Valid Contact Number",'warning'); 
          //   $('#money_contact').removeClass('border-success');
          //   $('#money_contact').addClass('border-danger');
          //   return false;
          // }
          // else if (money_email==""){
          //   $('#money_email').removeClass('border-success');
          //   $('#money_email').addClass('border-danger');
          // }
          // else if(emailVali.test($('#money_email').val())==false){
          //   Swal.fire('Email', "Invalid email address",'warning'); 
          //   $('#money_email').removeClass('border-success');
          //   $('#money_email').addClass('border-danger');
          //   return false;
          // }
          // else if (money_date==""){
          //   $('#money_date').removeClass('border-success');
          //   $('#money_date').addClass('border-danger');
          // }
          // else if(money_reference==""){
          //   $('#money_reference').removeClass('border-success');
          //   $('#money_reference').addClass('border-danger');
          // }
          // else if (inValid.test($('#money_reference').val())==true){
          //   Swal.fire('Reference', "Whitespace is prohibited.",'warning');
          //   $('#money_reference').removeClass('border-success');
          //   $('#money_reference').addClass('border-danger');
          //   return false;
          // }
          // else if(varnumbers.test($('#money_reference').val())==false) {
          //   Swal.fire('Number', "Numbers only.",'warning');
          //   $('#money_reference').removeClass('border-success');
          //   $('#money_reference').addClass('border-danger');
          //   return false;
          // } 
         
          // else if($('#money_image').val()==''){
          //   Swal.fire('Fields', "Please insert an image",'warning');
          // }
          // else if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1) {
          //   Swal.fire('Image', "Invalid file extension.",'warning');
          //   $("#monetaryform").find('[type=file]').val('').trigger('change');
          //   return false;
          // } 
          // else if(money_amount==""){
          //   $('#money_amount').removeClass('border-success');
          //   $('#money_amount').addClass('border-danger');
          // }
          // else if (inValid.test($('#money_amount').val())==true){
          //   Swal.fire('Amount', "Whitespace is prohibited.",'warning');
          //   $('#money_amount').removeClass('border-success');
          //   $('#money_amount').addClass('border-danger');
          //   return false;
          // }
          // else if(varnumbers.test($('#money_amount').val())==false) {
          //   Swal.fire('Number', "Numbers only.",'warning');
          //   $('#money_amount').removeClass('border-success');
          //   $('#money_amount').addClass('border-danger');
          //   return false;
          // }
          
            
          // else {
            Swal.fire({
            title: 'Confirmation',
            text: "Are sure that all the informations are correct?",
            icon: 'warning',
            showDenyButton: true,
            confirmButtonColor: '#48bf53',
            confirmButtonText: 'Send',
            denyButtonText: `Back`,
          }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
             url: 'monetary.php',
              method: 'POST',
               data:fd,
              dataType:'text',
               processData:false,
              contentType:false,  
              success: function(data) {
                if(data == "Success"){
                  $("#monetaryform")[0].reset();
                  $("#monetaryform").find('[type=file]').val('').trigger('change');

                  Swal.fire({
                  title: data,
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
        })
       

            
           
      
        // }
         }    
  });

  $('#money_name').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#money_province').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#money_street').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#money_contact').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#money_email').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#money_date').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#money_reference').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
      $('#money_amount').on('keyup', function() {
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

<script>
  $(document).ready(function(){
	 $('#money_region').on('change',function(){
		var regCode= $(this).val();
		if (regCode){
			$.ajax({
				url:'include/region.php',
				type:'POST',
				data: 'regCode='+regCode,
				success: function (data){
					$('#money_province').html(data);
				}

			});
		}
		else{
			swal.fire('Warning', 'Select region', 'warning');
		}
	 });
	 $('#money_province').on('change',function(){
		var provCode= $(this).val();
		if (provCode){
			$.ajax({
				url:'include/region.php',
				type:'POST',
				data: 'provCode='+provCode,
				success: function (data){
					$('#money_municipality').html(data);
				}

			});
		}
		else{
			swal.fire('Warning', 'Select province', 'warning');
		}
	 });
	 $('#money_municipality').on('change',function(){
		var citymunCode= $(this).val();
		if (citymunCode){
			$.ajax({
				url:'include/region.php',
				type:'POST',
				data: 'citymunCode='+citymunCode,
				success: function (data){
					$('#money_barangay').html(data);
				}

			});
		}
		else{
			swal.fire('Warning', 'Select municipality', 'warning');
		}
	 });
	
	});
</script>
  </body>
</html>