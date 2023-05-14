/***********************Populate added users table*******************/
let userTable = $("#user_data").DataTable({
  responsive: true,
  ajax: "include/usersdata.php",
  columns: [
    {
      data: "uID",
      visible: false,
    },
    {
      data: "firstname",
    },
    {
      data: "lastname",
    },
    {
      data: "position",
    },
    {
      data: "email",
    },
    {
      data: "address",
    },
    {
      data: "role",
      render: (data, type, row) => {
        return data !== "admin"
          ? `<span class="badge rounded-pill badge-info">${data}</span>`
          : `<span class="badge rounded-pill badge-success">${data}</span>`;
      },
    },
    {
      data: "status",
      render: function (data, type, row) {
        return data !== "offline"
          ? `<span class="badge rounded-pill badge-success">Active</span>`
          : `<span class="badge rounded-pill badge-info">Offline</span>`;
      },
    },
    {
      data: null,
      render: function (data, type, row) {
        return `<a class="d-flex justify-content-center allowed" onclick="deleteRow(${row.uID},'include/DeleteUser.php','#user_data')"><i class="fa-solid fa-trash text-danger"></i></a>`;
      },
    },
  ],
  buttons: [
    {
      extend: "copyHtml5",
      filename: "Users Data", // set the file name
    },
    {
      extend: "excelHtml5",
      filename: "Users Data", // set the file name
    },
    {
      extend: "csvHtml5",
      filename: "Users Data", // set the file name
    },
    {
      extend: "pageLength",
    },
    {
      extend: "pdfHtml5",
      filename: "Users Data", // set the file name
      customize: (doc) => {
        doc.content[0].text = "Users Data";
        doc.pageMargins = [40, 40, 40, 60];
        doc.defaultStyle.fontSize = 12;
        doc.styles.tableHeader = {
          fontSize: 14,
          bold: true,
          alignment: "left",
        };
        doc.styles.title = {
          color: "#4c8aa0",
          fontSize: 16,
          alignment: "center",
        };
        doc.pageSize = "A4"; // set page size
        doc.pageOrientation = "portrait";
      },
    },
  ],
  order: [[0, "asc"]],
  lengthMenu: [
    [10, 25, 50, -1],
    ["10 rows", "25 rows", "50 rows", "Show all"],
  ],

  searchDelay: 500,
  dom: "frtip",
  initComplete: function () {
    this.api()
      .columns(6)
      .every(function () {
        const column = this;
        const select = $(
          '<select class="form-select rounded-pill"><option value="">All</option></select>'
        )
          .appendTo($("#role_filter"))
          .on("change", function () {
            const val = $.fn.dataTable.util.escapeRegex($(this).val());
            column.search(val ? "^" + val + "$" : "", true, false).draw();
          });

        column
          .data()
          .unique()
          .sort()
          .each(function (d, j) {
            select.append('<option value="' + d + '">' + d + "</option>");
          });
      });
  },
});
/***********************Filter Initialization*******************************/
const initializeTableButtons = (selector, tableName) => {
  $(selector).append(tableName.buttons().container());

  $(selector).on("click", "#copyTable", function () {
    tableName.button(".buttons-copy").trigger();
  });
  $(selector).on("click", ".select-row", (event) => {
    event.preventDefault();
    tableName.page.len($(event.target).data("length")).draw();
  });
  $(selector).on("click", "#csvTable", function () {
    tableName.button(".buttons-csv").trigger();
  });
  $(selector).on("click", "#excelTable", function () {
    tableName.button(".buttons-excel").trigger();
  });
  $(selector).on("click", "#pdfTable", function () {
    tableName.button(".buttons-pdf").trigger();
  });
};
initializeTableButtons(".user-download-btn", userTable);
const filterInitialization = (tableName) => {
  // Custom search
  $(document).on("keyup", "#customSearch", (event) => {
    tableName.search($(event.target).val()).draw();
  });
};
filterInitialization(userTable);
/***********************Filter Initialization*******************************/

