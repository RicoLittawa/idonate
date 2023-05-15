/*****************Update Users Account**********************************/
$(document).on("submit", "#update-user", (event) => {
  event.preventDefault();
  let fd = new FormData($(event.target)[0]); //JavaScript object that allows you to
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
  const emailVali =
    /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

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
  if (!emailVali.test(email)) {
    Swal.fire("Warning", "Invalid email address", "warning");
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
  const alertMessage=(title,text,icon)=>{
    Swal.fire({
      title: title,
      text: text,
      icon: icon,
      confirmButtonColor: "#20d070",
      confirmButtonText: "OK",
      allowOutsideClick: false,
    });
  }
  const resetBtnLoadingState= ()=>{
    $('button[type="submit"]').prop("disabled", false);
    $(".submit-text").text("Update");
    $(".spinner-border").addClass("d-none");
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
      console.log(data);
      if (data === "success") {
        setTimeout(() => {
          // Enable the submit button and hide the loading animation
          resetBtnLoadingState()
          alertMessage("Success","Your profile is updated","success")
        }, 1000);
      } else if (data ==="Email already exists") {
        setTimeout(() => {
          alertMessage("Error",data,"error")
          resetBtnLoadingState()
          $("#email").val("");
          $("#email").addClass("is-invalid");
        }, 1000);
      }
    },
    error: (xhr, status, error) => {
      // Handle errors
      resetBtnLoadingState()
      alertMessage("Error",xhr.responseText,"error")
    },
  });
});
/*****************Update Users Account**********************************/

/*****************Update Users Account**********************************/
$("#wizard-picture").change(function () {
  var input = this;
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $("#wizardPicturePreview").attr("src", e.target.result).fadeIn("slow");
    };
    reader.readAsDataURL(input.files[0]);
  }
});
