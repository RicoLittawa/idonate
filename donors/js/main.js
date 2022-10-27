
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
            $('#msg').html("<p class='alert alert-danger'>Please fill up all the fields</p>");

        }
        else{
            Swal.fire({
                title: 'Do you want to save the changes?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`,
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'addrequest.php',
                        method: 'post',
                        data:{fname:fname,address:address,email:email,donation_date:donation_date,
                            category:category,variant:variant,productName:productName,quantity:quantity,
                            note:note},
                        success: function(data) {
                            $('#request').modal('hide');
            
                            console.log("success");
                            Swal.fire('Saved!', '', 'success');
                            $('#requestform').each(function(){
                                this.reset();
                            })
                            }
                        });
                } else if (result.isDenied) {
                  Swal.fire('Changes are not saved', '', 'info')
                }
              })
        }
    });
});
 
$(document).ready(function(){
    $('.addrequest').on('click',function(){
        $('#request').modal('show');


    });


});

