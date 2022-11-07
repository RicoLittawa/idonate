/*open add modal*/
$(document).ready(function(){
    $('.adddata').on('click',function(){
        $('#add').modal('show');

    });
});

/*add data */
$(document).ready(function(){
    $("#add-form").submit(function(event){
        event.preventDefault();
        var formData= new FormData(this);
        formData.append("save_data",true)
       
        
        
            $.ajax({
                url: 'http://localhost:3000/Admin/include/add.inc.php',
                method: 'post',
                data:formData,
                        processData:false,
                        contentType:false,  
                        
                        success: function(response) {
                            var res= jQuery.parseJSON(response);
                            if(res.status == 422)
                            {
                                Swal.fire('ERROR','','error')
                            $('#msg').html("<p class='alert alert-danger'>"+ res.message); 
                            
                            
                            }else if (res.status == 200)
                            {
                                Swal.fire(
                                    'Success!',
                                    res.message,
                                    'success'
                                  )
                                $('#add').modal('hide');
                                $('#add-form')[0].reset();
                                $('#table_data').load(location.href+ " #table_data");
                               
                            }
                           
                            
                            
                        }
            });
        
    });
});

/*delete data */
$(document).on('click', '.btnDel', function (e) {
    e.preventDefault();
    var id = $(this).val();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "http://localhost:3000/Admin/operations/delete.php",
                data: {
                    'delete_data': true,
                    'id': id
                },
                success: function (response) {
    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 500) {
                        Swal.fire(
                            'Not Deleted',
                           res.message,
                            'error'
                          )
    
                      
                    }else{
                     
                        Swal.fire(
                            'Deleted!',
                           res.message,
                            'success'
                          )
    
                        $('#table_data').load(location.href + " #table_data");
                    }
                }
            });
        
        }
      });
});
/*request page view data */
$(document).on('click', '.viewBtn', function (e) {
    e.preventDefault();
    var request_id = $(this).val();
    $.ajax({
        type: "GET",
        url: "operations/view.php?request_id="+ request_id,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
               $('#recieveReq').modal('show');
               $('#req_name').val(res.data.req_name);
               $('#req_province').val(res.data.req_province);
               $('#req_street').val(res.data.req_street);
               $('#req_region').val(res.data.req_region);
               $('#req_email').val(res.data.req_email);
               $('#req_date').val(res.data.req_date);
               $('#req_category').val(res.data.req_category);
               $('#req_variant').val(res.data.req_variant);
               $('#req_quantity').val(res.data.req_quantity);
               $('#req_note').text(res.data.req_note);

               
            }else if(res.status == 404){
                alert(res.message);
            }
        }
    });
});

/*fetch data to update*/
$(document).on('click', '.btnUpdate', function (e) {
    e.preventDefault();
    
    var donor_id = $(this).val();
    $.ajax({
        type: "GET",
        url: "http://localhost:3000/Admin/operations/updateData.php?donor_id="+ donor_id,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 200) {
                $('#donor_id').val(res.data.donor_id);
                $('#donor_name').val(res.data.donor_name);
                $('#donor_province').val(res.data.donor_province);
                $('#donor_street').val(res.data.donor_street);
                $('#donor_region').val(res.data.donor_region);
                $('#donor_email').val(res.data.donor_email);
                $('#donationDate').val(res.data.donationDate);
                $('#donation_category').val(res.data.donation_category);
                $('#donation_variant').val(res.data.donation_variant);
                $('#donation_quantity').val(res.data.donation_quantity);
                $('#updateModal').modal('show');
                

               console.log(res.message);
            }else if(res.status == 422){
                alert(res.message);
            }
        }
    });

   
});

