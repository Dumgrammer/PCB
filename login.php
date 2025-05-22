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
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .login-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;

}

    .login-btn:hover {
        background-color: #0056b3; /* A darker shade of blue */
    }


    body{
/*        margin: 2%;*/
        background-color: #e6fff5;
/*        background-image: url(img/bg1.webp);*/

    }


    .login-box{
       width: 100%;
        height: 70%;
        float: left;
        background-color: transparent;
        border-radius: 8px;
        padding: 3px 20px;
        
        /*box-shadow: 0 3px 5px 0 rgba(240, 240, 240, 0.3);
        animation: transitionIn-Y-over 0.5s; */
    }
    td h3{
       font-weight: 600;
       color: #3d4465;

    }
    td p{
        color: #7e7e7e;;
    }
    .login-logo img{
        width: 200px;
        margin:0;

    }
    .login-logo .img2{
    width: 120px;
    pad: 10px !important;
    margin-left: 5px;
    margin-bottom: 8px;
    }

    .header-text{
        font-weight: 600;
        font-size: 30px;
        letter-spacing: 1px;
/*        margin-bottom: 10px;*/

    }
    .container{
        /*margin-top: 5% ;
        margin-right: 30%;*/
    }
    .sub-text{
        font-size: 15px;
        color: rgb(138, 138, 138);
    }

    .form-label{
        color: #7e7e7e;
        text-align: left;
        font-size: 14px;
    }
    .form-control:active .form-control:hover{
       border: 1px solid #d7dae3 !important ;
    }
    .login-box .form-control{
     border: 0.5px solid black;
      padding: 12px; 
    }

    .form-control {
        background: #fff;
        border: 1px solid black;
        color: #3e4954;
        height: 56px;
           padding: 2px;
            width: 120%;
            border-radius: 0.75rem;
            font-size: .875rem;
        font-weight: 400;
        line-height: 1.5;
        margin: 0 !important;
    }
    .btn-primary {
        color: #fff;
        background-color: #36c95f;
        border-color: #36c95f;
    }
    .btn-primary:hover {
        color: red;
        background-color: #36c95f;
        border-color: #36c95f;
    }


    .label-td{
        text-align: left;
        padding-top: 10px;
    }

    .hover-link1{
        font-weight: bold;
    }


    .hover-link1:hover{
        opacity: 0.8;
        transition: 0.5s;


    }.login-btn{
        /*margin-top: 15px;*/
/*        margin-bottom: 10px;*/
        width: 120%;
        height: 56px;
    }

 .back {
        content: "";
        float: right;
/*        background-image: url(img/back.jpg);*/
        background-size: cover;
        height: 100%;
        position: absolute !important;
        width: 60%;
        left: 550px;
        top: 0;
        z-index: 1;
        -webkit-transform: skew(-5deg);
        transform: skew(-5deg);
    }
     .box-skew {
        box-shadow: none;
        position: absolute;
        z-index: 1;
        right: 50px;
        top: 50%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        padding: 50px;
        width: 500px;
        background-color: #fff;
    }
    .login-box .box-skew1 {
         height: 100vh; 
        min-height: 100vh;
        position: relative;
    }

    </style>

    
    
</head>
<body>
    <?php

    session_start();

    $_SESSION["user"]="";
    $_SESSION["usertype"]="";
    
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





   <center>
     <div class="container">
    <div class="col-lg-6 col-md-5 d-flex login-box box-skew1">
        
        <table>
            <tr>
                <a class="login-logo" href="">
                       <img src="img/PCB.png" alt="" width="16px">
                </a>
                <td>
                   <h3>Welcome to PCB - CLINIC</h3>
                </td>
            </tr>
        <div class="form-body">
           
            <tr>
                <form action="" method="POST" >
                <td class="label">
                    <label for="useremail" class="form-label">Email: </label>
                </td>
            </tr>
            <tr>
                <td class="label">
                    <input type="email" name="useremail" class="form-control" placeholder="Email Address" required>
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label for="userpassword" class="form-label">Password: </label>
                </td>
            </tr>

            

            <tr>
                <td class="label">
                    <input type="Password" name="userpassword" class="form-control" placeholder="Password" required>
                </td>
            </tr>



           <tr>
                <td class="label">
                     <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                            <label class="form-check-label" for="basic_checkbox_1">Remember my password</label><br><br>
                </td>
            </tr>
            <tr>
                <td><br>
                <?php echo $error ?>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Login" class="login-btn">
                </td>
            </tr>
        </div>
            <tr>
               <td>
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
                    <a href="signup.php" class="hover-link1 non-style-link">Sign Up</a>
                    <br><br><br>
                </td> 
            </tr>
                   
                    </form>
                    </tr>
        </table>

    </div>
             <div class="col-lg-6 col-md-5 d-flex back">
                    
             </div>
 </div>
</center>

</body>
</html>
   
        
