<?php 
session_start();
    require("config.php");
    $id = $_GET["uid"];
    $q = mysqli_query($conn, "DELETE FROM poll WHERE id = '$id'");
    if ($q) {
        $_SESSION['deleted'] = "Successfully Deleted";
        header("location: index.php");
        exit(0);
    } else {
        $_SESSION['deleted'] = "Data not deleted";
        header("location: index.php");
        exit(0);
    }
        
?>