/*update data */
$(document).ready(function(){
    $("#update-form").submit(function(event){
        event.preventDefault();
        var formData= new FormData(this);
        formData.append("update_data",true)
       
        
        
            $.ajax({
                url: 'http://localhost:3000/Admin/operations/update.php',
                method: 'post',
                data:formData,
                        processData:false,
                        contentType:false,  
                        
                        success: function(response) {
                            var res= jQuery.parseJSON(response);
                            if(res.status == 404)
                            {
                                Swal.fire('ERROR','','error')
                            $('#msgupdate').html("<p class='alert alert-danger'>"+ res.message); 
                            
                            
                            }else if (res.status == 422)
                            {
                                Swal.fire(
                                    'Success!',
                                    res.message,
                                    'success'
                                  )
                                $('#updateModal').modal('hide');
                                $('#table_data').load(location.href+ " #table_data");
                              
                               
                            }
                           
                            
                            
                        }
            });
        
    });
});
/* save request*/
$(document).ready(function(){
    $("#saveRequest").submit(function(event){
        event.preventDefault();
        var id = $('.viewBtn').attr("id");
        $('.viewBtn').attr('disabled', 'disabled');
        var formData= new FormData(this);
        formData.append("send_data",true)
       
        
        
            $.ajax({
                url: 'http://localhost:3000/Admin/include/sendrequest.php',
                method: 'post',
                data:formData,
                        processData:false,
                        contentType:false,  
                        success: function(response) {
                            var res= jQuery.parseJSON(response);
                            if(res.status == 422)
                            {
                                Swal.fire('ERROR','','error')
                            $('#msg').html("<p class='alert alert-danger'>"+ res.message); 
                            
                            
                            }else if (res.status == 200)
                            {
                                Swal.fire(
                                    'Success!',
                                    res.message,
                                    'success'
                                  )
                                $('#recieveReq').modal('hide');
                                $('#'+id).addClass('btn-success')
                                $('#'+id).html('Sent');
                                $('.viewBtn'+id).attr('disabled', false);
                                
                                
                                
                               
                            }
                           
                            
                            
                        }
            });
        
    });
});
		
/*request page money data */

$(document).on('click', '.viewMoney', function (e) {
    e.preventDefault();
    var money_id = $(this).val();


    $.ajax({
        type: "GET",
        url: "http://localhost:3000/Admin/operations/viewmoney.php?money_id="+ money_id,
        success: function (response) {
            var res = $.parseJSON(response);
            if(res.status == 422) {
             
                $('#moneyRecieve').modal('show');
                $('#money_name').val(res.data.money_name);
                $('#money_province').val(res.data.money_province);
                $('#money_street').val(res.data.money_street);
                $('#money_region').val(res.data.money_region);
                $('#money_contact').val(res.data.money_contact);
                $('#money_email').val(res.data.money_email);
                $('#money_date').val(res.data.money_date);
                $('#money_amount').val(res.data.money_amount);
                $('#money_note').val(res.data.money_note);

 
               
            }else if(res.status == 404){
                alert(res.message);
            }
        }
    });
});

/**reference number */
$(document).on('click', '.viewRef', function (e) {
    e.preventDefault();
    var money_id = $(this).val();


    $.ajax({
        type: "GET",
        url: "http://localhost:3000/Admin/operations/viewmoney.php?money_id="+ money_id,
        success: function (response) {
            var res = $.parseJSON(response);
            if(res.status == 422) {
             
                $('#referenceImg').modal('show');
                
          
                $('#imageContainer').attr('src','../donors/ReferencePhoto/'+res.data.money_img);
            
            
 
               
            }else if(res.status == 404){
                alert(res.message);
            }
        }
    });
});


/* save money donations*/
$(document).ready(function(){
    $("#saveMoneyDonations").submit(function(event){
        event.preventDefault();
        var id = $('.viewMoney').attr("id");
        $('.viewMoney').attr('disabled', 'disabled');
        var formData= new FormData(this);
        formData.append("send_money",true)
       
        
        
            $.ajax({
                url: 'http://localhost:3000/Admin/include/savemoney.php',
                method: 'post',
                data:formData,
                        processData:false,
                        contentType:false,  
                        success: function(response) {
                            var res= jQuery.parseJSON(response);
                            if(res.status == 422)
                            {
                                Swal.fire('ERROR','','error')
                            $('#msg').html("<p class='alert alert-danger'>"+ res.message); 
                            
                            
                            }else if (res.status == 200)
                            {
                                Swal.fire(
                                    'Success!',
                                    res.message,
                                    'success'
                                  )
                                $('#moneyRecieve').modal('hide');
                                $('#'+id).addClass('btn-success')
                                $('#'+id).html('Sent');
                                $('.viewMoney'+id).attr('disabled', false);    
                               
                            }              
                            
                        }
            });
        
    });
});