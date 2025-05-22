<?php
session_start();

if (isset($_SESSION["user"])) {
    if ($_SESSION["user"] == "" || $_SESSION['usertype'] != 'a') {
        header("Location: ../login.php");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}

if ($_GET) {
    // Import database
    include("../connection.php");

    $id = $_GET["id"];

    // Optional: Fetch the medicine details before deletion (for logging or confirmation)
    $result = $database->query("SELECT * FROM medicine WHERE id='$id'");
    if ($result->num_rows > 0) {
        $medicine = $result->fetch_assoc();
        $brand = $medicine["brand"];
        $quantity = $medicine["quantity"];
        $expiration_date = $medicine["expiration_date"];

        // You could log or display these values if needed
        // echo "Deleting: $brand, $quantity, $expiration_date";
    }

    // Delete the medicine record
    $sql = $database->query("DELETE FROM medicine WHERE id='$id'");

    header("Location: medicine.php?message=deleted");
    exit();
}
?>
