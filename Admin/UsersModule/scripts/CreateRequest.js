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
  let date = new Date(data[3]);

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
        if (data === "Request was processed") {
          return `<span style="cursor:pointer;" class="badge badge-success" data-status="${row.status}" data-request=${row.reference} onclick="changeStatus(this)">${data}</span>`;
        } else if (data === "Ready for Pick-up") {
          return `<span style="cursor:pointer;" class="badge badge-warning" data-status="${row.status}" data-request=${row.reference} onclick="changeStatus(this)">${data}</span>`;
        } else if (data === "Request completed") {
          return `<span class="badge badge-success user-select-none not-allowed">${data}</span>`;
        } else if (data === "Request cannot be completed") {
          return `<span class="badge badge-danger user-select-none not-allowed">${data}</span>`;
        } else {
          return `<span class="badge badge-info user-select-none not-allowed">${data}</span>`;
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
      filename: "Users Data",
    },
    {
      extend: "excelHtml5",
      filename: "Users Data",
    },
    {
      extend: "csvHtml5",
      filename: "Users Data",
    },
    {
      extend: "pageLength",
    },
    {
      extend: "pdfHtml5",
      filename: "Users Data",
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

const alertMessage = (text, icon, title) => {
  Swal.fire({
    title: title,
    text: text,
    icon: icon,
    confirmButtonColor: "#20d070",
    confirmButtonText: "OK",
    allowOutsideClick: false,
  });
};


$(document).on("submit", "#add-request", (e) => {
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
  $.ajax({
    url: "include/CreateRequest.php",
    method: "POST",
    data: inputFields,
    beforeSend: () => {
      $('button[type="submit"]').prop("disabled", true);
      $(".submit-text").text("Creating...");
      $(".spinner-border").removeClass("d-none");
    },
    success: (data) => {
      if (data === "success") {
        setTimeout(() => {
          $('button[type="submit"]').prop("disabled", false);
          $(".submit-text").text("Create");
          $(".spinner-border").addClass("d-none");
          alertMessage("Your request is created", "success", "Success");
       
        }, 1500);
        setTimeout(()=>{
          window.location.reload();
        },1500)
      } else {
        alertMessage(data, "warning", "Error");
      }
    },
    error: (xhr, status, error) => {
      alertMessage(xhr.responseText, "warning", "Error");
    },
  });
});
