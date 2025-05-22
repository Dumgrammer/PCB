<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION['usertype'] != 'a') {
    header("location: ../login.php");
    exit();
}
include("../connection.php");

$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id) {
    header("location: patient.php");
    exit();
}

if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
    // Delete related history and appointments
    $database->query("DELETE FROM history WHERE pid='$id'");
    $database->query("DELETE FROM appointment WHERE pid='$id'");
    $database->query("DELETE FROM patient WHERE pid='$id'");
    header("location: patient.php?status=deleted");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Patient</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="container">
        <div class="popup">
            <center>
                <h2>Are you sure you want to delete this patient?</h2>
                <form method="post">
                    <input type="hidden" name="confirm" value="yes">
                    <button type="submit" class="btn-danger btn">Yes, Delete</button>
                    <a href="patient.php" class="btn-primary btn" style="margin-left: 10px;">Cancel</a>
                </form>
            </center>
        </div>
    </div>
</body>
</html> 