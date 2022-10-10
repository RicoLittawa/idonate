<!doctype html>
<html lang="en">
  <head>
    <title>Donation</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
   
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/donation.css">
    <link rel="stylesheet" href="css/donors.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>body.modal-open, .modal-open .navbar-fixed-top, .modal-open .navbar-fixed-bottom {
        padding-right: 0px !important;
    }</style>
  </head>
  <body> 
  <div class="navbar navbar-expand-sm bg-light" id="navbar">
  <ul class="nav nav-pills nav-fill">
          <li class="nav-item">
            <a class="nav-link" href="frontpage.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Donations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="howitworks.php">How it works?</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="whatisneeded.php">What is needed?</a>
          </li>
        </ul>
</div>
<div class="container">
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
        <div class = "parag">
          <p>You can set request to inform the staff to<br>
            your arrival and know what kind of donation<br> 
            you will donate. Or You can directly drop off<br>
            your donation to relief hub.</p>
        </div>
        <span><button class="btn btn-success addrequest" type="submit" data-toggle="modal" data-target="request"><i class="fa-solid fa-plus"></i> SET REQUEST</button></span>
        </div>
        
<!-- The Modal -->
<div class="modal fade" id="request">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Set Request</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form action="../Admin/operations/update.php" method="POST">
		<div class="modal-body">
			
	  					<input type="hidden" name="update_id" id="update_id">
	  					<div class="form-group" data-validate = "">
                <label for="fname">Full Name</label>
							<input class="form-control" type="text" name="fname" id="fname" placeholder="*Dela Cruz Juan">
						</div>
						<div class="form-group" data-validate = "">
              <label for="address">Address</label>
							<input class="form-control" type="text" name="address" id="address" placeholder="*Street Address/City">
						</div>
						<div class="form-group" data-validate = "">
              <label for="email">Email</label>
							<input class="form-control" type="text" name="email" id="email" placeholder="*Sample@email.com">
						</div>
						<div class="form-group" data-validate = "">
              <label for="donation_date">Donation Date</label>
							<input class="form-control" type="date" name="donation_date" id="donation_date" placeholder="Date">
						</div>
						<div class="form-group" data-validate = "">
								<label for="category">Select Category:</label>
								<select class="form-control" id="category" name="category">
								<option value="food">Food</option>
								<option value="clothes">Clothes</option>
								<option value="beverages">Beverages</option>
								<option value="others">Others</option>
								</select>
						</div>
						<div class="form-group" data-validate = "">
							<label for="variant">Select Variant:</label>
								<select class="form-control" id="variant" name="variant">
								<option value="Per Box">Per Box</option>
								<option value="Pieces">Pieces</option>
								<option value="Others">Others</option>
								</select>
						</div>
						<div class="form-group" data-validate = "">
              <label for="productName">Product Name</label>
							<input class="form-control" type="text" name="productName" id="productName" placeholder="*Luckyme Pancit Canton/Summit Mineral Water">
						</div>
						<div class="form-group" data-validate = "">
              <label for="quantity">Quantity</label>
							<input class="form-control" type="number" name="quantity" id="quantity" placeholder="*Numeric Value">
						</div>
            <div class="form-group" data-validate = "">
              <textarea  class="form-control" type="text" name="note" id="note" placeholder="Donors Note" cols="30" rows="10"></textarea>
						</div>

       
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="delete btn btn-danger" data-dismiss="modal">Close</button>
		<button type="submit" name="updatedata" class="btn btn-primary">Submit</button>
      </div>
	  
	  </form>	

    </div>
  </div>
</div>

        <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>About</h6>
            <p class="text-justify" style="font-family: 'Lato', sans-serif;">IDONATE</i> is an online platform created for CDRRMO. With the use of the internet, 
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
</footer>
  
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
		$(document).ready(function(){
			$('.addrequest').on('click',function(){
				$('#request').modal('show');


			});


		});
	</script>
  <script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
  </body>
</html>