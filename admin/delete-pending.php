<?php

session_start();

// Check session
if(isset($_SESSION["user"])){
    if(($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a'){
        header("location: ../login.php");
        exit();
    }
} else {
    header("location: ../login.php");
    exit();
}

if($_GET){
    // Import database
    include("../connection.php");

    $id = $_GET["id"]; // Assuming you are passing the 'id' to delete a specific medicine

    // Delete query for the medicine table
    $sql = $database->query("DELETE FROM patient WHERE id = '$id';");

    // Redirect to the medicine page
    header("location: medicine.php"); // Assuming the list of medicines is on this page
    exit();
}

?>
