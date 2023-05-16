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

  const emailVali =
    /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  const alertMessage = (title, text, icon) => {
    Swal.fire({
      title: title,
      text: text,
      icon: icon,
      confirmButtonColor: "#20d070",
      confirmButtonText: "OK",
      allowOutsideClick: false,
    });
  };
  if (file) {
    let extension = file.name.split(".").pop().toLowerCase();
    if (["gif", "png", "jpg", "jpeg"].indexOf(extension) === -1) {
      alertMessage("Warning", "Invalid file extension.", "warning");
      isInvalid = true;
    } else {
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
  if (!emailVali.test(email)) {
    alertMessage("Warning", "Invalid email address", "warning");
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

  const resetBtnLoadingState = () => {
    $('button[type="submit"]').prop("disabled", false);
    $(".submit-text").text("Update");
    $(".spinner-border").addClass("d-none");
  };

  Swal.fire({
    title: "Confirm",
    text: "Click yes to confirm",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#20d070",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, update it",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "include/update-user.php",
        method: "POST",
        processData: false,
        contentType: false,
        dataType: "json",
        data: fd,
        beforeSend: () => {
          $('button[type="submit"]').prop("disabled", true);
          $(".submit-text").text("Updating...");
          $(".spinner-border").removeClass("d-none");
        },
        success: (response) => {
          if (response.status === "Success") {
            setTimeout(() => {
              // Enable the submit button and hide the loading animation
              resetBtnLoadingState();
              alertMessage(response.status, response.message, response.icon);
              if (response.data) {
                $("#newProfile").attr(
                  "src",
                  `../include/profile/${response.data}`
                );
              }
            }, 1000);
          } else {
            setTimeout(() => {
              alertMessage(response.status, response.message, response.icon);
              resetBtnLoadingState();
              if(!response.duplication){
                $("#email").val("");
                $("#email").addClass("is-invalid");
              }
            }, 1000);
          } 
        },
        error: (xhr, status, error) => {
          // Handle errors
          resetBtnLoadingState();
          alertMessage("Error", xhr.responseText, "error");
        },
      });
    }
  });
});
/*****************Update Users Account**********************************/

/*****************Update Users Account**********************************/
$("#wizard-picture").change(function () {
  let input = this;
  if (input.files && input.files[0]) {
    let reader = new FileReader();

    reader.onload = function (e) {
      $("#wizardPicturePreview").attr("src", e.target.result).fadeIn("slow");
    };
    reader.readAsDataURL(input.files[0]);
  }
});