/***********************Add new user*******************/
$("#add-user").submit((e) => {
  e.preventDefault();

  // Get form field values
  let fname = $("#fname").val();
  let lname = $("#lname").val();
  let position = $("#position").val();
  let email = $("#email").val();
  let password = $("#password").val();
  let address = $("#address").val();
  let selectedValue = $('input[name="role"]:checked').val();

  /**Validations */
  let emailVali =
    /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  let isInvalid = false;

  const showAlert= (message)=>{
    Swal.fire({
        title: "Warning",
        text: message,
        icon: "warning",
        confirmButtonColor: "#20d070", // Change the color value here
      });
  }

  // Check for empty required fields
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
  } else if (emailVali.test(email) == false) {
    showAlert("Invalid email address")
    $("#email").addClass("is-invalid");
    isInvalid = true;
  } else {
    $("#email").removeClass("is-invalid");
  }

  if (!password) {
    $("#password").addClass("is-invalid");
    isInvalid = true;
  }else if(password.length < 8){
    showAlert("Password must be atleast 8 characters")
      $("#password").addClass("is-invalid");
  }
   else {
    $("#password").removeClass("is-invalid");
  }

  if (!address) {
    $("#address").addClass("is-invalid");
    isInvalid = true;
  } else {
    $("#address").removeClass("is-invalid");
  }

  if (!selectedValue) {
    $('input[name="role"]').addClass("is-invalid");
    isInvalid = true;
  } else {
    $('input[name="role"]').removeClass("is-invalid");
  }

  // Submit the form data with AJAX
  let data = {
    submitBtn: "",
    fname: fname,
    lname: lname,
    position: position,
    email: email,
    password: password,
    address: address,
    selectedValue: selectedValue,
  };
  if (isInvalid) {
    return false;
  }
  $.ajax({
    type: "POST",
    url: "include/register.inc.php",
    data: data,
    beforeSend: () => {
      $('button[type="submit"]').prop("disabled", true);
      $(".submit-text").text("Creating...");
      $(".spinner-border").removeClass("d-none");
    },
    success: (data) => {
      if (data === "success") {
        setTimeout(() => {
          // Enable the submit button and hide the loading animation
          $('button[type="submit"]').prop("disabled", false);
          $(".submit-text").text("Create");
          $(".spinner-border").addClass("d-none");
          userTable.ajax.reload()
          Swal.fire({
            title: "Success",
            text: "Account is successfully created",
            icon: "success",
            confirmButtonColor: "#20d070",
            confirmButtonText: "OK",
            allowOutsideClick: false,
          });
          setTimeout(() => {
            $("#fname").val("");
            $("#lname").val("");
            $("#position").val("");
            $("#email").val("");
            $("#password").val("");
            $("#address").val("");
            $('input[name="role"]').prop("checked", false);
          }, 1000);
        }, 500);
      } else if (data == "Email already exists") {
        $('button[type="submit"]').prop("disabled", false);
        $(".submit-text").text("Create");
        $(".spinner-border").addClass("d-none");
        $("#email").val("");
        $("#email").addClass("is-invalid");
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
/***********************Generate Password*******************/
const generatePassword = () => {
  const characters =
    "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;:'\",.<>/?`~";
  let password = "";
  for (let i = 0; i < 8; i++) {
    password += characters.charAt(
      Math.floor(Math.random() * characters.length)
    );
  }
  return password;
};

let passwordInput = $("#password");

$("#generatePasswordBtn").click(() => {
  passwordInput.val(generatePassword());
  $('label[for="password"]').hide();
});

$("#password").keyup(() => {
  $('label[for="password"]').toggle($("#password").val() === "");
});
/***********************Generate Password*******************/

/***********************Show Password*******************/
$("#togglePass").click(function () {
  if (passwordInput.attr("type") === "password") {
    passwordInput.attr("type", "text");
  } else {
    passwordInput.attr("type", "password");
  }
});
/***********************Show Password*******************/
