$("#password-update").submit((e) => {
  e.preventDefault();
  let fd = new FormData($("#password-update")[0]);
  fd.append("updatePassword", true);
  // for (let [key, value] of fd.entries()) {
  // console.log(`${key}: ${value}`);}

  let currpass = fd.get("currentPass");
  let newpass = fd.get("newPass");
  let isInvalid = false;
  if (!currpass) {
    $("#currentPass").addClass("is-invalid");
    isInvalid = true;
  } else {
    $("#currentPass").removeClass("is-invalid");
  }
  if (!newpass) {
    $("#newPass").addClass("is-invalid");
    isInvalid = true;
  } else {
    $("#newPass").removeClass("is-invalid");
  }

  if (isInvalid) {
    return false;
  }
  const alertMessage = (title, text, icon) => {
    Swal.fire({
      title: title,
      text: text,
      icon: icon,
      confirmButtonColor: "#20d070",
      confirmButtonText: "OK",
      allowOutsideClick: false,
      timer:1500
    });
  };
  const resetBtnLoadingState = () => {
    $('button[type="submit"]').prop("disabled", false);
    $(".submit-text").text("Change");
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
        url: "../include/update-user.php",
        method: "POST",
        processData: false,
        contentType: false,
        dataType: "json",
        data: fd,
        beforeSend: () => {
          $('button[type="submit"]').prop("disabled", true);
          $(".submit-text").text("Changing...");
          $(".spinner-border").removeClass("d-none");
        },
        success: (response) => {
          if (response.status === "Success") {
            setTimeout(() => {
              $("#currentPass").val("");
              $("#newPass").val("");
              resetBtnLoadingState();
              alertMessage(response.status, response.message, response.icon);
            }, 1000);
          } else {
            resetBtnLoadingState();
            alertMessage(response.status, response.message, response.icon);
            $("#currentPass").val("");
            $("#newPass").val("");
            $("#currentPass").addClass("is-invalid");
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
let passwordInputs = $("#newPass, #currentPass");

$("#togglePass").click(function () {
  if (passwordInputs.attr("type") === "password") {
    passwordInputs.attr("type", "text");
  } else {
    passwordInputs.attr("type", "password");
  }
});
