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
        
    <title>Doctor</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
    <?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    

    //import database
    include("../connection.php");

    $error = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $appoid = $_POST['appoid'];
        $medicine = $_POST['medicine'];
        $dosage = $_POST['dosage'];
        $instructions = $_POST['instructions'];

        // Get patient ID from appointment
        $appq = $database->query("SELECT pid FROM appointment WHERE appoid='$appoid'");
        $app = $appq->fetch_assoc();
        $pid = $app['pid'];

        // Insert into history table
        $sql = "INSERT INTO history (appoid, pid, medicine, dosage, instructions, date_given) 
                VALUES ('$appoid', '$pid', '$medicine', '$dosage', '$instructions', NOW())";
        
        if ($database->query($sql)) {
            header("Location: appointment.php?action=view&id=$appoid&status=success");
        } else {
            header("Location: appointment.php?action=view&id=$appoid&error=" . urlencode($database->error));
        }
        exit;
    } else {
        header("Location: appointment.php");
        exit;
    }

    ?>
    

<!--  Orginal Author Name: Mayuri K. 
 for any PHP, Codeignitor, Laravel OR Python work contact me at mayuri.infospace@gmail.com  
 Visit website : www.mayurik.com -->  
</body>
</html>