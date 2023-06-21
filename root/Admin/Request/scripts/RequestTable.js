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

const formatDate = (date, status) => {
  if (status === "pending" || status === "Deleted") {
    return ""; // Return an empty string for pending or deleted status
  }

  let dateObj = new Date(date);
  let options = { timeZone: "Asia/Manila" };
  let formattedDateTime = dateObj.toLocaleString("en-PH", options);
  return formattedDateTime;
};

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
        return `<p class="fw-bold mb-1">${row.firstname} ${row.lastname}</p>
        <p class="text-muted mb-0">${row.position}</p>`;
      },
    },
    {
      data: "evacuees_qty",
    },
    {
      data: "requestdate",
      render: (data, type, row) => {
        return formatDate(data);
      },
    },
    {
      data: "status",
      render: (data, type, row) => {
        let statusTime = row.status_timestamp;
        let badgeClass = "";
        switch (data) {
          case "Request was processed":
            badgeClass = "badge-success allowed";
            break;
          case "Request completed":
            badgeClass = "badge-success not-allowed";
            break;
          case "Ready for Pick-up":
            badgeClass = "badge-warning allowed";
            break;
          case "Request cannot be completed":
          case "Deleted":
            badgeClass = "badge-danger not-allowed";
            break;
          default:
            badgeClass = "badge-info not-allowed";
            break;
        }
        return `<span class="badge ${badgeClass} d-flex justify-content-center" onclick="changeStatus('${
          row.reference
        }', '${row.status}')">${data}<br>${formatDate(
          statusTime,
          data
        )}</span>`;
      },
    },
    {
      data: "status",
      render: function (data, type, row) {
        let statusTime = row.deleted_timestamp;
        if (data === "pending") {
          return `<div class="d-flex justify-content-center"><button type="button" id="acceptBtn" data-request=${row.reference} class="btn btn-success btn-rounded">Accept</button></div>`;
        } else if (data === "Deleted") {
          return `<span class="badge badge-warning user-select-none not-allowed">Action made by: <br> ${
            row.firstname
          } ${row.lastname}<br>${formatDate(statusTime)}</span>`;
        } else {
          return `<button data-mdb-toggle="modal" onclick="fetchRequestData(${row.reference})" data-mdb-target="#openPrint" class="btn btn-secondary btn-rounded" type="button">View</button>`;
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
  order: [[0, "desc"]],
  buttons: [
    {
      extend: "copyHtml5",
    },
    {
      extend: "excelHtml5",
      filename: "Received Requests",
      exportOptions: {
        columns: [0, 1, 2, 3, 4],
      },
    },
    {
      extend: "pageLength",
    },
    {
      extend: "pdfHtml5",
      filename: "Received Requests",
      exportOptions: {
        columns: [0, 1, 2, 3, 4],
      },
      customize: (doc) => {
        let docDefinition = {
          header: {
            columns: [
              {
                stack: [
                  { text: "Republic of the Philippines", alignment: "center" },
                  {
                    text: "City Disaster Risk Reduction Management Office",
                    alignment: "center",
                  },
                ],
              },
            ],
            margin: [0, 10, 0, 0], // Adjust the top margin here
          },
          content: [
            {
              text: "Requests",
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
        doc.content[1].table.widths = ["auto", "auto", "auto", "auto", "auto"];
        doc.content[1].table.body.forEach((row) => {
          row.forEach((cell, i) => {
            cell.alignment = i === 0 ? "left" : "center"; // Adjust alignment for each column
          });
        });
      },
    },
  ],
  lengthMenu: [
    [10, 25, 50, -1],
    ["10 rows", "25 rows", "50 rows", "Show all"],
  ],
  dom: "frtip",
  searchDelay: 500,
  initComplete: function () {
    this.api()
      .columns(5)
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
  /****************Reset function********************************************************************/
  const resetBtnLoadingState = () => {
    $('button[type="submit"]').prop("disabled", false);
    $(".submit-text").text("Update");
    $(".spinner-border").addClass("d-none");
  };
  /****************Reset function********************************************************************/

  /****************Update Status********************************************************************/
  $.ajax({
    url: "include/UpdateRequestStatus.php",
    method: "POST",
    data: {
      saveStatus: "",
      reference: reference,
      selectStatus: selectStatus,
    },
    dataType: "json",
    beforeSend: () => {
      $("#saveStatus").prop("disabled", true);
      $(".submit-text").text("Updating...");
      $(".spinner-border").removeClass("d-none");
    },
    success: (response) => {
      if (response.status === "Success") {
        setTimeout(() => {
          resetBtnLoadingState();
          requestTable.ajax.reload();
          Swal.fire({
            title: response.status,
            text: response.message,
            icon: response.icon,
            confirmButtonColor: "#20d070",
            confirmButtonText: "OK",
            allowOutsideClick: false,
            timer: 1500,
          });
        }, 1500);
        setTimeout(() => {
          $("#exampleModal").modal("hide");
        }, 2000);
      } else {
        swal.fire(response.status, response.message, response.icon);
      }
    },
  });
});
/****************Update Status********************************************************************/

$(document).on("click", "#acceptBtn", (event) => {
  let requestId = $(event.target).attr("data-request");
  window.location.href = `ReceiveRequest.php?requestId=${requestId}`;
});
const fetchRequestData = (reference) => {
  $.ajax({
    url: `../include/ReceiptData.php?requestId=${reference}`,
    method: "GET",
    dataType: "json",
    success: (data) => {
      const requestData = data.requestData;
      const onProcessData = data.onProcessData;

      // Populate the receipt details
      if (requestData.length > 0) {
        const request = requestData[0];
        const dateOnly = (date) => {
          const options = { month: "2-digit", day: "2-digit", year: "numeric" };
          return new Date(date).toLocaleDateString(undefined, options);
        };
        $("#receipt_number").text(`${request.dateTrimmed}-00${reference}`);
        $("#request_date").text(dateOnly(request.requestdate));
        $("#name").text(`${request.fname} ${request.lname}`);
        $("#position").text(request.position);
        $("#evacuees_qty").text(request.evacuees_qty);
        $("#status").text(request.status);
        $("#email").text(request.requestemail);
        $("#receive_date").text(
          request.receivedate ? dateOnly(request.receivedate) : "N/A"
        );
      }

      // Populate the table rows
      let tableRows = "";
      onProcessData.forEach((item) => {
        const quantity = item.quantity;
        const productName = item.productName;
        tableRows += `<tr>
          <td>${quantity}</td>
          <td class="fw-bold">${productName}</td>
        </tr>`;
      });

      // Insert the table rows into the table body
      $("#table-container tbody").html(tableRows);
    },
  });
};

$(".closeModal").click(() => {
  $("#exampleModal").modal("hide");
});

const changeStatus = (id, status) => {
  if (
    status === "pending" ||
    status === "Deleted" ||
    status === "Request completed"
  ) {
    return;
  }
  $("#exampleModal").modal("show");
  $("#reference").val(id);
  $(`#selectStatus option[value="${status}"]`).prop("selected", true);
  $("#selectStatus").find(":selected").text(status);
};
