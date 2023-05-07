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
  let date = new Date(data[4]);

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

/******************************Populate Table**************************************/
let requestTable = $("#request_data_main").DataTable({
  responsive: true,
  ajax: {
    url: "include/RequestDataForDataTables.php",
    error: function (xhr, error, thrown) {
      if (xhr.status === 404) {
        $("#request_data_main").html("<p>No data available</p>");
      } else {
        alert("There was an error retrieving data. Please try again.");
      }
    },
  },
  columns: [
    {
      data: "reference",
      render: (data, type, row) => {
        return row.dateTrimmed + "-00" + row.reference;
      },
    },
    {
      data: "Fullname",
      render: (data, type, row) => {
        return row.firstname + " " + row.lastname;
      },
    },
    {
      data: "position",
    },
    {
      data: "evacuees_qty",
    },
    {
      data: "requestdate",
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
      data: "reference",
      render: function (data, type, row) {
        if (row.status === "pending") {
          return `<div><button type="button" id="acceptBtn" data-request=${row.reference} class="btn btn-success btn-rounded">Accept</button></div>`;
        } else {
          return `<div><button type="button" id="viewReceiptBtn" data-request=${row.reference} class="btn btn-secondary btn-rounded">View</button></div>`;
        }
      },
    },
    {
      data: null,
      render: function (data, type, row) {
        return `<a class="d-flex justify-content-center allowed" onclick="deleteRow(${row.reference},'include/DeleteReceiveRequest.php','#request_data_main')"><i class="fa-solid fa-trash text-danger"></i></a>`;
      },
    },
  ],
  order: [[4, "desc"]],
  buttons: [
    {
      extend: "copyHtml5",
      filename: "Received Requests", // set the file name
    },
    {
      extend: "excelHtml5",
      filename: "Received Requests", // set the file name
    },
    {
      extend: "csvHtml5",
      filename: "Received Requests", // set the file name
    },
    {
      extend: "pageLength",
    },
    {
      extend: "pdfHtml5",
      filename: "Received Requests", // set the file name
      customize: (doc) => {
        doc.content[0].text = "Received Requests";
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
  lengthMenu: [
    [10, 25, 50, -1],
    ["10 rows", "25 rows", "50 rows", "Show all"],
  ],
  dom: "frtip",
  searchDelay: 500,
});
/******************************Populate Table**************************************/

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
initializeTableButtons(".request-download-btn", requestTable);

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
filterInitialization(requestTable);
/******************************Initialized filter buttons**************************************/

/******************************Update Status**************************************/
$(document).on("click", "#saveStatus", () => {
  let reference = $("#reference").val();
  let selectStatus = $("#selectStatus").val();
  $.ajax({
    url: "include/UpdateRequestStatus.php",
    method: "POST",
    data: {
      saveStatus: "",
      reference: reference,
      selectStatus: selectStatus,
    },
    beforeSend: () => {
      $("#saveStatus").prop("disabled", true);
      $(".submit-text").text("Updating...");
      $(".spinner-border").removeClass("d-none");
    },
    success: (data) => {
      if (data === "success") {
        setTimeout(() => {
        $('#saveStatus').prop("disabled", false);
        $(".submit-text").text("Update");
        $(".spinner-border").addClass("d-none");
        requestTable.ajax.reload();
          Swal.fire({
            title: "Success",
            text: "Status has been updated",
            icon: "success",
            confirmButtonColor: "#20d070",
            confirmButtonText: "OK",
            allowOutsideClick: false,
            timer: 1500,
          });
        }, 1500);
        setTimeout(()=>{
          $("#exampleModal").modal("hide");
          $(".main-content").removeClass("blur-filter-class");
          $(".sidebar").removeClass("blur-filter-class");
        },2000)
      }
    },
  });
});

$(document).on("click", "#acceptBtn", (event) => {
  let requestId = $(event.target).attr("data-request");
  window.location.href = "RecieveRequest.php?requestId=" + requestId;
});
$(document).on("click", "#viewReceiptBtn", (event) => {
  let viewReciept = $(event.target).attr("data-request");
  window.location.href = "ViewRequestReceipt.php?requestId=" + viewReciept;
});
$(".closeModal").click(() => {
  $("#exampleModal").modal("hide");
  $(".main-content").removeClass("blur-filter-class");
  $(".sidebar").removeClass("blur-filter-class");
});

const changeStatus = (element) => {
  let reference = $(element).data("request");
  let status = $(element).data("status");
  $("#exampleModal").modal("show");
  $(".main-content").addClass("blur-filter-class");
  $(".sidebar").addClass("blur-filter-class");
  $("#reference").val(reference);
  $('#selectStatus option[value="' + status + '"]').prop("selected", true);
  $("#selectStatus").find(":selected").text(status);
};
