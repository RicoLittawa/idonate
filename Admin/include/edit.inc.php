<?php

    include 'connection.php';
    if (isset($_POST["updateBtn"]))
    {
      $donorid = $_POST['donorid'];
      echo $donorid;
      return;
      $reference_id= $_POST['reference_id'];
      $Fname= $_POST['fname'];
      $Province= $_POST['province'];
      $Street = $_POST['street'];
      $Region = $_POST['region'];
      $Email= $_POST['email'];
      $Date= date('Y-m-d', strtotime($_POST['donation_date']));
      $Category= $_POST['category_arr'];
      $Variant= $_POST['variant_arr'];
      $Quantity= $_POST['quantity_arr'];
    }