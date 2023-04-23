$(document).ready(() => {
  /***********************Table Initialization*******************************/
  let donorTable = $("#donors_data").DataTable({
    lengthMenu: [
      [10, 25, 50, -1],
      [10, 25, 50, "All"],
    ],
    responsive: true,
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
        data: null,
        render: function (data, type, row) {
          if (row.emailStatus === "not sent") {
            return `<input type = "checkbox"
                name = "single_select"
                class = "single_select form-check-input"
                data-email = "${row.donorEmail}"
                data-name = "${row.donorName}"
                data-id = "${row.donorId}">`;
          } else {
            return `<a href="updatedonate.php?editdonate=${row.donorId}"><i class="fa-solid fa-pen-to-square text-success"></i></a>`;
          }
        },
      },
      {
        data: "donorName",
      },
      {
        data: "donorEmail",
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
            ? '<span class="badge badge-success">Sent</span>'
            : `<button type="button" class="btn btn-secondary email_button col btn-rounded" name="email_button" data-id="${row.donorId}" 
              data-email="${row.donorEmail}" data-name="${row.donorName}"  data-action="single">Send</button>`;
        },
      },
      {
        data: "certificate",
        render: (data, type, row) => {
          return data !== "cert empty"
            ? `<button type="button" class="btn btn-secondary btn-rounded" data-donor-id="${row.donorId}" id="btnCert">
              <i class="fa-solid fa-print"></i></button>`
            : '<span class="badge badge-warning user-select-none not-allowed">N/A</span';
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          return `<a href="#"><i class="fa-solid fa-trash text-danger"></i></a>`;
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
            fontSize:14,
            bold: true,
            alignment:"left"

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
    order: [[3, "desc"]],
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
    $(document).on("change","#min, #max", ()=> {
      tableName.draw();
    });
    //Date filter options
    $(document).on("click", '.select-row', (event) =>{
      event.preventDefault();
      const filterRange = $(event.target).data("daterange");
      const filters = ["today", "yesterday", "seven-days-ago", "thirty-days-ago", "alltime", "custom-date"];
      const $rows = filters.map(filter => $(`.${filter}`));
      $rows.forEach($row => $row.toggleClass("active", $row.hasClass(filterRange)));
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

    $.ajax({
      url: "include/sendcerti.php",
      method: "POST",
      data: {
        email_data: email_data,
      },
      beforeSend: function () {
        $this.attr("disabled", true);
        $this.html("Sending...");
        $this.addClass("btn btn-outline-danger");
      },
      success: function (data) {
        if (data == "Inserted") {
          $this.attr("disabled", false);
          $this.removeClass("btn btn-outline-danger");
          $this.addClass("btn btn-outline-success");
          $this.html("Sent");
          Swal.fire({
            icon: "success",
            title: "Sent",
            text: "Email has been sent",
            timer: 1500,
          });
          table.ajax.reload();
        } else {
          $this.text(data);
        }
      },
    });
  });

  /***********************Send certificate through email*******************************/
  $(document).on('click', '#btnCert', (event) => {
    let donor_id = $(event.target).attr('data-donor-id');
    $.ajax({
      url: 'include/ViewCertificate.php?viewCert=' + donor_id,
      method: 'GET',
      success: function(data) {
        printJS('../include/download-certificate/'+data, 'image')
      }
    });
  });

  /***********************Route to AddPage and Select All*******************************/
    $('#addPage').click(() => {
      window.location.href = "additemdonations.php?fillupform";
    });
    $('#selectAll').click((event) => {
      $("input[type=checkbox]").prop('checked', $(event.target).prop('checked'));

    });
  

});
