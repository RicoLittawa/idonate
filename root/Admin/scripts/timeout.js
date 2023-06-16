function sessionTimeout() {
    let inactivityTime = 1800000 ; // Time in milliseconds (5 seconds)
    let timeout;
  
    function resetTimer() {
      clearTimeout(timeout);
      timeout = setTimeout(logout, inactivityTime);
    }
  
    function logout() {
      // Display alert message
      swal.fire("Warning", "Session expired due to inactivity", "warning");
      setTimeout(() => {
        window.location.href = "../include/logout.php";
      }, 1500);
      // Redirect to logout.php for server-side logout
    }
  
    // Array of activity events to listen for
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
  
    // Reset the timer on user activity
    $(document).on(activityEvents.join(" "), resetTimer);
  
    // Start the timer initially
    resetTimer();
  }
  
  // Call the sessionTimeout function when the document is ready
  $(document).ready(sessionTimeout);
  