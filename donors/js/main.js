
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("myNavbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

$(document).ready(function(){
    $(document).on("click","#submit-request",function(){
   
        var fname= $('#fname').val();
        var address= $('#address').val();
        var email= $('#email').val();
        var donation_date= $('#donation_date').val();
        var category= $('#category').val();
        var variant= $('#variant').val();
        var productName= $('#productName').val();
        var quantity= $('#quantity').val();
        var note= $('#note').val();
        if (fname ==""||address ==""||email ==""||donation_date ==""||category ==""||variant ==""||productName ==""||
        quantity ==""||note ==""){
            $('#msg').html("<p class='alert alert-danger'>All fields are required</p>");

        }
        
    
        else{
          $.ajax({
            url: 'addrequest.php',
            method: 'post',
            data:{fname:fname,address:address,email:email,donation_date:donation_date,
                category:category,variant:variant,productName:productName,quantity:quantity,
                note:note},
        
            success: function(data) {
              
              $('#msg').html("<p class='alert alert-success'>Data added</p>");
                }
            });
        }
        
    });
});
 
$(document).ready(function(){
    $('.addrequest').on('click',function(){
        $('#request').modal('show');


    });


});

