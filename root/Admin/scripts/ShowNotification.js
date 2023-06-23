const showNotification = (userID) => {
  $("#showNotification").modal("show");
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
            <i class="fa-solid fa-xmark text-danger allowed ps-5 ms-5" onClick="deleteNotification(${item.notifID})"></i>
        </li>`;
      });
      notificationList += "</ul>";
      $("#notification-list").html(notificationList);
      if (data.count > 0) {
        $("#notifCount").text(`You have ${data.count} new notifications`);
        $("#deleteAll").show();
      } else {
        $("#notifCount").text("You don't have any notifications.");
        $("#deleteAll").hide();
      }
    },
  });
};

const showToast = (status) => {
  const toastContainer = $("#toastContainer");

  // Create toast element
  const toast = $('<div class="toast text-light text-center"></div>').text(
    "Notification deleted"
  );

  // Set background color based on status
  if (status === "error") {
    toast.addClass("bg-danger");
  } else {
    toast.addClass("bg-danger");
  }

  // Add toast to container
  toastContainer.append(toast);

  // Show toast
  toast.addClass("show");

  // Automatically hide toast after 3 seconds
  setTimeout(() => {
    toast.removeClass("show");
    // Remove toast from container after animation
    setTimeout(() => {
      toast.remove();
    }, 300);
  }, 3000);
};

const deleteNotification = (notifID) => {
  $.ajax({
    url: "../include/DeleteNotification.php",
    method: "POST",
    data: { deleteBtn: "", notifID: notifID },
    success: (data) => {
      if (data === "deleted") {
        Swal.fire({
          title: "Success",
          text: "Notification deleted",
          icon: "success",
          confirmButtonColor: "#20d070",
          confirmButtonText: "OK",
          allowOutsideClick: false,
          timer: 1500,
        });
        setTimeout(() => {
          window.location.reload();
        }, 2500);
      } else {
        return;
      }
    },
  });
};
const deleteAll = (userID) => {
  alert(userID);
};
