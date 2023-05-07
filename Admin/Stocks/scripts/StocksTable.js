let stocksTable = $("#stocks_data").DataTable({
  responsive: true,
  ajax: {
    url: "include/stocksdata.php",
    error: function (xhr, error, thrown) {
      if (xhr.status === 404) {
        $("#stocks_data").html("<p>No data available</p>");
      } else {
        alert("There was an error retrieving data. Please try again.");
      }
    },
  },
  columns: [
    {
      data: "category",
    },
    {
      data: "product",
      render: (data, type, row) => {
        return `${data}<span class="badge rounded-pill badge-info">${row.type}</span>`;
      },
    },
    {
      data: "quantity",
      render: (data, type, row) => {
        if (row.quantity <= 0) {
          return `<span class="badge rounded-pill badge-danger">Out of Stock</span>`;
        }
        return `${data}<span class="fw-light">&nbsp${row.unit}</span>`;
      },
    },
    {
      data: "distributed",
      render: (data, type, row) => {
        return data !== 0
          ? data
          : `<span class="badge rounded-pill badge-warning">N/A</span>`;
      },
    },
    {
      data: null,
      render: function (data, type, row) {
        return `<button type="button" class="btn btn-success btn-rounded" id="addExpiry"><i class="fa-solid fa-plus"></i></button>`;
      },
    },
  ],
  buttons: [
    {
      extend: "copyHtml5",
      filename: "Stocks data", // set the file name
    },
    {
      extend: "excelHtml5",
      filename: "Stocks data", // set the file name
    },
    {
      extend: "csvHtml5",
      filename: "Stocks data", // set the file name
    },
    {
      extend: "pageLength",
    },
    {
      extend: "pdfHtml5",
      filename: "Stocks data", // set the file name
      customize: (doc) => {
        doc.content[0].text = "Stocks data";
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
      .columns(0)
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

/******************************Filter button initializations**************************************/
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
initializeTableButtons(".stocks-download-btn", stocksTable);

const filterInitialization = (tableName) => {
  // Custom search
  $(document).on("keyup", "#customSearch", (event) => {
    tableName.search($(event.target).val()).draw();
  });
};
filterInitialization(stocksTable);
/******************************Filter button initializations**************************************/

/******************************Expiry function**************************************/
$(document).on("click", "#addExpiry", () => {
  alert("working");
});
