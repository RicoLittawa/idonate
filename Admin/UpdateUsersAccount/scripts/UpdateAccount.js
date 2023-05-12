/*****************Update Users Account**********************************/
$("#update-user").submit((e) => {
  e.preventDefault();
  let fd = new FormData($("#update-user")[0]); //JavaScript object that allows you to
  //easily construct and send form data (including files) via AJAX.
  fd.append("updateBtn", true);
  //  for (let [key, value] of fd.entries()) {
  //  console.log(`${key}: ${value}`);}
  //validation
  let fname = fd.get("fname");
  let lname = fd.get("lname");
  let position = fd.get("position");
  let email = fd.get("email");
  let address = fd.get("address");
  /**Validation */
  let isInvalid = false;
  let fileInput = $('input[type="file"]');
  let file = fileInput[0].files[0];
  if (file) {
    let extension = file.name.split(".").pop().toLowerCase();
    if (["gif", "png", "jpg", "jpeg"].indexOf(extension) === -1) {
      // Invalid file extension
      // Display an error message or highlight the input field
      Swal.fire("Image", "Invalid file extension.", "warning");
      fileInput.val("");
      isInvalid = true;
    }
  }
  if (!fname) {
    $("#fname").addClass("is-invalid");
    isInvalid = true;
  } else {
    $("#fname").removeClass("is-invalid");
  }
  if (!lname) {
    $("#lname").addClass("is-invalid");
    isInvalid = true;
  } else {
    $("#lname").removeClass("is-invalid");
  }
  if (!position) {
    $("#position").addClass("is-invalid");
    isInvalid = true;
  } else {
    $("#position").removeClass("is-invalid");
  }
  if (!email) {
    $("#email").addClass("is-invalid");
    isInvalid = true;
  } else {
    $("#email").removeClass("is-invalid");
  }
  if (!address) {
    $("#address").addClass("is-invalid");
    isInvalid = true;
  } else {
    $("#address").removeClass("is-invalid");
  }
  if (isInvalid) {
    return false;
  }
  $.ajax({
    url: "include/update-user.php",
    method: "POST",
    processData: false,
    contentType: false,
    dataType: "text",
    data: fd,
    beforeSend: () => {
      $('button[type="submit"]').prop("disabled", true);
      $(".submit-text").text("Updating...");
      $(".spinner-border").removeClass("d-none");
    },
    success: (data) => {
      console.log(data)
      if (data === "success") {
        setTimeout(() => {
          // Enable the submit button and hide the loading animation
          $('button[type="submit"]').prop("disabled", false);
          $(".submit-text").text("Update");
          $(".spinner-border").addClass("d-none");
          Swal.fire({
            title: "Success",
            text: "Your profile is updated",
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK",
            allowOutsideClick: false,
          });
        }, 1500);
      } else if (data == "Email already exists") {
        Swal.fire({
          title: "Error",
          text: data,
          icon: "error",
          confirmButtonColor: "#20d070",
          confirmButtonText: "OK",
          allowOutsideClick: false,
        });
        $('button[type="submit"]').prop("disabled", false);
        $(".submit-text").text("Create");
        $(".spinner-border").addClass("d-none");
        $("#email").val("");
        $("#email").addClass("is-invalid");
      }
    },
    error: (xhr, status, error) => {
      // Handle errors
      Swal.fire({
        title: "Error",
        text: xhr.responseText,
        icon: "error",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK",
        allowOutsideClick: false,
      });
    },
  });
});
/*****************Update Users Account**********************************/

/*****************Update Users Account**********************************/
$("#wizard-picture").change(function() {
  readURL(this);
});
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
    }
    reader.readAsDataURL(input.files[0]);
  }
}
