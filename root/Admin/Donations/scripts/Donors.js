/***********************Table Initialization*******************************/
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
let donorTable = $("#donors_data").DataTable({
  ajax: {
    url: "include/donorsdata.php",
    error: function (xhr, error, thrown) {
      if (xhr.status === 404) {
        $("#donors_data").html("<p>No data available</p>");
      } else {
        alert("There was an error retrieving data. Please try again.");
      }
    },
  },
  columns: [
    {
      data: "donorName",
      render: (data, type, row) => {
        return `<p class="fw-bold mb-1">${data}</p>
          <p class="text-muted mb-0">${row.donorEmail}</p>
          `;
      },
    },
    {
      data: "donorContact",
    },
    {
      data: "donationDate",
    },
    {
      data: "emailStatus",
      render: (data, type, row) => {
        return data !== "not sent"
          ? '<span class="badge badge-success d-flex justify-content-center">Sent</span>'
          : `<button type="button" class="btn btn-secondary email_button btn-rounded" name="email_button" data-id="${row.donorId}" 
              data-email="${row.donorEmail}" data-name="${row.donorName}"  data-action="single">Send</button>`;
      },
    },
    {
      data: "certificate",
      render: (data, type, row) => {
        return data !== "cert empty"
          ? `<button type="button" class="btn btn-secondary btn-rounded" data-donor-id="${row.donorId}" id="btnCert">
              <i class="fa-solid fa-print"></i></button>`
          : '<span class="badge badge-warning user-select-none not-allowed d-flex justify-content-center">N/A</span';
      },
    },
    {
      data: null,
      render: function (data, type, row) {
        return `<a class="d-flex justify-content-center" href="UpdateDonors.php?editdonate=${row.donorId}"><i class="fa-solid fa-pen-to-square text-success"></i></a>`;
      },
    },
    {
      data: null,
      render: function (data, type, row) {
        if (row.emailStatus === "not sent") {
          return `<div class="d-flex justify-content-center"><input type = "checkbox"
                name = "single_select"
                class = "single_select form-check-input "
                data-email = "${row.donorEmail}"
                data-name = "${row.donorName}"
                data-id = "${row.donorId}"></div>`;
        } else {
          return `<a class="d-flex justify-content-center" onclick="deleteRow(${row.reference},'include/DeleteDonor.php','#donors_data')">
            <i class="fa-solid fa-trash text-danger"></i></a>`;
        }
      },
    },
  ],
  buttons: [
    {
      extend: "copyHtml5",
      filename: "Donors Date", // set the file name
    },
    {
      extend: "excelHtml5",
      filename: "Donors Date", // set the file name
    },
    {
      extend: "csvHtml5",
      filename: "Donors Date", // set the file name
    },
    {
      extend: "pageLength",
    },
    {
      extend: "pdfHtml5",
      filename: "Donors Date", // set the file name
      customize: (doc) => {
        doc.content[0].text = "Donors Date";
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
  order: [[2, "desc"]],
  lengthMenu: [
    [10, 25, 50, -1],
    ["10 rows", "25 rows", "50 rows", "Show all"],
  ],

  searchDelay: 500,
  dom: "frtip",
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
initializeTableButtons(".donor-download-btn", donorTable);

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
filterInitialization(donorTable);

/***********************Send certificate through email*******************************/
$(document).on("click", ".email_button", (event) => {
  const $this = $(event.target);
  let action = $this.data("action");
  let email_data = [];

  if (action == "single") {
    email_data.push({
      email: $this.data("email"),
      name: $this.data("name"),
      uID: $this.data("id"),
    });
    $("#bulk_email").attr("disabled", true);
  } else {
    let $checkedBoxes = $(".single_select:checked");
    if ($checkedBoxes.length === 0) {
      $this.attr("disabled", true);
      return;
    }

    $checkedBoxes.each((index, element) => {
      const $this = $(element);
      email_data.push({
        email: $this.data("email"),
        name: $this.data("name"),
        uID: $this.data("id"),
      });
    });
  }
  /****************Alert function********************************************************************/
  const alertMessage = (title, text, icon) => {
    Swal.fire({
      title: title,
      text: text,
      icon: icon,
      timer: 1500,
      confirmButtonColor: "#20d070",
      confirmButtonText: "OK",
      allowOutsideClick: false,
    });
  };
  /****************Alert function********************************************************************/
  $.ajax({
    url: "../include/sendcerti.php",
    method: "POST",
    data: {
      email_data: email_data,
    },
    beforeSend: function () {
      $this.attr("disabled", true);
      $this.html("Sending...");
      $this.addClass("btn btn-outline-danger");
    },
    success: function (response) {
      if (response.status == "Success") {
        $this.attr("disabled", false);
        $this.removeClass("btn btn-outline-danger");
        $this.addClass("btn btn-outline-success");
        $("#bulk_email").attr("disabled", false);
        $this.html("Sent");
        alertMessage(response.status, response.message, response.icon);
        donorTable.ajax.reload();
      } else {
        $this.text(responses.message);
      }
    },
  });
});

/***********************Send certificate through email*******************************/
$(document).on("click", "#btnCert", (event) => {
  let donor_id = $(event.target).attr("data-donor-id");
  $.ajax({
    url: "include/ViewCertificate.php?viewCert=" + donor_id,
    method: "GET",
    success: function (data) {
      printJS("../include/download-certificate/" + data, "image");
    },
  });
});

/***********************Route to AddPage and Select All*******************************/
$("#addPage").click(() => {
  window.location.href = "AddDonor.php?fillupform";
});
$("#selectAll").click((event) => {
  $("input[type=checkbox]").prop("checked", $(event.target).prop("checked"));
});
