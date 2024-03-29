<?php
session_start();

if (isset($_SESSION['user'])&& $_SESSION['loggedin'] === true) {
    $userID = $_SESSION['user']['uID'];
    $userRole = $_SESSION['user']['role'];

} else {
    //User is not logged in, redirect to login page
    header("Location: ../login.php?Loginfirst");
    exit();
}
// Set the pages that are restricted to admin users
$restricted_pages = array("Dashboard.php", "Donors.php", "AddDonor.php", "UpdateDonors.php",
"Request.php","ReceiveRequest.php","ViewRequestReceipt.php","Stocks.php","UpdateAccount.php",
"UpdatePassword.php","Users.php","settings.php");

$user_restricted_pages= array("UserCreateRequest.php","UserUpdatePassword.php","UserUpdateProfile.php",
"ViewCreatedRequest.php","UserLandingPage.php");

// Check if the current page is restricted and the user has the admin role
if (in_array(basename($_SERVER["SCRIPT_FILENAME"]), $restricted_pages) && $userRole !== "admin") {
    // Redirect the user to the login page if they don't have the admin role
    header("Location: ../error/ForbiddenPage.html");
    exit();
}

if (in_array(basename($_SERVER["SCRIPT_FILENAME"]), $user_restricted_pages) && $userRole !== "user") {
    // Redirect the user to the login page if they don't have the admin role
    header("Location: ../error/ForbiddenPage.html");
    exit();
}


?>
