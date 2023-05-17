/******************************Date Filter**************************************/
let minDate = new DateTime($("#min"), {
  format: "MMMM Do YYYY",
  buttons: {
    today: true,
    clear: true,
  },
});
let maxDate = new DateTime($("#max"), {
  format: "MMMM Do YYYY",
  buttons: {
    today: true,
    clear: true,
  },
});
const today = new Date();
const yesterday = new Date();
yesterday.setDate(yesterday.getDate() - 1);
const sevenDaysAgo = new Date();
sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7);
const thirtyDaysAgo = new Date();
thirtyDaysAgo.setDate(thirtyDaysAgo.getDate() - 30);

$.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
  let min = minDate.val();
  let max = maxDate.val();
  let date = new Date(data[2]);

  if (
    (min === null && max === null) ||
    (min === null && date.getTime() <= max.getTime()) ||
    (min.getTime() <= date.getTime() && max === null) ||
    (min.getTime() <= date.getTime() && date.getTime() <= max.getTime())
  ) {
    // filter records based on today, yesterday, and 7 days ago
    const selectRange = $(".select-date.active").data("daterange");
    if (selectRange === "today") {
      return date.toDateString() === today.toDateString();
    } else if (selectRange === "yesterday") {
      return date.toDateString() === yesterday.toDateString();
    } else if (selectRange === "thirty-days-ago") {
      return date >= thirtyDaysAgo && date <= yesterday;
    } else if (selectRange === "seven-days-ago") {
      return date >= sevenDaysAgo && date <= yesterday;
    } else if (selectRange === "alltime") {
      return true;
    }
    return true;
  }
  return false;
});
/******************************Date Filter**************************************/

