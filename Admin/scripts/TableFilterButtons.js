$(document).ready(() => {
  /******************************Buttons Filter**************************************/
  const tableBtn = () => {
    let html = "";
    html += `
        <div class="d-flex justify-content-start">
        <div class="dropdown me-2  ">
        <button class="btn btn-secondary dropdown-toggle btn-rounded px-4" type="button" id="dateFilter" data-mdb-toggle="dropdown" aria-expanded="false">
          Select Date
        </button>
        <ul class="dropdown-menu date-filter-dropdown" aria-labelledby="dateFilter"  data-mdb-spy="scroll" data-mdb-target="#scrollspy1" data-mdb-offset="0">
          <li><a class="dropdown-item select-row today" href="#" data-daterange="today">Today</a></li>
          <li><a class="dropdown-item select-row yesterday" href="#" data-daterange="yesterday">Yesterday</a></li>
          <li><a class="dropdown-item select-row seven-days-ago" href="#" data-daterange="seven-days-ago">Last 7 days</a></li>
          <li><a class="dropdown-item select-row thirty-days-ago" href="#" data-daterange="thirty-days-ago">Last 30 days</a></li>
          <li><a class="dropdown-item select-row alltime" href="#" data-daterange="alltime">All Time</a></li>
          <li>
            <a class="dropdown-item select-row custom-date text-muted" href="#" data-daterange="custom-date">
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
            <button class="btn btn-secondary btn-rounded mx-1" id="csvTable">Csv</button>
            <button class="btn btn-secondary btn-rounded mx-1" id="pdfTable">PDF</button>
        </div>
        `;
    return html;
  };
  $(".category-table").append(tableBtn());
  $(".request-table").append(tableBtn());
  $(".donor-download-btn").append(tableBtn());
  /******************************Buttons Filter**************************************/

  /******************************Select Filter**************************************/
  const searchField = () => {
    let html = "";
    html += `<input type="text" class="form-control rounded-pill text-wrap" id="customSearch" placeholder="Search..." />`;
    return html;
  };
  $("#search-field").append(searchField());
  /******************************Select Filter**************************************/

  /******************************Print Function**************************************/
  const printTable = (buttonId, content) => {
    $(buttonId).click(() => {
      printJS({
        printable: content,
        orientation: "landscape",
        type: "html",
        css: [
          "../css/mdb.min.css",
          "../css/style.css",
        ],
        scanStyles: true,
        documentTitle: "",
      });
    });
  };
  printTable("#printBarChart", "barChart");
  printTable("#printRequestCompleted", "request_data");
  printTable("#printCategory", "category_data");
  printTable("#printDonors", "donors_data");
  /******************************Print Function**************************************/


  /******************************Date Filter**************************************/
  let minDate = new DateTime($("#min"), {
    format: "MMMM Do YYYY",
    buttons: {
      today: true,
      clear: true
  }
  });
  let maxDate = new DateTime($("#max"), {
    format: "MMMM Do YYYY",
    buttons: {
      today: true,
      clear: true
  }
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
    let date = new Date(data[4]);

    if (
      (min === null && max === null) ||
      (min === null && date.getTime() <= max.getTime()) ||
      (min.getTime() <= date.getTime() && max === null) ||
      (min.getTime() <= date.getTime() && date.getTime() <= max.getTime())
    ) {
      // filter records based on today, yesterday, and 7 days ago
      const selectRange = $(".select-row.active").data("daterange");
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

});
