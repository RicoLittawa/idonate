$(document).ready(() => {
    let count = 0;
    const addCategory = () => {
      let html = '';
      let remove = '';
      html += '<tr id="appendedRows"><td> <select class="form-control category" name="category" id="category' + count + '">' +
        '<option value="">--</option>' +
        '<?php echo add_category($conn); ?>' +
        '</select></td>';
      html += '<td><input type="text" class="form-control quantity" name="quantity" id="quantity' + count + '"></td>';
      html+='<td><textarea class="form-control notes" id="notes" cols="30" rows="5" placeholder="e.g. We only need shampoo, soap, and mouthwash"></textarea></td>';
      if (count > 0) {
        remove = '<button type="button" name="removeCN"  class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>';
      }
      html += '<td>' + remove + '</td></tr>';
  
      return html;
    }
    $('#addCategory').click(() => {
      count++
      $('#requestBody').append(addCategory());
    })
    $(document).on('click', '.remove', function () {
      $(this).closest('tr').remove();
    })
    $('#add-request').submit((e) => {
    e.preventDefault();
    let userId= $('#userId').val();
    let reqRef= $('#requestRef').val();
    let request_date= $('#request_date').val();
    let evacQty= $('#evacQty').val()
  
    let inputFields = {
      createBtn: '',
      category: [],
      quantity: [],
      notes:[],
      userId: userId,
      reqRef: reqRef,
      request_date: request_date,
      evacQty: evacQty
    };
    
    let isInvalid = false; // variable to keep track if any input is invalid
  
    $('.category').each((index, element) => {
      inputFields.category.push($(element).val());
      if ($(element).val()=="") {
        $(element).addClass('is-invalid');
        isInvalid = true;
      } else {
        $(element).removeClass('is-invalid');
      }
    });
  
    $('.quantity').each((index, element) => {
      inputFields.quantity.push($(element).val());
      if ($(element).val()=="") {
        $(element).addClass('is-invalid');
        isInvalid = true;
      } else {
        $(element).removeClass('is-invalid');
      }
    });
    $('.notes').each((index, element) => {
      inputFields.notes.push($(element).val());
    });
  
    if (!request_date) {
      $('#request_date').addClass('is-invalid');
      isInvalid = true;
    } else {
      $('#request_date').removeClass('is-invalid');
    }
  
    if (!evacQty) {
      $('#evacQty').addClass('is-invalid');
      isInvalid = true;
    } else {
      $('#evacQty').removeClass('is-invalid');
    }
  
    if (isInvalid) {
      return false; // prevent form from submitting if any input is invalid
    }
  
    // form is valid, continue with form submission
    // ...
  
  
    $.ajax({
      url:"include/CreateRequest.php",
      method:"POST",
      data:inputFields,
      beforeSend:()=>{
        $('button[type="submit"]').prop('disabled', true);
        $('.submit-text').addClass('d-none');
        $('.spinner-border').removeClass('d-none');
  
      },
      success:(data)=>{
        if (data==='success'){
          setTimeout(()=>{
          $('button[type="submit]"').prop("disabled",false);
          $('.submit-text').removeClass('d-none');
          $('.spinner-border').addClass('d-none');
          Swal.fire({
            title: 'Success',
            text: "Your request is created",
            icon: 'success',
            confirmButtonColor: '#20d070',
            confirmButtonText: 'OK',
            allowOutsideClick: false
          });
          setTimeout(()=>{
            window.location.reload();
            },1000)
        }
        ,1500)
        }
        else{
          Swal.fire({
          title: 'Error',
          text: data,
          icon: 'error',
          confirmButtonColor: '#20d070',
          confirmButtonText: 'OK',
          allowOutsideClick: false
        });
        }
      },
      error:(xhr, status, error)=>{
        Swal.fire({
        title: 'Error',
        text: xhr.responseText,
        icon: 'error',
        confirmButtonColor: '#20d070',
        confirmButtonText: 'OK',
        allowOutsideClick: false
        });
  
      }
  
    })
  });
  
  
  })