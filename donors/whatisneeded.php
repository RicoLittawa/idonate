<!doctype html>
<html lang="en">
  <head>
    <title>frontpage</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/donors.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/frontpage.css">

  </head>
  <body>
  <nav class="navbar bg-light" id="myNavbar">
  <div class="container-fluid">
    
    <div>
    <ul class="nav nav-pills nav-fill">
        
        <li class="nav-item">
          <a class="nav-link" href="frontpage.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="donation.php">Donations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="howitworks.php">How it works?</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="whatisneeded.php">What is needed?</a>
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

<div class="container-fluid">
  <span class="dot">   
    </span>
  <div class="reports">
  <div class="box-info4">
      <p class="whatneeded">What is needed?</p>
       <marquee class="scrolling" style="color: red ;font-size:35px; font-weight:bold;"  width="100%" direction="left" height="100px">
     
     <?php 
   include 'include/connection.php';
   $sql= "SELECT * from announcement_template";
   $result= mysqli_query($conn,$sql);
   foreach ($result as $row){
     echo "<i class='fa-sharp fa-solid fa-bullhorn'></i>".  $row['announcement'];
   }
   ?>
   </marquee>
    </div>
  <div class="box-info">
     <div class="container">
      <div class="powerbi">
     <iframe title="donorside - Page 1" width="775" height="480" src="https://app.powerbi.com/view?r=eyJrIjoiNTc2ZWI4NmMtYTQxNC00MmUyLWExN2MtNzk3ZTI4MWY2ZmEyIiwidCI6IjYxMTExODkxLTNkYzgtNDVmZi1hZjcwLWZjMGFmM2NjYjBmOCIsImMiOjEwfQ%3D%3D" frameborder="0" allowFullScreen="true"></iframe>
     </div> 
     </div>

    </div>
    <div class="box-info2">
  
    </div>
    <div class="box-info3">
      <?php
      
      $sql="SELECT count('1') from total_donor";
			 $result=mysqli_query($conn,$sql);
			 $row=mysqli_fetch_array($result);
			 echo "<h3 style=font-size:45px>$row[0]</h3>";?>

    </div>
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
  
  </body>
</html>