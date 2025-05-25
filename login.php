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
                // Check if this is a doctor trying to log in as admin
                $doctor_check = $database->query("select * from doctor where docemail='$email' and docpassword='$password'");
                if ($doctor_check->num_rows==1){
                    //   Admin dashbord for doctor
                    $_SESSION['user']=$email;
                    $_SESSION['usertype']='a';
                    header('location: admin/index.php');
                }else{
                    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }
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
        
        /* Carousel Styles */
        .carousel {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        
        .carousel-inner {
            position: relative;
            width: 100%;
            height: 100%;
        }
        
        .carousel-item {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        
        .carousel-item.active {
            opacity: 1;
        }
        
        .carousel-caption {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 15px;
            text-align: center;
        }
        
        .carousel-caption h3 {
            margin: 0;
            font-size: 24px;
        }
        
        .carousel-caption p {
            margin: 5px 0 0;
            font-size: 16px;
        }
        
        .carousel-indicators {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
        }
        
        .carousel-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
        }
        
        .carousel-indicator.active {
            background: white;
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
        <div class="login-right">
            <div class="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background-image: url('img/back.jpg');">
                        <div class="carousel-caption">
                            <h3>PCB Clinic</h3>
                            <p>Your health is our priority</p>
                        </div>
                    </div>
                    <div class="carousel-item" style="background-image: url('img/491708925_1211063467692581_6097064427270748121_n.jpg');">
                        <div class="carousel-caption">
                            <h3>Polytechnic College of Botolan</h3>
                            <p>7th Senior High School Commencement Exercises</p>
                        </div>
                    </div>
                    <div class="carousel-item" style="background-image: url('img/486618630_1189239576541637_8002040121270972116_n.jpg');">
                        <div class="carousel-caption">
                            <h3>PCB Campus</h3>
                            <p>The place where you can build your future</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-indicators">
                    <div class="carousel-indicator active" data-slide="0"></div>
                    <div class="carousel-indicator" data-slide="1"></div>
                    <div class="carousel-indicator" data-slide="2"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Carousel functionality
        document.addEventListener('DOMContentLoaded', function() {
            const carouselItems = document.querySelectorAll('.carousel-item');
            const indicators = document.querySelectorAll('.carousel-indicator');
            let currentSlide = 0;
            
            // Function to change slide
            function showSlide(index) {
                // Hide all slides
                carouselItems.forEach(item => {
                    item.classList.remove('active');
                });
                
                // Deactivate all indicators
                indicators.forEach(indicator => {
                    indicator.classList.remove('active');
                });
                
                // Show the selected slide and activate its indicator
                carouselItems[index].classList.add('active');
                indicators[index].classList.add('active');
                
                currentSlide = index;
            }
            
            // Set up click events for indicators
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    showSlide(index);
                });
            });
            
            // Auto-rotate slides
            setInterval(() => {
                let nextSlide = (currentSlide + 1) % carouselItems.length;
                showSlide(nextSlide);
            }, 5000); // Change slide every 5 seconds
        });
    </script>
</body>
</html>