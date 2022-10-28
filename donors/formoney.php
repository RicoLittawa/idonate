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
          <a class="nav-link" href="">What is needed?</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="requestform.php">Create request<i style="color: #83f28f;" class="fa-solid fa-plus"></i></a>
        </li>
      </ul>
  
    </div>
  </div>
</nav>

<div class="container" id="container">
 
	<!-- Request Form -->
       <div class="donorForm"> 
       <form id="requestform" class="needs-validation" novalidate method="POST">

          <span id="msg" class="text-center"></span>
          <div class="row">
            <div class="col">
            <label for="fname">Fullname</label>
            <input class="form-control" type="text" name="fname" id="fname" placeholder="" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="col">
            <label for="address">Address</label>
            <input class="form-control" type="text" name="address" id="address" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            </div>	
            <div class="row">
            <div class="col">
            <label for="email">Email</label>
            <input class="form-control" type="text" name="email" id="email" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="col">
            <label for="donation_date">Donation Date</label>
            <input class="form-control" type="date" name="donation_date" id="donation_date" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            </div>
            <div>
            <label for="category">Select Category:</label>
								<select class="custom-select" id="category" name="category" required>
                <option value="" >Choose category</option>
								<option value="food">Food</option>
								<option value="clothes">Clothes</option>
								<option value="beverages">Beverages</option>
								<option value="others">Others</option>
								</select>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div>
            <label for="variant">Select Variant:</label>
								<select class="custom-select" id="variant" name="variant" required>
                <option value="">Choose variant</option>
								<option value="Per Box">Per Box</option>
								<option value="Pieces">Pieces</option>
								<option value="Others">Others</option>
								</select>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please choose an option.</div>
            </div>
          <div class="row">
            <div class="col">
              <label for="productName">Product Name</label>
              <input class="form-control" type="text" name="productName" id="productName" required>
              <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please choose an option.</div>
            </div>
            <div class="col">
              <label for="user-quantity">Quantity</label>
              <input class="form-control" type="text" name="quantity" id="quantity" required>
              <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
            </div>
          </div>
          <div class="note">
             <label for="note">Donor's note</label>
              <textarea  class="form-control" type="text" name="note" id="note" placeholder="Donors Note" cols="30" rows="10" required></textarea>
              <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
						</div>
            <div>
            <button type="submit" class="btn btn-success submit-request" id="submit-request"> Submit</button>
            </div>
            <div id="#summary">

            </div> 			
      </form>
        
      </div>
    
  <div class="send_request"><p>Thank you for<br> donating</p></div>
  <div><a class="backbtn" href="donation.php"><i style="font-size: 50px;" class="fa-solid fa-arrow-left"></i></a><span class="reqdot"></span><span class="reqdot2">   </span></div>
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
    <script src="../donors/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
  </body>
</html>