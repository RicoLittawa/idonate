$(document).submit((e) => {
  e.preventDefault();

  /******************Donor Details ********************************/
  let donor_id = $("#donor_id").val();
  let reference_id = $("#reference_id").val();
  let fname = $("#fname").val();
  let province = $("#province").val();
  let region = $("#region").val();
  let municipality = $("#municipality").val();
  let barangay = $("#barangay").val();
  let email = $("#email").val();
  let donation_date = $("#donation_date").val();
  let contact = $("#contact").val();
  /******************Donor Details ********************************/

  /******************Validators********************************/
  let emailVali =
    /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  let varnumbers = /^\d+$/;
  /******************Validators********************************/

  let data = {
    updateBtn: "",
    donor_id: donor_id,
    reference_id: reference_id,
    fname,
    province: province,
    region: region,
    municipality: municipality,
    barangay: barangay,
    contact: contact,
    email: email,
    donation_date: donation_date,
  };

  let isInvalid = false;

  /****************Alert function********************************************************************/
  const alertMessage = (Message) => {
    Swal.fire({
      title: "Warning",
      text: Message,
      icon: "warning",
      confirmButtonColor: "#20d070",
    });
  };
  /****************Alert function********************************************************************/

  /******************Input field validation********************************/
  const checksDonorInfoIfEmpty = (fieldName, idField) => {
    if (fieldName === "") {
      isInvalid = true;
      $(idField).addClass("is-invalid");
    } else {
      if (idField === "#email") {
        if (!emailVali.test(fieldName)) {
          isInvalid = true;
          alertMessage("Please enter a valid e-mail address.");
          $(idField).addClass("is-invalid");
          return;
        }
      }
      if (idField === "#contact") {
        if (!varnumbers.test(fieldName)) {
          isInvalid = true;
          alertMessage("Please enter a valid contact number.");
          $(idField).addClass("is-invalid");
          return;
        } else if (fieldName.length > 11) {
          isInvalid = true;
          alertMessage("Please enter a valid contact number.");
          $(idField).addClass("is-invalid");
          return;
        }
      }

      $(idField).removeClass("is-invalid");
    }
  };
  checksDonorInfoIfEmpty(fname, "#fname");
  checksDonorInfoIfEmpty(email, "#email");
  checksDonorInfoIfEmpty(region, "#region");
  checksDonorInfoIfEmpty(province, "#province");
  checksDonorInfoIfEmpty(municipality, "#municipality");
  checksDonorInfoIfEmpty(barangay, "#barangay");
  checksDonorInfoIfEmpty(contact, "#contact");
  checksDonorInfoIfEmpty(donation_date, "#donation_date");

  if (isInvalid) {
    return false;
  }
  $.ajax({
    url: "include/edit.inc.php",
    method: "POST",
    data: data,
    beforeSend: () => {
      $('button[type="submit"]').prop("disabled", true);
      $(".submit-text").text("Updating...");
      $(".spinner-border").removeClass("d-none");
    },
    success: function (data) {
      if (data === "success") {
        setTimeout(() => {
          // Enable the submit button and hide the loading animation
          $('button[type="submit"]').prop("disabled", false);
          $(".submit-text").text("Update");
          $(".spinner-border").addClass("d-none");
          Swal.fire({
            title: "Success",
            text: "Data has been updated",
            icon: "success",
            confirmButtonColor: "#20d070",
            confirmButtonText: "OK",
            allowOutsideClick: false,
          });
          setTimeout(() => {
            window.location.href = "Donors.php?NewdataAdded";
          }, 1500);
        }, 1000);
      } else {
        $(".submit-text").text("Update");
        $(".spinner-border").addClass("d-none");
        Swal.fire({
          title: "Error",
          text: data,
          icon: "error",
          confirmButtonColor: "#20d070",
          confirmButtonText: "OK",
          allowOutsideClick: false,
        });
      }
    },
    error: (xhr, status, error) => {
      $(".submit-text").text("Update");
      $(".spinner-border").addClass("d-none");
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

