/******************************Buttons Filter**************************************/
const tableBtn = () => {
  let html = `
        <div class="d-flex justify-content-start">
        <div class="dropdown me-2 ${
          !window.location.pathname.includes("Donors.php") &&
          !window.location.pathname.includes("UserCreateRequest.php") &&
          !window.location.pathname.includes("Request.php")
            ? "d-none"
            : ""
        } ">
        <button class="btn btn-secondary dropdown-toggle btn-rounded px-4" type="button" id="dateFilter" data-mdb-toggle="dropdown" aria-expanded="false">
          Select Date
        </button>
        <ul class="dropdown-menu date-filter-dropdown" aria-labelledby="dateFilter"  data-mdb-spy="scroll" data-mdb-target="#scrollspy1" data-mdb-offset="0">
          <li><a class="dropdown-item select-date today" href="#" data-daterange="today">Today</a></li>
          <li><a class="dropdown-item select-date yesterday" href="#" data-daterange="yesterday">Yesterday</a></li>
          <li><a class="dropdown-item select-date seven-days-ago" href="#" data-daterange="seven-days-ago">Last 7 days</a></li>
          <li><a class="dropdown-item select-date thirty-days-ago" href="#" data-daterange="thirty-days-ago">Last 30 days</a></li>
          <li><a class="dropdown-item select-date alltime" href="#" data-daterange="alltime">All Time</a></li>
          <li>
            <a class="dropdown-item select-date custom-date text-muted" href="#" data-daterange="custom-date">
              Custom Range <i class="fa-solid fa-calendar-days"></i>
              <div class="d-block ">
                <div class="form-group">
                  <label class="form-label" for="min">From:</label>
                  <input type="text" class="form-control" id="min" name="min">
                </div>
                <div class"form-group">
                  <label class="form-label" for="max">To:</label>
                  <input type="text" class="form-control" id="max" name="max">
                </div>
              </div>
            </a>
          </li>
        </ul>
      </div>
            <div class="dropdown  me-2">
            <button class="btn btn-secondary dropdown-toggle btn-rounded" type="button" id="pageTable" data-mdb-toggle="dropdown" aria-expanded="false">
                Select
            </button>
            <ul class="dropdown-menu" aria-labelledby="pageTable">
                <li><a class="dropdown-item select-row" href="#" data-length="10">10 rows</a></li>
                <li><a class="dropdown-item select-row" href="#" data-length="25">25 rows</a></li>
                <li><a class="dropdown-item select-row" href="#" data-length="50">50 rows</a></li>
                <li><a class="dropdown-item select-row" href="#" data-length="-1">All</a></li>
            </ul>
            </div>
            <button class="btn btn-secondary btn-rounded mx-1" id="copyTable">Copy</button>
            <button class="btn btn-secondary btn-rounded mx-1" id="excelTable">Excel</button>
            <button class="btn btn-secondary btn-rounded mx-1" id="pdfTable">PDF</button>
        </div>
        `;
  return html;
};
$(".category-table").append(tableBtn());
$(".request-table").append(tableBtn());
$(".donor-download-btn").append(tableBtn());
$(".request-download-btn").append(tableBtn());
$(".stocks-download-btn").append(tableBtn());
$(".user-download-btn").append(tableBtn());
$(".create-request-download-btn").append(tableBtn());

/******************************Buttons Filter**************************************/

/******************************Select Filter**************************************/
const searchField = () => {
  let html = `<input type="text" class="form-control rounded-pill text-wrap" id="customSearch" placeholder="Search..." />`;
  return html;
};
$("#search-field").append(searchField());
/******************************Select Filter**************************************/

/******************************Print Function**************************************/
const printTable = (buttonId, content) => {
  $(buttonId).click(() => {
    printJS({
      printable: content,
      orientation: "Portrait",
      type: "html",
      css: ["../css/mdb.min.css", "../css/style.css"],
      scanStyles: true,
      documentTitle: "",
    });
  });
};
printTable("#printBarChart", "barChart");
printTable("#printReceipt", "printable_area");
/******************************Print Function**************************************/

/******************************Delete Function**************************************/
const deleteRow = (id,url,tableName) => {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#20d070",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: url,
        method: "POST",
        data: { deleteBtn: "", id: id },
        success: () => {
          Swal.fire({
            title: "Success",
            text: "Request deleted successfully",
            icon: "success",
            confirmButtonColor: "#20d070",
            confirmButtonText: "OK",
            allowOutsideClick: false,
            timer:1500
          });
          $(tableName).DataTable().ajax.reload();
        },
      });
    }
  });
};

/******************************Delete Function**************************************/
