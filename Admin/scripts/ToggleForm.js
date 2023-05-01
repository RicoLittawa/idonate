  const toggleForm =(buttonId,formId)=>{
  //Toggle Form for Create Request
  $(buttonId).click(function() {
    $(formId).collapse('toggle');
    if ($(this).html().includes('<i class="fas fa-minus"></i> Hide Form')) {
        $(this).html('<i class="fas fa-plus"></i> Show Form');
    } else {
        $(this).html('<i class="fas fa-minus"></i> Hide Form');
    }
    });
}
toggleForm("#toggleFormBtn","#registerForm")