let id = $("#templateId").val();
$("#certificate").on("change", (event) => {
  let fileName = $(event.target).val().split("\\").pop();
  $(event.target)
    .siblings(".custom-file-label")
    .addClass("selected")
    .html(fileName);
});
$(document).on("submit", "#saveSettings", (event) => {
  event.preventDefault();
  let fd = new FormData($("#saveSettings")[0]);
  fd.append("saveBtn", true);
  let email = fd.get("email");
  let fileInput = $('input[type="file"]');
  let file = fileInput[0].files[0];

  let isInvalid= false;
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

  const resetBtnLoadingState = () => {
    $('button[type="submit"]').prop("disabled", false);
    $(".submit-text").text("Update");
    $(".spinner-border").addClass("d-none");
  };

  if (file) {
    let extension = file.name.split(".").pop().toLowerCase();
    if (["gif", "png", "jpg", "jpeg"].indexOf(extension) === -1) {
      // Invalid file extension
      // Display an error message or highlight the input field
      alertMessage("Warning","Invalid file extension","warning");
      isInvalid = true;
    }
  }
  if (isInvalid) {
    return false;
  }
  $.ajax({
    url: "include/UpdateSettings.php",
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
      if (data==="uploaded"){
        setTimeout(()=>{
          alertMessage("Success","Template has been updated","success");
          resetBtnLoadingState()
        },1000)
      }
    },
    error: (xhr, status, error) => {
      alertMessage("Error",xhr.responseText,"error");
      resetBtnLoadingState()
    },
  });
});

/*****************View Certificate template****************************/
$(document).on("click", "#viewTemplate", () => {
  $.ajax({
    url: "include/ViewTemplate.php",
    data: { templateId: "", id: id },
    method: "Get",
    success: (data) => {
      console.log(data);
      $("#exampleModal").modal("show");
      $("#imageContainer").attr(
        "src",
        `../include/Certificate Template/${data}`
      );
    },
    error: (xhr, status, error) => {
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
