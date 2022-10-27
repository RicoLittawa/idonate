$(document).ready(function(){
    $('.adddata').on('click',function(){
        $('#add').modal('show');

    });
});


$(document).ready(function(){
    $(document).on('click',"#submit-donations",function(event){
        event.preventDefault();
        var fname= $('#fname').val();
        var address= $('#address').val();
        var email= $('#email').val();
        var donation_date= $('#donation_date').val();
        var category= $('#category').val();
        var variant= $('#variant').val();
        var productName= $('#productName').val();
        var quantity= $('#quantity').val();
        
        if (fname ==""||address ==""||email ==""||donation_date ==""||category ==""||variant ==""||productName ==""||
        quantity ==""){
            $('#msg').html("<p class='alert alert-danger'>Please fill up all the fields</p>");}
      
        else{
            $.ajax({
                url: 'http://localhost:3000/Admin/include/add.inc.php',
                        method: 'post',
                        data:{fname:fname,address:address,email:email,donation_date:donation_date,
                            category:category,variant:variant,productName:productName,quantity:quantity},   
                        success: function(data) {
                          if (data =='ok'){
                            console.log("success");
                            $('#add').modal('hide');
                          
                            Swal.fire('Saved!', '', 'success');
                            $('#validate-form').each(function(){
                                this.reset();
                                location.reload();
                            });
                           
                          }
                          else{
                            console.log("error");
                    }
               }
            });
        }
    });
});

//delete
$('.btnDel').on('click',function(e){
    e.preventDefault();
    const href=$(this).attr('href');
                Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.value) {
            document.location.href=href;
        }
        });
});			

