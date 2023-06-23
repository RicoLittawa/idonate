const showAlertNotification = () => {
  let userID = $("#userID").val();
  $.ajax({
    url: `../include/GetNotification.php?userID=${userID}`,
    method: "GET",
    dataType: "json",
    success: (data) => {
      let notificationList = "<ul class='list-group list-group-light'>";
      data.data.forEach((item) => {
        let dateObj = new Date(item.timestamp);
        let options = { timeZone: "Asia/Manila" };
        let formattedDateTime = dateObj.toLocaleString("en-PH", options);
        notificationList += `
            <li class="list-group-item d-flex justify-content-between align-items-center lead fs-6">
              <div class="d-block">
                <span class="mb-0 me-0 ms-0 fw-bold">
                <i class="fa-solid fa-circle text-primary me-2"></i>
                ${item.message}</span>
                <h6  class="fw-lighter text-muted mb-0">${formattedDateTime}</h6>
              </div>
                <i class="fa-solid fa-xmark text-danger allowed ps-5" onClick="deleteNotification(${item.notifID})"></i>
            </li>`;
      });
      notificationList += "</ul>";
      $("#notification-list").html(notificationList);
      if (data.count > 0) {
        $("#showNotification").modal("show");
        $("#notifCount").text(`You have ${data.count} new notifications`);
        $("#deleteAll").show();
      } else {
        $("#notifCount").text("You don't have any notifications.");
        $("#deleteAll").hide();
      }
    },
  });
};
showAlertNotification();
