$(document).ready(function() {
    //Toggle Form for Create Request
    $("#toggleFormBtn").click(function() {
        $("#registerForm").collapse('toggle');
        if ($(this).html().includes('<i class="fas fa-minus"></i> Hide Form')) {
            $(this).html('<i class="fas fa-plus"></i> Show Form');
        } else {
            $(this).html('<i class="fas fa-minus"></i> Hide Form');
        }
        });


    });