/***********************Populate added users table*******************/
let userTable = $("#user_data").DataTable({
  responsive: true,
  ajax: {
    url: "include/usersdata.php",
    error: function (xhr, error, thrown) {
      if (xhr.status === 404) {
        $("#user_data").html("<p>No data available</p>");
      } else {
        alert("There was an error retrieving data. Please try again.");
      }
    },
  },
  columns: [
    {
      data: "uID",
      visible: false,
    },
    {
      data: null,
      render: (data, type, row) => {
        return `<div class="d-flex align-items-center">
        <img
        src="../${
          row.profile !== null
            ? "include/profile/" + row.profile
            : "img/default-admin.png"
        }"
        alt="Profile"
            style="width: 50px; height: 50px"
            class="rounded-circle"
            />
        <div class="ms-3">
          <p class="fw-bold mb-1">${row.firstname} ${row.lastname}</p>
          <p class="text-muted mb-0">${row.email}</p>
          <span class="badge badge-info">${row.role}</span>
        </div>
      </div>`;
      },
    },
    {
      data: "position",
    },
    {
      data: "address",
    },
    {
      data: "logged_in",
      render: (data, type, row) => {
        let dateObj = new Date(data);
        let options = { timeZone: "Asia/Manila" };
        let formattedDateTime = dateObj.toLocaleString("en-PH", options);
        return data !== null
          ? `<span>${formattedDateTime}</span>`
          : `<span class="badge badge-warning">N/A</span>`;
      },
    },
    {
      data: "logged_out",
      render: (data, type, row) => {
        // Create a Date object from the datetime string
        let dateObj = new Date(data);
        let options = { timeZone: "Asia/Manila" };
        let formattedDateTime = dateObj.toLocaleString("en-PH", options);

        return data !== null
          ? `<span>${formattedDateTime}</span>`
          : `<span class="badge badge-warning">N/A</span>`;
      },
    },
    {
      data: "status",
      render: (data, type, row) => {
        return data !== "offline"
          ? `<span class="badge rounded-pill badge-success d-flex justify-content-center">Active</span>`
          : `<span class="badge rounded-pill badge-info d-flex justify-content-center">Offline</span>`;
      },
    },
    {
      data: null,
      render: (data, type, row) => {
        return `<a class="d-flex justify-content-center allowed" onclick="deleteRow(${row.uID},'include/DeleteUser.php','#user_data')"><i class="fa-solid fa-trash text-danger"></i></a>`;
      },
    },
  ],
  buttons: [
    {
      extend: "copyHtml5",
    },
    {
      extend: "excelHtml5",
      filename: "Users Data",
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5],
      },
    },
    {
      extend: "pageLength",
    },
    {
      extend: "pdfHtml5",
      filename: "Users Data",
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5],
      },
      customize: (doc) => {
        let docDefinition = {
          header: {
            columns: [
              {
                stack: [
                  { text: "Republic of the Philippines", alignment: "center" },
                  {
                    text: "City Risk Reduction Management Office",
                    alignment: "center",
                  },
                ],
              },
            ],
            margin: [0, 10, 0, 0], // Adjust the top margin here
          },
          content: [
            {
              text: "Users",
              fontSize: 18,
              bold: true,
              alignment: "center",
              margin: [0, 10, 0, 10],
            },
          ],
        };
        doc.header = docDefinition.header;
        doc.content[0] = docDefinition.content;
        doc.styles.tableHeader = {
          fontSize: 12,
          bold: true,
          alignment: "left",
        };
        doc.pageSize = "A4"; // set page size
        doc.pageOrientation = "portrait";
        doc.defaultStyle.fontSize = 12;
        // Add table border
        doc.content[1].layout = {
          hLineWidth: function (i, node) {
            return 1; // Horizontal line width
          },
          vLineWidth: function (i, node) {
            return 1; // Vertical line width
          },
          hLineColor: function (i, node) {
            return "#aaa"; // Horizontal line color
          },
          vLineColor: function (i, node) {
            return "#aaa"; // Vertical line color
          },
          paddingTop: function (i, node) {
            return 5; // Padding top
          },
          paddingBottom: function (i, node) {
            return 5; // Padding bottom
          },
        };

        // Align the columns
        doc.content[1].table.widths = ["auto", "auto", "auto", "auto", "auto", "auto"];
        doc.content[1].table.body.forEach((row) => {
          row.forEach((cell, i) => {
            cell.alignment = i === 0 ? "left" : "center"; // Adjust alignment for each column
          });
        });
      },
    },
  ],
  order: [[0, "desc"]],
  lengthMenu: [
    [10, 25, 50, -1],
    ["10 rows", "25 rows", "50 rows", "Show all"],
  ],

  searchDelay: 500,
  dom: "frtip",
  initComplete: function () {
    this.api()
      .columns(4)
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
    alertMessage("warning", "Invalid email address", "warning");
    $("#email").addClass("is-invalid");
    isInvalid = true;
  } else {
    $("#email").removeClass("is-invalid");
  }

  if (!password) {
    $("#password").addClass("is-invalid");
    isInvalid = true;
  } else if (password.length < 8) {
    showAlert("Password must be atleast 8 characters");
    $("#password").addClass("is-invalid");
  } else {
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

  const resetBtnLoadingState = () => {
    $('button[type="submit"]').prop("disabled", false);
    $(".submit-text").text("Create");
    $(".spinner-border").addClass("d-none");
  };

  Swal.fire({
    title: "Confirm",
    text: "Click yes to confirm",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#20d070",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, create it",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "include/register.inc.php",
        data: data,
        dataType: "json",
        beforeSend: () => {
          $('button[type="submit"]').prop("disabled", true);
          $(".submit-text").text("Creating...");
          $(".spinner-border").removeClass("d-none");
        },
        success: (response) => {
          if (response.status === "Success") {
            setTimeout(() => {
              // Enable the submit button and hide the loading animation
              userTable.ajax.reload();
              resetBtnLoadingState();
              alertMessage(response.status, response.message, response.icon);
              $("#fname").val("");
              $("#lname").val("");
              $("#position").val("");
              $("#email").val("");
              $("#password").val("");
              $("#address").val("");
              $('input[name="role"]').prop("checked", false);
            }, 1000);
          } else if (response.duplicate === true) {
            resetBtnLoadingState();
            alertMessage(response.status, response.message, response.icon);
            $("#email").val("");
            $("#email").addClass("is-invalid");
          } else {
            alertMessage(response.status, response.message, response.icon);
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
