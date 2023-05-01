/***********************Populate added users table*******************/
let userTable = $("#user_data").DataTable({
  responsive: true,
  ajax: "../include/DataForDataTables/usersdata.php",
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
        return `<div class="d-flex justify-content-evenly"><a href=""><i class="fa-solid fa-trash text-danger"></i></a>
      <a href=""><i class="fa-solid fa-pen-to-square text-success"></i></a></div>`;
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
  order: [[5, "desc"]],
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
