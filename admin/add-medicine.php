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
        
    <title>Add Medicine</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>
<body>
    <?php
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
        $brand = $_POST['brand'];
        $generic_name = $_POST['generic_name'];
        $quantity = $_POST['quantity'];
        $dosage = $_POST['dosage'];
        $expiration_date = $_POST['expiration_date'];

        // Insert into medicine table
        $sql = "INSERT INTO medicine (brand, generic_name, quantity, dosage, expiration_date) 
                VALUES ('$brand', '$generic_name', '$quantity', '$dosage', '$expiration_date')";
        
        if ($database->query($sql)) {
            header("Location: medicine.php?action=add&error=4");
        } else {
            header("Location: medicine.php?action=add&error=3");
        }
        exit;
    } else {
        header("Location: medicine.php");
        exit;
    }
    ?>
    

<!--  Orginal Author Name: Mayuri K. 
 for any PHP, Codeignitor, Laravel OR Python work contact me at mayuri.infospace@gmail.com  
 Visit website : www.mayurik.com -->  
</body>
</html>