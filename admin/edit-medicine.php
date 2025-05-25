<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Mayuri K">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Edit Medicine</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>
<body>
<?php
session_start();

// Authentication check
if (isset($_SESSION["user"])) {
    if (($_SESSION["user"] == "") || ($_SESSION['usertype'] != 'a')) {
        header("location: ../login.php");
        exit();
    }
} else {
    header("location: ../login.php");
    exit();
}

// Database connection
include("../connection.php");

// POST form processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get values safely
    $id = $_POST['id'] ?? null;
    $brand = $_POST['brand'] ?? '';
    $generic_name = $_POST['generic_name'] ?? '';
    $quantity = $_POST['quantity'] ?? 0;
    $dosage = $_POST['dosage'] ?? '';
    $expiration_date = $_POST['expiration_date'] ?? '';

    if ($id) {
        // Update query
        $sql = "UPDATE medicine SET 
                    brand = '$brand',
                    generic_name = '$generic_name',
                    quantity = '$quantity',
                    dosage = '$dosage',
                    expiration_date = '$expiration_date'
                WHERE id = '$id'";

            // Run query
            if ($database->query($sql)) {
                $error = '4'; // success code
            } else {
                $error = '1'; // db error code
            }
        } else {
            $error = '2'; // missing id
    }

    // Redirect back to medicine list with status
    header("location: medicine.php?action=edit&error=$error");
    exit();
}
?>
</body>
</html>
