<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="author" content="GinaFAcuna">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  

   <link rel="icon" href="../img/PCB.png">
      
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        
    <title>PCB CLINIC</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
        img{
            opacity: 70%;
        }

        .menu img{
            width: 75%;
            padding: 10%;
        }


        .menu-row {
    position: relative;
}
    .card{

            background-image: url(../img/bgdash.jpg);
            background-size: cover;
        
    }

/* Hide the dropdown by default */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 180px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    left: 100%; /* Adjust if needed */
    top: 0;
}

/* Show dropdown on hover */
.menu-row:hover .dropdown-content {
    display: block;
}

/* Dropdown item links */
.dropdown-content a {
    color: black;
    padding: 10px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}
.table-headin {
    font-weight: bold;
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

    
    ?>
    <div class="container">

        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
               <td>
                  <table border="0" class="profile-container">
                     <tr>
                        <td>
                           <img src="../img/PCB.png" alt="" >
                        </td>
                       
                     </tr>
                     
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active" >

                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active"><div>
                           <p class="menu-text">
                            <i class="material-symbols-outlined"> dashboard</i>
                        Dashboard</p></a></div></a>
                    </td>
                     </tr>
                    <tr class="menu-row" >
                    <td class="menu-btn menu-icon-medicine">
                        <a href="medicine.php" class="non-style-link-menu">
                            <div><p class="menu-text"><i class="material-symbols-outlined"> <img src="../img/icons/medicine-icon.png" style="width: 28px;"></i>Medicine</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="doctors.php" class="non-style-link-menu ">
                            <div><p class="menu-text">
                                <i class="material-symbols-outlined">supervised_user_circle</i>Doctors</p>
                            </a></div>
                    </td>
                </tr>
               <!--  <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu">
                 <div>
                <p class="menu-text"><i class="material-symbols-outlined">description</i>Appointment</p>
                </a>
            </div>
                    </td>
                </tr> -->
                <tr class="menu-row">
    <td class="menu-btn menu-icon-patient">
        <a href="patient.php" class="non-style-link-menu">
            <div>
                <p class="menu-text"><i class="material-symbols-outlined">face</i>Patients</p>
            </div>
        </a>

        <!-- Dropdown -->
        <div class="dropdown-content">
            <a href="#">All Patients</a>
            <a href="#">Add Patient</a>
            <a href="#">Patient Reports</a>
        </div>
    </td>
</tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings   ">
                        <a href="#" class="non-style-link-menu">
                            <div><p class="menu-text"><i class="material-symbols-outlined">settings</i>Settings</p></a></div>
                    </td>
                </tr>
                <tr  class="menu-row">
                    <td class="menu-btn menu-icon-settings">
                        <a href="../logout.php" class="non-style-link-menu">
                            <div>
                      <p class="menu-text"><i class="material-symbols-outlined">power_settings_new</i>Logout</p></a></div>
                    </td> 
               </tr>

            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
        <tr >
            <!--  <td>
          <marquee behavior="scroll" direction="left" scrollamount="4"><p style="color: blue;">
                KAMUSTA ANG BUHAY BUHAY </p>
            </marquee> 
                                </td> --> 
        <td colspan="2" class="nav" style="float: right;">

           <div class="header-content">

                <nav class="navbar navbar-expand">
          <div class="collapse navbar-collapse justify-content-between">
            <div class="header-left">
                        <div class="dashboard_bar" style="text-transform: capitalize;"></div>
                    </div>
                    <ul class="navbar-nav header-right">
                        <li>
                        <!-- <i class="fa-regular fa-bell"></i> -->
                    </li>
                    <li> <!-- <i class="fa-regular fa-message"></i> --></li>
                    <li>
                      <!-- <i class="fa-solid fa-gift"></i>  -->   
                    </li>
                       
                  <?php
                 $email = $_SESSION['user'];
                $query = "SELECT * FROM admin WHERE aemail = '$email'";
                $result = $database->query($query);

                if ($result && $result->num_rows == 1) {
                    $admin = $result->fetch_assoc();
                    $aname = $admin['aname']; // Replace this with actual name column if available
                    $aemail = $admin['aemail'];
                } else {
                    $aname = "Unknown";
                    $aemail = "No email";
                }
                ?>

                <div class="profile dropdown">
                    <img src="../img/profile.png" width="45px">
                    <div class="toggel">
                        <span><?= htmlspecialchars($aname) ?></span><br>
                        <span><?= htmlspecialchars($aemail) ?></span>
                    </div>
                </div>
                  
               
                    </ul>
                </div>
            </nav>
        </div>
                </div>
                    </div>
                        
                   </li>
                  
                    </ul>
                </div>
            </nav>
        </div>
         