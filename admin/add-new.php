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



    if($_POST){
        //print_r($_POST);
        $result= $database->query("select * from webuser");
        $name=$_POST['name'];
        $nic=$_POST['nic'];
        $spec=$_POST['spec'];
        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        
        if ($password==$cpassword){
            $error='3';
            // First check if email already exists in webuser table
            $result = $database->query("SELECT * FROM webuser WHERE email='$email'");
            if($result->num_rows > 0){
                $error='1'; // Email already exists
            } else {
                try {
                    // Start transaction
                    $database->begin_transaction();
                    
                    // Insert into doctor table
                    $sql1 = "INSERT INTO doctor(docemail,docname,docpassword,docnic,doctel,specialties) VALUES('$email','$name','$password','$nic','$tele','$spec')";
                    $database->query($sql1);
                    
                    // Insert into webuser table with admin type only
                    // Since email is primary key, we can only have one entry per email
                    // We'll use 'a' (admin) so doctors can log in as admins
                    $sql2 = "INSERT INTO webuser(email,usertype) VALUES('$email','a')";
                    $database->query($sql2);
                    
                    // Commit transaction
                    $database->commit();
                    $error = '4'; // Success
                } catch (Exception $e) {
                    // Rollback transaction on error
                    $database->rollback();
                    $error = '3'; // Generic error
                    // For debugging
                    // file_put_contents('error_log.txt', date('Y-m-d H:i:s') . ': ' . $e->getMessage() . "\n", FILE_APPEND);
                }
            }
            
        }else{
            $error='2';
        }
    
    
        
        
    }else{
        //header('location: signup.php');
        $error='3';
    }
    

    header("location: doctors.php?action=add&error=".$error);
    ?>
    

<!--  Orginal Author Name: Mayuri K. 
 for any PHP, Codeignitor, Laravel OR Python work contact me at mayuri.infospace@gmail.com  
 Visit website : www.mayurik.com -->  
</body>
</html>