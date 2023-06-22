//Populate category table on dashboard
const category_table = $("#category_data").DataTable({
  responsive: true,
  headerCallback: function (thead) {
    $(thead).find("th").css("font-weight", "bolder");
  },
  ajax: {
    url: "include/CategoryTable.php",
    error: function (xhr, error, thrown) {
      if (xhr.status === 404) {
        $("#request_data").html("<p>No data available</p>");
      } else {
        alert("There was an error retrieving data. Please try again.");
      }
    },
  },
  columns: [
    {
      data: "category",
      className: "fw-bold",
    },
    {
      data: "quantity",
    },
  ],
  order: [[1, "Desc"]],
  buttons: [
    {
      extend: "copyHtml5",
    },
    {
      extend: "excelHtml5",
      exportOptions: {
        columns: [0, 1],
      },
    },
    {
      extend: "pageLength",
    },
    {
      extend: "pdfHtml5",
      filename: "List of Category",
      exportOptions: {
        columns: [0, 1],
      },
      customize: (doc) => {
        let docDefinition = {
          header: {
            columns: [
              {
                stack: [
                  { text: "Republic of the Philippines", alignment: "center" },
                  {
                    text: "City Disaster Risk Reduction Management Office Batangas City",
                    alignment: "center",
                  },
                ],
              },
            ],
            margin: [0, 10, 0, 0], // Adjust the top margin here
          },
          content: [
            {
              text: "Category",
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
        doc.content[1].margin = [170, 0, 170, 0]; //left, top, right, bottom
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
        doc.content[1].table.widths = ["auto", "auto"];
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
  searching: false,
  dom: "frtip",
});
//Populate request table on dashboard

const request_table = $("#request_data").DataTable({
  responsive: true,
  headerCallback: function (thead) {
    $(thead).find("th").css("font-weight", "bolder");
  },
  ajax: {
    url: "include/Completed.php",
    error: function (xhr, error, thrown) {
      if (xhr.status === 404) {
        $("#request_data").html("<p>No data available</p>");
      } else {
        alert("There was an error retrieving data. Please try again.");
      }
    },
  },
  columns: [
    {
      data: "request_id",
      render: (data, type, row) => {
        return row.requestdate + "-00" + row.request_id;
      },
    },
    {
      data: "receivedate",
      render: (data, type, row) => {
        let dateObj = new Date(data);
        let options = { month: "2-digit", day: "2-digit", year: "numeric" };
        let formattedDate = dateObj.toLocaleDateString(undefined, options);
        return formattedDate;
      },
    },
    {
      data: "status",
      render: (data, type, row) => {
        return `<span class="badge badge-success user-select-none not-allowed">${row.status}</span>`;
      },
    },
  ],
  order: [[1, "Desc"]],
  buttons: [
    {
      extend: "copyHtml5",
    },
    {
      extend: "excelHtml5",
      filename: "Request Completed",
      exportOptions: {
        columns: [0, 1, 2],
      },
    },
    {
      extend: "pageLength",
    },
    {
      extend: "pdfHtml5",
      filename: "Request Completed",
      exportOptions: {
        columns: [0, 1, 2],
      },
      customize: (doc) => {
        let docDefinition = {
          header: {
            columns: [
              {
                stack: [
                  { text: "Republic of the Philippines", alignment: "center" },
                  {
                    text: "City Disaster Risk Reduction Management Office Batangas City",
                    alignment: "center",
                  },
                ],
              },
            ],
            margin: [0, 10, 0, 0], // Adjust the top margin here
          },
          content: [
            {
              text: "Request Completed",
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
        doc.content[1].table.widths = ["auto", "auto", "auto"];
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
  searching: false,
  dom: "frtip",
});

//Initialize filter buttons
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

initializeTableButtons(".category-table", category_table);
initializeTableButtons(".request-table", request_table);
