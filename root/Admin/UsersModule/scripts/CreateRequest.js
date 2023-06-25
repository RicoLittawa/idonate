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

const formatDate = (date, status) => {
  if (status === "pending" || status === "Deleted") {
    return ""; // Return an empty string for pending or deleted status
  }

  let dateObj = new Date(date);
  let options = { timeZone: "Asia/Manila" };
  let formattedDateTime = dateObj.toLocaleString("en-PH", options);
  return formattedDateTime;
};
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
      render: (data, type, row) => {
        return formatDate(data);
      },
    },
    {
      data: "receive_date",
      render: (data, type, row) => {
        return data !== null
          ? formatDate(data)
          : `<span class="badge badge-danger user-select-none not-allowed">N/A</span>`;
      },
    },
    {
      data: "status",
      render: (data, type, row) => {
        let badgeClass = "";
        let additionalClasses = "user-select-none not-allowed";
        let statusTime = row.status_timestamp;
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
        return `<span class="badge ${badgeClass} ${additionalClasses} d-flex justify-content-center">${data}<br>${formatDate(
          statusTime,
          data
        )}</span>`;
      },
    },
    {
      data: "status",
      render: (data, type, row) => {
        let statusTime = row.deleted_timestamp;
        let buttonHtml = `<button data-mdb-toggle="modal" onclick="fetchRequestData(${row.request_id})" data-mdb-target="#openPrint" class="btn btn-secondary btn-rounded" type="button">View</button>`;
        let badgeHtml = `<span class="badge badge-warning user-select-none not-allowed">Action made by: Admin <br>${formatDate(
          statusTime
        )}</span>`;
        switch (data) {
          case "Request was processed":
          case "Ready for Pick-up":
          case "Request completed":
          case "pending":
            return buttonHtml;
          case "Request cannot be completed":
            return `<span class="badge badge-warning user-select-none not-allowed">N/A</span>`;
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
    },
    {
      extend: "excelHtml5",
      filename: "Created Request Table",
      exportOptions: {
        columns: [0, 1, 2, 3, 4],
      },
    },
    {
      extend: "pageLength",
    },
    {
      extend: "pdfHtml5",
      filename: "Created Request Table",
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
                    text: "City Disaster Risk and Reduction Management Office Batangas City",
                    alignment: "center",
                  },
                ],
              },
            ],
            margin: [0, 10, 0, 0], // Adjust the top margin here
          },
          content: [
            {
              text: "Created Requests",
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
  e.preventDefault();
  let userId = $("#userId").val();
  let reqRef = $("#requestRef").val();
  let request_date = $("#request_date").val();
  let evacQty = $("#evacQty").val();

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
        dataType: "json",
        beforeSend: () => {
          $('button[type="submit"]').prop("disabled", true);
          $(".submit-text").text("Creating...");
          $(".spinner-border").removeClass("d-none");
        },
        success: (response) => {
          if (response.status === "Success") {
            setTimeout(() => {
              resetBtnLoadingState();
              alertMessage(response.status, response.message, response.icon);
            }, 1500);
            setTimeout(() => {
              window.location.reload();
            }, 3000);
          } else {
            resetBtnLoadingState();
            alertMessage(response.status, response.message, response.icon);
          }
        },
        error: (xhr, status, error) => {
          resetBtnLoadingState();
          alertMessage("Error", xhr.responseText, "error");
        },
      });
    }
  });
});
const fetchRequestData = (reference) => {
  $.ajax({
    url: `../include/ReceiptData.php?requestId=${reference}`,
    method: "GET",
    dataType: "json",
    success: (data) => {
      const requestData = data.requestData;
      const onProcessData = data.onProcessData;
      const onCategoryData = data.onCategoryData;

      // Populate the receipt details
      if (requestData.length > 0) {
        const request = requestData[0];
        const {
          dateTrimmed,
          fname,
          lname,
          position,
          evacuees_qty,
          status,
          requestemail,
          receivedate,
          requestdate,
        } = request;

        const dateOnly = (date) => {
          let dateObj = new Date(date);
          let options = { month: "2-digit", day: "2-digit", year: "numeric" };
          let formattedDate = dateObj.toLocaleDateString(undefined, options);
          return formattedDate;
        };

        $("#receipt_number").text(`${dateTrimmed}-00${reference}`);
        $("#request-date").text(dateOnly(requestdate));
        $("#name").text(`${fname} ${lname}`);
        $("#position").text(position);
        $("#evacuees_qty").text(evacuees_qty);
        $("#status").text(status);
        $("#email").text(requestemail);
        $("#receive_date").text(
          receivedate !== null ? dateOnly(receivedate) : "N/A"
        );
      }

      let tableRows = "";
      let changeName = "";
      let changeQuantity = "";

      if (requestData.length > 0 && requestData[0].status === "pending") {
        // Render onCategoryData for "pending" status
        changeName = "Category";
        changeQuantity = "Estimated Quantity";

        onCategoryData.forEach((item) => {
          const { quantity, category } = item;
          tableRows += `<tr>
            <td>${quantity}</td>
            <td class="fw-bold">${category}</td>
          </tr>`;
        });
      } else {
        // Render onProcessData for other statuses
        changeName = "Product";
        changeQuantity = "Quantity";

        onProcessData.forEach((item) => {
          const { quantity, productName } = item;
          tableRows += `<tr>
            <td>${quantity}</td>
            <td class="fw-bold">${productName}</td>
          </tr>`;
        });
      }

      $("#change_name").text(changeName);
      $("#change_quantity").text(changeQuantity);
      $("#table-container tbody").html(tableRows);
    },
  });
};
