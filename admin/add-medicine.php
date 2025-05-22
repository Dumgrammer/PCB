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



    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand_name = trim($_POST['brand_name']);
    $generic_name = trim($_POST['generic_name']);
    $quantity = intval($_POST['quantity']);
    $dosage = trim($_POST['dosage']);
    $expiration_date = $_POST['expiration_date'];

    // Optional: basic validation
    if (!$brand_name || !$generic_name || !$quantity || !$dosage || !$expiration_date) {
        die("All fields are required.");
    }

    $stmt = $database->prepare("INSERT INTO medicine (brand_name, generic_name, quantity, dosage, expiration_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $brand_name, $generic_name, $quantity, $dosage, $expiration_date);

    if ($stmt->execute()) {
        echo "Medicine record inserted successfully.";
    } else {
        echo "Error inserting record: " . $stmt->error;
    }

    $stmt->close();
}

                
    
    
           }
    header("location: medicine.php?action=add&error=".$error);

    ?>
    

<!--  Orginal Author Name: Mayuri K. 
 for any PHP, Codeignitor, Laravel OR Python work contact me at mayuri.infospace@gmail.com  
 Visit website : www.mayurik.com -->  
</body>
</html>