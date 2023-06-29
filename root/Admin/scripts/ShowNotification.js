//User notification
const showUserNotification = () => {
  $("#showUserNotification").modal("show");
};

const deleteUserNotification = (notifID) => {
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
const deleteUserNotificationAll = (userID) => {
  $.ajax({
    url: "../include/DeleteNotification.php",
    method: "POST",
    data: { deleteAll: "", userID: userID },
    success: (data) => {
      if (data === "deleted") {
        Swal.fire({
          title: "Success",
          text: "All notifications deleted",
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
//User notification

//Admin Notification
const showAdminNotification = () => {
  $("#showAdmin").modal("show");
};

const deleteAdminNotification = (notifID) => {
  $.ajax({
    url: "../include/DeleteNotification.php",
    method: "POST",
    data: { deleteAdminBtn: "", notifID: notifID },
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

const deleteAllNotificationAdmin = () => {
  $.ajax({
    url: "../include/DeleteNotification.php",
    method: "POST",
    data: { deleteAllAdminBtn: "" },
    success: (data) => {
      if (data === "deleted") {
        Swal.fire({
          title: "Success",
          text: "All notifications deleted",
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
