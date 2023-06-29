let productsTable = $("#products_data").DataTable({
    ajax: {
      url: "../Stocks/include/stocksdata.php",
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
        render:(data,type,row)=>{
            return `<p class="fw-bold">${data}</p>`
        }
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
    ],
    order: [[0, "asc"]],
    lengthMenu: [
      [10, 25, 50, -1],
      ["10 rows", "25 rows", "50 rows", "Show all"],
    ],
    buttons: [
        {
          extend: "pageLength",
        },
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
            .appendTo($("#category_filter"))
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

  $(".select-row").on("click", (event) => {
    event.preventDefault();
   productsTable.page.len($(event.target).data("length")).draw();
  });