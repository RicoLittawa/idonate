const showNotification = (userID) => {
  $("#showNotification").modal("show");
  $.ajax({
    url: `../include/GetNotification.php?userID=${userID}`,
    method: "GET",
    dataType: "json",
    success: (data) => {
      let notificationList = "<ul class='list-group list-group-light'>";
      data.data.forEach((item) => {
        notificationList += `<li class="list-group-item d-flex justify-content-between align-items-center lead fs-6">
                                  ${item.message}
                                  <span class="ps-5 d-flex">
                                  <i class="fa-solid fa-check pe-3"></i>
                                  <i class="fa-solid fa-xmark text-danger"></i></span>
                              </li>`;
      });
      notificationList += "</ul>";
      $("#notification-list").html(notificationList);
      $("#notificationCount").html(data.count)
    },
  });
};

const showNotifCount= ()=>{

}