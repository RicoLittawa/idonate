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
        if (!row.type || row.type.toLowerCase() === "n/a") {
          return data;
        }

        return `${data}<span class="badge rounded-pill badge-info">${row.type}</span>`;
      },
    },

    {
      data: "quantity",
      render: (data, type, row) => {
        if (row.quantity <= 0) {
          return `<span class="badge rounded-pill badge-danger">Out of Stock</span>`;
        } else {
          return row.unit === "N/A" || row.unit === "" || row.unit === null
            ? data
            : `${data}<span class="badge rounded-pill badge-info">&nbsp${row.unit}</span>`;
        }
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
  ],
  buttons: [
    {
      extend: "copyHtml5",
    },
    {
      extend: "excelHtml5",
      filename: "Stocks Data",
      exportOptions: {
        columns: [0, 1, 2, 3],
      },
    },
    {
      extend: "pageLength",
    },
    {
      extend: "pdfHtml5",
      filename: "Stocks Data",
      exportOptions: {
        columns: [0, 1, 2, 3],
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
              text: "Stocks Data",
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
        doc.content[1].margin = [100, 0, 100, 0]; //left, top, right, bottom
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
        doc.content[1].table.widths = ["auto", "auto", "auto", "auto"];
        doc.content[1].table.body.forEach((row) => {
          row.forEach((cell, i) => {
            cell.alignment = i === 0 ? "left" : "center"; // Adjust alignment for each column
          });
        });
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
