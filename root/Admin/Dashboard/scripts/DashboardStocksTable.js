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
       filename: "List of category", // set the file name
     },
     {
       extend: "excelHtml5",
       filename: "List of category", // set the file name
     },
     {
       extend: "csvHtml5",
       filename: "List of category", // set the file name
     },
     {
       extend: "pageLength",
       filename: "List of category", // set the file name
     },
     {
       extend: "pdfHtml5",
       filename: "List of category", // set the file name
       customize: (doc) => {
         doc.content[0].text = "Total Number of Product Per Category";
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
      data: "recievedate",
      render: (data, type, row) => {
        let dateObj = new Date(data);
        let options = { month: "2-digit", day: "2-digit", year: "numeric" };
        let formattedDate = dateObj.toLocaleDateString(undefined, options);
        return formattedDate;
      }
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
       filename: "Request Completed", // set the file name
     },
     {
       extend: "excelHtml5",
       filename: "Request Completed", // set the file name
     },
     {
       extend: "csvHtml5",
       filename: "Request Completed", // set the file name
     },
     {
       extend: "pageLength",
     },
     {
       extend: "pdfHtml5",
       filename: "Request Completed", // set the file name
       customize: (doc) => {
         doc.content[0].text = "Request Completed";
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
