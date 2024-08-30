<?php

require "../../config/config.php";

if(!isset($_SESSION['adminname'])){
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
  }

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $getImage = $conn->query("SELECT * FROM bookings WHERE id='$id'");
    $getImage->execute();

    $fetch = $getImage->fetch(PDO::FETCH_OBJ);

    unlink("rooms_images/" . $fetch->image);



    $delete = $conn->query("DELETE FROM bookings WHERE id='$id'");
    $delete->execute();


    // header("location: show-bookings.php");
    echo "<script>window.location.href='".ADMINURL."/bookings-admins/show-bookings.php' </script>";


}