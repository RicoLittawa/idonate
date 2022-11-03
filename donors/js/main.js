
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


$(document).ready(function(){
  $("#requestform").submit(function(event){
      event.preventDefault();
      
      var formData= new FormData(this);
      formData.append("request_data",true);
      Swal.fire({  
        title: 'Do you want to send this request?',  
        showDenyButton: true,  showCancelButton: true,  
        confirmButtonText: `Send`,  
        denyButtonText: `Go back`,
      }).then((result) => {  
        /* Read more about isConfirmed, isDenied below */  
          if (result.isConfirmed) {    
            $.ajax({
              url: 'addrequest.php',
              method: 'post',
              data:formData,
                      processData:false,
                      contentType:false,  
                      success: function(response) {
                      
                       
                          var res= jQuery.parseJSON(response);
                          /* empty fields */
                          if(res.status == 422)
                          {
                            Swal.fire('Error!', '', 'error')  
                            $('#msg').html("<p class='alert alert-danger'>"+ res.message); 
                          
                           
                          
                          }
                         
                          else if (res.status == 200)
                          {
                            Swal.fire('Saved!', '', 'success')  
                           
                            $('#requestform')[0].reset();
                            $('.required').removeClass('blank');
                            $('#requestform').load(location.href+ " #requestform")
                          }      
                      }
          });
            
          
          } else if (result.isDenied) {    
            Swal.fire('Request has not been sent', '', 'info')  
         }
      });
      
     
     
  });
});


