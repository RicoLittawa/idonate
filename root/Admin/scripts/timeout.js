function sessionTimeout() {
  let inactivityTime = 1800000; // Time in milliseconds (30 minute)
  let idleTimeout = 2100000 ; // Time in milliseconds (35 minutes)
  let timeout;
  let lastActivityTime;

  function resetTimer() {
    clearTimeout(timeout);
    timeout = setTimeout(logout, idleTimeout);
  }

  function logout() {
    // Display alert message or perform any other logout actions
    swal.fire("Warning", "Session expired due to inactivity", "warning");
    // Redirect to logout.php for server-side logout
    window.location.href = "../include/logout.php";
  }

  function recordActivity() {
    lastActivityTime = Date.now();
  }

  function checkIdleTimeout() {
    if (Date.now() - lastActivityTime > idleTimeout) {
      logout();
    } else {
      resetTimer();
    }
  }

  // Start tracking user activity
  function startIdleTimeout() {
    lastActivityTime = Date.now();
    resetTimer();
    setInterval(checkIdleTimeout, inactivityTime);
  }

  // Attach event listeners for user activity events
  let activityEvents = [
    "click",
    "keypress",
    "scroll",
    "mousemove",
    "mousedown",
    "mouseup",
    "resize",
    "contextmenu",
    "touchstart",
    "touchmove",
    "touchend",
    "submit",
    "change"
    // Add more events as needed
  ];

  activityEvents.forEach(function(event) {
    document.addEventListener(event, recordActivity);
  });

  // Start the idle timeout countdown when the document is ready
  document.addEventListener("DOMContentLoaded", startIdleTimeout);
}

sessionTimeout();
