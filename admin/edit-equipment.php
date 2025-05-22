<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="GinaFAcuna">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>PCB CLINIC</title>
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
    if ($_SESSION["user"] == "" || $_SESSION['usertype'] != 'a') {
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
    $id = $_POST['id'] ?? null;
    $item_name = $_POST['item_name'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $date = $_POST['date'] ?? '';

    if ($id) {
        // Use prepared statement for secure update
        $stmt = $database->prepare("UPDATE equipment SET item_name = ?, quantity = ?, date = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("sisi", $item_name, $quantity, $date, $id);

            if ($stmt->execute()) {
                $error = '4'; // success
            } else {
                $error = '1'; // database error
            }

            $stmt->close();
        } else {
            $error = '1'; // prepare failed
        }
    } else {
        $error = '2'; // ID missing
    }

    // Redirect back to equipment page with status code
    header("location: equipment.php?action=edit&error=$error");
    exit();
}
?>
</body>
</html>
