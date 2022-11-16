<?php 
  include '../Admin/include/connection.php';
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
  
  function fill_variant_select_box($conn){
    $output= '';
    $sql= "SELECT * From variant order by variant_id ASC";
    $result = mysqli_query($conn,$sql);
    foreach($result as $row){
      $output .= '<option value="'.$row['variant_id'].'">'.$row['variant'].'</option>';
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

       <form id="requestform">
        
          <span id="msg" class="text-center"></span>
         
          <div class="row">
            <div class="col">
              <div class="form-group">
            <label for="fname">Fullname</label>
            <input class="form-control" type="text" name="req_fname" id="req_fname" placeholder="">
            </div>
            </div>
            <div class="col">
              <div class="form-group">
            <label for="province">Province</label>
            <input class="form-control" type="text" name="req_province" id="req_province">
            </div>
            </div>
            <div class="col">
              <div class="form-group">
            <label for="street">Street</label>
            <input class="form-control" type="text" name="req_street" id="req_street">
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col">
              <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="text" name="req_email" id="req_email">
            </div>
              </div>
              <div class="col">
              <div class="form-group">
            <label for="donation_date">Donation Date</label>
            <input class="form-control" type="date" name="req_date" id="req_date">
            </div>
            </div> 
            
            </div>	  
            <div class="row">
            <div class="col">
              <div class="form-group">
              <label for="region">Select Region</label>
              <select class="custom-select" name="req_region" id="req_region">
              <option value="default">Choose Region</option>
              <?php 
             
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
           <div class="col">
           <label for="valid_id">Valid Id</label>
            <div class="custom-file">
            <input type="file" name="valid_id" class="custom-file-input valid_id" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
           </div>
            </div>
            <div class="choices">
            <div class="row">
              <div class="col">
                <div class="form-group">
            <label for="category">Select Category</label>
              <select class="custom-select req_category" name="req_category" id="req_category">
              <option value="default">-Select-</option>
             <?php echo fill_category_select_box($conn) ?>
            </select>
            </div>
            </div>
            <div class="col">
              <div class="form-group">
            <label for="variant">Select Variant</label>
              <select class="custom-select req_variant" name="req_variant" id="req_variant">
              <option value="default">-Select-</option>
             <?php echo  fill_variant_select_box($conn)?>
            </select>
            </div>
            </div>
            <div class="col">
              <div class="form-group">
              <label for="quantity">Quantity</label>
              <input class="form-control" type="text" name="req_quantity" id="req_quantity">
              </div>
            </div>
            <div class="form-group">
            <button class="btn btnAdditem" type="button" id="btnAdditem"><i style="color:green;" class="fa-solid fa-plus"></i></button>
            </div>
            </div>
            </div>
          <div class="row">
          <div class="col">
            <div class="form-group">
             <label for="note">Donor's note (Optional)</label>
              <textarea  class="form-control" type="text" name="req_note" id="req_note" placeholder="Donors Note" cols="30" rows="5" ></textarea>
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
    <script src="../donors/js/jQuery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../donors/js/sweetalert2.all.min.js"></script>
    <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>
    <script>
      $(document).ready(function(){
        
        count=0;
        function add_input_field(count){
          $('#testBtn').remove();
          var html='';
          
          html+= '<div class="row"><div class="col"><div class="form-group"><select class="custom-select"><option>-Select-</option><?php echo fill_category_select_box($conn); ?></select></div></div>';
          html+='<div class="col"><div class="form-group"><select class="custom-select"><option>-Select-</option><?php echo fill_variant_select_box($conn) ?></select></div></div>';
          html+='<div class="col"><div class="form-group"></label><input class="form-control"></div></div>';
          var remove_button='';
           if(count>0)
           {
            remove_button='<button type="button" name="remove" id="remove" class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>';
         }
         html+='<span>'+remove_button+'</span></div>';
          return html;
        }
        $('#requestform').append('<button  type="button" style="float: right;width:200px;height:70px; " class="btn btn-success" id="testBtn">Save</button>');
       
        $(document).on('click','#btnAdditem',function(){
          count++;
          $('.choices').append(add_input_field(count));
          $('#requestform').append('<button type="button" style="float: right;width:200px;height:70px; " class="btn btn-success" id="testBtn">Save</button>');
          $('#testBtn').click(function(e){
            e.preventDefault();
           
          });
        });
//remove 
        $(document).on('click','#remove', function(){
          $(this).closest('div').remove();
           });
      });
//main page addbtn
      $(document).on('click', '#testBtn',function(){
        var variant_arr=[];
        var quantity_arr=[];
        var category_arr=[];
        var category = $('.req_category');
        var variant = $('.req_variant');
        var quantity = $('#req_quantity');
        for (var i = 0;i<category.length;i++){
          category_arr.push($(category[i]).val());
          variant_arr.push($(variant[i]).val());
          quantity_arr.push($(quantity[i]).val());
		} alert (category_arr);
      });
    </script>
  </body>
</html>