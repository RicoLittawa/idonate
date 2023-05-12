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
  $.ajax({
    url: "../include/update-user.php",
    method: "POST",
    processData: false,
    contentType: false,
    dataType: "text",
    data: fd,
    beforeSend: () => {
      $('button[type="submit"]').prop("disabled", true);
      $(".submit-text").text("Changing...");
      $(".spinner-border").removeClass("d-none");
    },
    success: (data) => {
      if (data === "success") {
        setTimeout(() => {
          $('button[type="submit"]').prop("disabled", false);
          $(".submit-text").text("Change");
          $(".spinner-border").addClass("d-none");
          $("#currentPass").val("");
          $("#newPass").val("")
          Swal.fire({
            title: "Success",
            text: "Your password is updated",
            icon: "success",
            confirmButtonColor: "#20d070",
            confirmButtonText: "OK",
            allowOutsideClick: false,
          });
        }, 1500);
      } else {
        Swal.fire({
          title: "Error",
          text: data,
          icon: "error",
          confirmButtonColor: "#20d070",
          confirmButtonText: "OK",
          allowOutsideClick: false,
        });
        $('button[type="submit"]').prop("disabled", false);
        $(".submit-text").text("Change");
        $(".spinner-border").addClass("d-none");
        $("#currentPass").val("");
        $("#newPass").val("");
        $("#currentPass").addClass("is-invalid");
      }
    },
    error: (xhr, status, error) => {
      // Handle errors
      Swal.fire({
        title: "Error",
        text: xhr.responseText,
        icon: "error",
        confirmButtonColor: "#20d070",
        confirmButtonText: "OK",
        allowOutsideClick: false,
      });
    },
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
