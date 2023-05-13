  const toggleForm =(buttonId,formId)=>{
  //Toggle Form for Create Request
  $(document).on('click',buttonId,function() {
   
  
    $(formId).collapse('toggle');
    if ($(this).html().includes('<i class="fas fa-minus"></i> Hide Form')) {
        $(this).html('<i class="fas fa-plus"></i> Show Form');
    } else {
        $(this).html('<i class="fas fa-minus"></i> Hide Form');
    }
    $('html, body').animate({
        scrollTop: $('.main-container').offset().top
      }, 500);
    });
        // Scroll to specific part of the page
       
      
}
toggleForm("#toggleFormBtn","#registerForm")
toggleForm("#toggleFormRequestBtn","#createRequest")