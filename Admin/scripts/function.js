$(document).ready(function(){
    $('.adddata').on('click',function(){
        $('#add').modal('show');

    });
});


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
                               alert(res.message);
                            }else if (res.status == 200)
                            {
                                alert(res.message)
                                $('#add').modal('hide');
                                $('#add-form')[0].reset();
                                $('#table_data').load(location.href+ " #table_data")
                            }
                           
                            
                            
                        }
            });
        
    });
});

//delete
$(document).on('click', '.btnDel', function (e) {
    e.preventDefault();

    if(confirm('Are you sure you want to delete this data?'))
    {
        var id = $(this).val();
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

                    alert(res.message);
                }else{
                 
                    alert(res.message);

                    $('#table_data').load(location.href + " #table_data");
                }
            }
        });
    }
});