/********************************Create Request  Table*****************************/
let createRequest = $("#create_request_data").DataTable({
  responsive: true,
  ajax: {
    url: "include/CreateRequestTable.php",
    error: function (xhr, error, thrown) {
      if (xhr.status === 404) {
        $("#create_request_data").html("<p>No data available</p>");
      } else {
        alert("There was an error retrieving data. Please try again.");
      }
    },
  },
  columns: [
    {
      data: null,
      render: (data, type, row) => {
        return `${row.request_dateTrimmed}-00${row.request_id} `;
      },
    },
    {
      data: "evacuees_qty",
    },
    {
      data: "request_date",
    },
    {
      data: "receive_date",
      render: (data, type, row) => {
        return data !== null
          ? data
          : `<span class="badge badge-danger user-select-none not-allowed">N/A</span>`;
      },
    },
    {
      data: "status",
      render: (data, type, row) => {
        let badgeClass = "";
        let additionalClasses = "user-select-none not-allowed";
        
        switch (data) {
          case "Request was processed":
          case "Request completed":
            badgeClass = "badge-success";
            break;
          case "Ready for Pick-up":
            badgeClass = "badge-warning";
            break;
          case "Request cannot be completed":
          case "Deleted":
            badgeClass = "badge-danger";
            break;
          default:
            badgeClass = "badge-info";
            break;
        }  
        return `<span class="badge ${badgeClass} ${additionalClasses}">${data}</span>`;
      }
    },    
    {
      data: "status",
      render: (data, type, row) => {
        let buttonHtml = `<div><button type="button" id="viewReceiptBtn" data-request=${row.request_id} class="btn btn-secondary btn-rounded">View</button></div>`;
        let badgeHtml = `<span class="badge badge-warning user-select-none not-allowed">Not applicable <br> Deleted by:<br>Admin</span>`;
        switch (data) {
          case "Request was processed":
          case "Ready for Pick-up":
          case "Request completed":
          case "pending":
              return buttonHtml;
          case "Request cannot be completed":
            return `<span class="badge badge-danger user-select-none not-allowed">${data}</span>`;
          default:
            return badgeHtml;
        }
      },
    },
    {
      data: null,
      render: (data, type, row) => {
        return `<a class="d-flex justify-content-center allowed" onclick="deleteRow(${row.request_id},'include/DeleteRequest.php','#create_request_data')"><i class="fa-solid fa-trash text-danger"></i><a/>`;
      },
    },
  ],
  buttons: [
    {
      extend: "copyHtml5",
      filename: "Created Request Table",
    },
    {
      extend: "excelHtml5",
      filename: "Created Request Table",
    },
    {
      extend: "csvHtml5",
      filename: "Created Request Table",
    },
    {
      extend: "pageLength",
    },
    {
      extend: "pdfHtml5",
      filename: "Created Request Table",
      customize: (doc) => {
        doc.content[0].text = "Created Request Table";
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
        doc.pageSize = "A4";
        doc.pageOrientation = "portrait";
      },
    },
  ],
  order: [[2, "desc"]],
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
          .appendTo($("#status_filter"))
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
/********************************Create Request  Table*****************************/

/******************************Initialized filter buttons**************************************/
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
initializeTableButtons(".create-request-download-btn", createRequest);

const filterInitialization = (tableName) => {
  // Custom search
  $(document).on("keyup", "#customSearch", (event) => {
    tableName.search($(event.target).val()).draw();
  });
  //Custom date
  $(document).on("change", "#min, #max", () => {
    tableName.draw();
  });
  //Date filter options
  $(document).on("click", ".select-date", (event) => {
    event.preventDefault();
    const filterRange = $(event.target).data("daterange");
    const filters = [
      "today",
      "yesterday",
      "seven-days-ago",
      "thirty-days-ago",
      "alltime",
      "custom-date",
    ];
    const $rows = filters.map((filter) => $(`.${filter}`));
    $rows.forEach(($row) =>
      $row.toggleClass("active", $row.hasClass(filterRange))
    );
    tableName.draw();
  });
};
filterInitialization(createRequest);
/******************************Initialized filter buttons**************************************/

$(document).on("submit", "#add-request", (e) => {
  /****************Alert function********************************************************************/
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
  $(".submit-text").text("Create");
  $(".spinner-border").addClass("d-none");
};
/****************Alert function********************************************************************/

  e.preventDefault();
  let userId = $("#userId").val();
  let reqRef = $("#requestRef").val();
  let request_date = $("#request_date").val();
  let evacQty = $("#evacQty").val();

  let inputFields = {
    createBtn: "",
    category: [],
    quantity: [],
    notes: [],
    userId: userId,
    reqRef: reqRef,
    request_date: request_date,
    evacQty: evacQty,
  };

  let isInvalid = false; // variable to keep track if any input is invalid

  $(".category").each((index, element) => {
    inputFields.category.push($(element).val());
    if ($(element).val() == "") {
      $(element).addClass("is-invalid");
      isInvalid = true;
    } else {
      $(element).removeClass("is-invalid");
    }
  });

  $(".quantity").each((index, element) => {
    inputFields.quantity.push($(element).val());
    if ($(element).val() == "") {
      $(element).addClass("is-invalid");
      isInvalid = true;
    } else {
      $(element).removeClass("is-invalid");
    }
  });
  $(".notes").each((index, element) => {
    inputFields.notes.push($(element).val());
  });

  if (!request_date) {
    $("#request_date").addClass("is-invalid");
    isInvalid = true;
  } else {
    $("#request_date").removeClass("is-invalid");
  }

  if (!evacQty) {
    $("#evacQty").addClass("is-invalid");
    isInvalid = true;
  } else {
    $("#evacQty").removeClass("is-invalid");
  }

  if (isInvalid) {
    return false; // prevent form from submitting if any input is invalid
  }

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
        url: "include/CreateRequest.php",
        method: "POST",
        data: inputFields,
        dataType:"json",
        beforeSend: () => {
          $('button[type="submit"]').prop("disabled", true);
          $(".submit-text").text("Creating...");
          $(".spinner-border").removeClass("d-none");
        },
        success: (response) => {
          if (response.status === "Success") {
            setTimeout(() => {
              resetBtnLoadingState()
              alertMessage(response.status,response.message,response.icon);
            }, 1500);
            setTimeout(()=>{
              window.location.reload();
            },3000)
          } else {
            resetBtnLoadingState()
            alertMessage(response.status, response.message, response.icon);
          }
        },
        error: (xhr, status, error) => {
          resetBtnLoadingState()
          alertMessage("Error", xhr.responseText, "error");
        },
      });
    }
  });
});

$(document).on("click", "#viewReceiptBtn", (event) => {
  let viewReciept = $(event.target).attr("data-request");
  window.location.href = `ViewCreatedRequest.php?requestId=${viewReciept}`;
});