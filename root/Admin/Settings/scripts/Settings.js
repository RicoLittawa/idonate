let id = $("#templateId").val();
$("#certificate").on("change", (event) => {
  let fileName = $(event.target).val().split("\\").pop();
  $(event.target)
    .siblings(".custom-file-label")
    .addClass("selected")
    .html(fileName);
});
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
$("#saveSettings").on("submit", (e) => {
  e.preventDefault();
  let fileInput = $("#certificate");
  let file = fileInput[0].files[0];
  let formData = new FormData($(e.target)[0]);
  formData.append("saveBtn", true);

  let isInvalid = false;
  const resetBtnLoadingState = () => {
    $('button[type="submit"]').prop("disabled", false);
    $(".submit-text").text("Update");
    $(".spinner-border").addClass("d-none");
  };

  if (file) {
    let extension = file.name.split(".").pop().toLowerCase();
    if (["png", "jpg", "jpeg"].indexOf(extension) === -1) {
      $("#certificate").addClass("is-invalid");
      alertMessage("Warning", "Invalid file extension", "warning");
      isInvalid = true;
    } else {
      $("#certificate").removeClass("is-invalid");
    }
  }
  if (!file) {
    alertMessage("Warning", "Please input a file", "warning");
    $("#certificate").addClass("is-invalid");
    isInvalid = true;
  } else {
    $("#certificate").removeClass("is-invalid");
  }
  if (isInvalid) {
    return false;
  }

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
        url: "include/UpdateSettings.php",
        method: "POST",
        processData: false,
        contentType: false,
        dataType: "json",
        data: formData,
        beforeSend: () => {
          $('button[type="submit"]').prop("disabled", true);
          $(".submit-text").text("Updating...");
          $(".spinner-border").removeClass("d-none");
        },
        success: (response) => {
          console.log(response.status);
          if (response.status === "Success") {
            setTimeout(() => {
              alertMessage(response.status, response.message, response.icon);
              resetBtnLoadingState();
              $("#certificate").val("");
              $("#imageContainer").attr(
                "src",
                `../include/Certificate Template/${response.data}`
              );
              $("#filename").val(response.data)
            }, 1000);
          } else {
            alertMessage(response.status, response.message, response.icon);
            resetBtnLoadingState();
            $("#certificate").val("");
          }
        },
        error: (xhr, status, error) => {
          // Handle error response
          alertMessage("Error", xhr.responseText, "error");
          resetBtnLoadingState();
        },
      });
    }
  });
});

/*****************View Certificate template****************************/
$(document).on("click", "#viewTemplate", () => {
  $.ajax({
    url: "include/ViewTemplate.php",
    data: { templateId: "", id: id },
    method: "Get",
    success: (data) => {
      $("#exampleModal").modal("show");
      $("#imageContainer").attr(
        "src",
        `../include/Certificate Template/${data}`
      );
    },
    error: (xhr, status, error) => {
      alertMessage("Error", xhr.responseText, "error");
    },
  });
});
