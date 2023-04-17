$(document).ready(() => {
  let table = $("#table_data").DataTable({
    responsive: true,
    headerCallback: function (thead, data, start, end, display) {
      $(thead).find("th").css("font-weight", "bolder");
    },
    ajax: "include/CategoryTable.php",
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
        className: "btn btn-success rounded-0",
        text: '<i class="fas fa-copy"></i> Copy',
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "excelHtml5",
        className: "btn btn-success rounded-0",
        text: '<i class="fas fa-file-excel"></i> Excel',
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "csvHtml5",
        className: "btn btn-success rounded-0",
        text: '<i class="fas fa-file-excel"></i> Csv',
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "pageLength",
        className: "btn btn-success rounded-0",
        text: '<i class="fas fa-file-pageLength"></i> pageLength',
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "pdfHtml5",
        className: "btn btn-success rounded-0",
        text: '<i class="fas fa-file-pdf"></i> PDF',
        exportOptions: {
          columns: ":visible",
        },
        customize: function (doc) {
          doc.content[0].text = "Total Number of Product Per Category";
          doc.pageMargins = [40, 40, 40, 60];
          doc.defaultStyle.fontSize = 12;
          doc.styles.tableHeader.fontSize = 14;
          doc.styles.title = {
            color: "#4c8aa0",
            fontSize: 22,
            alignment: "center",
          };
          doc.content[1].table.widths = ["50%", "50%"]; // adjust column widths
          doc.pageSize = "A4"; // set page size
          doc.pageOrientation = "portrait"; // set page orientation
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

  $(".category-table").append(table.buttons().container());

  $("#copyTable").on("click", function () {
    table.button(".buttons-copy").trigger();
  });
  $(".select-row").on("click", function (e) {
    e.preventDefault();
    table.page.len($(this).data("length")).draw();
  });

  $("#csvTable").on("click", function () {
    table.button(".buttons-csv").trigger();
  });

  $("#excelTable").on("click", function () {
    table.button(".buttons-excel").trigger();
  });

  $("#pdfTable").on("click", function () {
    table.button(".buttons-pdf").trigger();
  });
  //Print category table
  $("#printTable").click(() => {
    printJS({
      printable: "table_data",
      type: "html",
      css: ["../css/mdb.min.css", "../css/style.css"],
      scanStyles: true,
      documentTitle: "",
    });
  });
  $("#printBarChart").click(() => {
    printJS({
      printable: "barChart",
      type: "html",
      css: ["../css/mdb.min.css", "../css/style.css"],
      scanStyles: true,
      documentTitle: "",
    });
  });
});
