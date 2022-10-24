
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
        console.log("working")
    })
})
 
$(document).ready(function(){
    $('.addrequest').on('click',function(){
        $('#request').modal('show');


    });


});
