<?php 
session_start()?>
<!doctype html>
<html lang="en">
  <head>
    <title>Donation</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/donation.css">
    <link rel="stylesheet" href="css/donors.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>body.modal-open, .modal-open .navbar-fixed-top, .modal-open .navbar-fixed-bottom {
        padding-right: 0px !important;
    }</style>
    
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
          <a class="nav-link active" href="donation.php">Donations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="howitworks.php">How it works?</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="whatisneeded.php">What is needed?</a>
        </li>
        <li class="nav-item dropdown">
		   <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">  Fill Up  </a>
		    <ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="requestform.php">Request Form</a></li>
			  <li><a class="dropdown-item" href="formoney.php">Money Donor Forms</a></li>
			 
		    </ul>
		</li>


  </ul>
    </div>
  </div>
</nav>

<div class="container" id="container">
  <div class="circles">
        <div class="dot" >
           <div class="photos">
            <img class="photo1" src="img/water.png" alt=""> 
            <img class="photo2" src="img/money.png" alt="">
            <img class="photo3" src="img/food.png" alt="">
            <img class="photo4" src="img/clothes.png" alt="">
            </div>
          <div class="dashedcircle"></div>
      </div>
        <span class="dot2"></span>
          <h1 class="title">You want to<br></h1>
          <h2 class="con">Donate?</h2>
        </div>
        <div class="parag">
          <p class="text-justify">You can set <a style="font-weight:bold ;" href="requestform.php">request</a> to inform the staff to
            your arrival and know what kind of donation
            you will donate. Or You can directly drop off
            your donation to relief hub. If you donated money kind inform us by
          filling up the <a style="font-weight:bold ;" href="formoney.php">form</a> with transaction/reference number and screen shot
        of the reciept to recive acknowledgement certificate.</p>
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
    <script src="js/jQuery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
 
  </body>
</html>