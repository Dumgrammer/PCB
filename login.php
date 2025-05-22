<?php
session_start();
// Do NOT reset session variables here!
// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$_SESSION["date"]=$date;
//import database
include("connection.php");
if($_POST){
    $email=$_POST['useremail'];
    $password=$_POST['userpassword'];
    $error='<label for="promter" class="form-label"></label>';
    $result= $database->query("select * from webuser where email='$email'");
    if($result->num_rows==1){
        $utype=$result->fetch_assoc()['usertype'];
        if ($utype=='p'){
            //TODO
            $checker = $database->query("select * from patient where pemail='$email' and ppassword='$password'");
            if ($checker->num_rows==1){
                //   Patient dashbord
                $_SESSION['user']=$email;
                $_SESSION['usertype']='p';
                header('location: patient/index.php');
            }else{
                $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }
        }elseif($utype=='a'){
            //TODO
            $checker = $database->query("select * from admin where aemail='$email' and apassword='$password'");
            if ($checker->num_rows==1){
                //   Admin dashbord
                $_SESSION['user']=$email;
                $_SESSION['usertype']='a';
                header('location: admin/index.php');
            }else{
                $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }
        }elseif($utype=='d'){
            //TODO
            $checker = $database->query("select * from doctor where docemail='$email' and docpassword='$password'");
            if ($checker->num_rows==1){
                //   doctor dashbord
                $_SESSION['user']=$email;
                $_SESSION['usertype']='d';
                header('location: doctor/index.php');
            }else{
                $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }
        }
    }else{
        $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We cant found any acount for this email.</label>';
    }
}else{
    $error='<label for="promter" class="form-label">&nbsp;</label>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="GinaFAcuna">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="icon" href="img/PCB.png">
    <title>PCB CLINIC</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: #e6f0fa;
        }
        .login-container {
            display: flex;
            min-height: 100vh;
        }
        .login-left {
            width: 40vw;
            min-width: 340px;
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 30px;
            box-shadow: 2px 0 8px rgba(0,0,0,0.04);
            position: relative;
            overflow: hidden;
        }
        .login-left::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: 0;
            background: url('img/bg1.webp') center center/cover no-repeat;
            opacity: 0.25;
        }
        .login-logo,
        .login-title,
        .login-form,
        .signup-row {
            position: relative;
            z-index: 1;
        }
        .login-logo img {
            width: 120px;
            margin-bottom: 16px;
        }
        .login-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 18px;
            color: #222;
            text-align: center;
        }
        .login-form {
            width: 100%;
            max-width: 320px;
            display: flex;
            flex-direction: column;
        }
        .form-label {
            color: #555;
            font-size: 14px;
            margin-bottom: 4px;
            margin-top: 10px;
        }
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #bfc9d4;
            border-radius: 4px;
            margin-bottom: 8px;
            font-size: 15px;
        }
        .login-btn {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            margin-bottom: 10px;
            transition: background 0.2s;
        }
        .login-btn:hover {
            background: #0056b3;
        }
        .remember-row {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .remember-row label {
            margin-left: 6px;
            font-size: 13px;
            color: #555;
        }
        .signup-row {
            margin-top: 10px;
            text-align: center;
        }
        .sub-text {
            font-size: 13px;
            color: #888;
        }
        .hover-link1 {
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
            margin-left: 4px;
        }
        .hover-link1:hover {
            text-decoration: underline;
        }
        .login-right {
            flex: 1;
            background: url('img/back.jpg') center center/cover no-repeat;
        }
        @media (max-width: 900px) {
            .login-container {
                flex-direction: column;
            }
            .login-right {
                min-height: 250px;
                height: 250px;
            }
            .login-left {
                width: 100%;
                min-height: 350px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <div class="login-logo">
                <img src="img/PCB.png" alt="Logo">
            </div>
            <h3 class="login-title">Welcome to PCB - CLINIC</h3>
            <form class="login-form" action="" method="POST">
                <label for="useremail" class="form-label">Email:</label>
                <input type="email" name="useremail" class="form-control" placeholder="Email Address" required>
                <label for="userpassword" class="form-label">Password:</label>
                <input type="password" name="userpassword" class="form-control" placeholder="Password" required>
                <div class="remember-row">
                    <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                    <label class="form-check-label" for="basic_checkbox_1">Remember my password</label>
                </div>
                <?php echo $error ?>
                <input type="submit" value="Login" class="login-btn">
            </form>
            <div class="signup-row">
                <span class="sub-text">Don\'t have an account?</span>
                <a href="signup.php" class="hover-link1 non-style-link">Sign Up</a>
            </div>
        </div>
        <div class="login-right"></div>
    </div>
</body>
</html>