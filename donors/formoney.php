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
        <li class="nav-item">
          <a class="nav-link active" href="requestform.php">Create request<i style="color: #83f28f;" class="fa-solid fa-plus"></i></a>
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
    <form id="monetaryform" method="POST" enctype="multipart/form-data">
       <span id="msg" class="text-center"></span>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="money_name">Fullname</label>
                <input class="form-control" type="text" name="money_name" id="money_name" placeholder="">
                </div>
              </div>
            <div class="col">
              <div class="form-group">
                <label for="money_province">City</label>
                <input class="form-control" type="text" name="money_province" id="money_province">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="money_street">Street</label>
                <input class="form-control" type="text" name="money_street" id="money_street">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="money_region">Select Region</label>
                  <select class="custom-select" name="money_region" id="money_region">
                    <option value="default">Choose Region</option>
                      <?php 
                        include '../Admin/include/connection.php';
                        $sql = "SELECT * FROM regions";
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
               <div class="form-group">
                  <label for="money_contact">Contact Number</label>
                  <input class="form-control" type="text" name="money_contact" id="money_contact">
                </div>
						  </div>
            </div>	  
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="money_email">Email</label>
                  <input class="form-control" type="text" name="money_email" id="money_email">
                  </div>
                </div>
              <div class="col">
                <div class="form-group">
                  <label for="money_date">Donation Date</label>
                  <input class="form-control" type="date" name="money_date" id="money_date">
                  </div>
                </div>
              </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="money_reference">Reference number</label>
                  <input class="form-control" type="text" id="money_reference" name="money_reference">
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
                <input class="form-control" type="text" name="money_amount" id="money_amount">
              </div>
            </div>
          </div>
          <div class="note">
            <div class="form-group">
              <label for="money_note">Donor's note (Optional)</label>
              <textarea  class="form-control" type="text" name="money_note" id="money_note" placeholder="Donors Note" cols="30" rows="10" ></textarea>
                </div>
						  </div>
            <div>
              <button type="submit" class="btn btn-success monetary">Submit</button>
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
    <script src="../donors/js/jQuery.js"></script>
    <script src="../donors/js/main.js"></script>
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
  </body>
</html>