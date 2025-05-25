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
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }


        .menu img {
            width: 70%;
            padding: 10%;
        }


        .card {

            background-image: url(../img/bgdash.jpg);
            background-size: cover;

        }

        .menu-text {
            font-size: 16px;
            font-weight: 500;
            color: #333;
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0;
        }

        .menu-text i.material-symbols-outlined {
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-text i.custom-icon img {
            width: 24px;
            height: 24px;
            display: block;
            object-fit: contain;
            opacity: 0.8;
        }

        /* Add dark mode styles */
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }
        
        body.dark-mode .container {
            background-color: #1e1e1e;
        }
        
        body.dark-mode .menu {
            background-color: #252525;
        }
        
        body.dark-mode .dash-body {
            background-color: #1e1e1e;
        }
        
        body.dark-mode .menu-text {
            color: #e0e0e0;
        }
        
        body.dark-mode .sub-table {
            background-color: #252525;
            color: #e0e0e0;
        }
        
        body.dark-mode .table-headin {
            background-color: #333;
            color: #e0e0e0;
        }
        
        body.dark-mode .popup {
            background-color: #252525;
            color: #e0e0e0;
        }
        
        body.dark-mode .input-text,
        body.dark-mode select,
        body.dark-mode textarea {
            background-color: #333;
            color: #e0e0e0;
            border-color: #444;
        }
        
        body.dark-mode .btn-primary {
            background-color: #0d6efd;
        }
        
        body.dark-mode .non-style-link {
            color: #e0e0e0;
        }
        
        body.dark-mode .dashboard-items {
            background-color: #252525;
            color: #e0e0e0;
        }
        
        body.dark-mode .h1-dashboard {
            color: #e0e0e0;
        }
        
        body.dark-mode .h3-dashboard {
            color: #e0e0e0;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
            header("location: ../login.php");
        }
    } else {
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
                                    <img src="../img/PCB.png" alt="">
                                </td>

                            </tr>

                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active">

                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text">
                                    <i class="material-symbols-outlined"> dashboard</i>
                                    Dashboard
                                </p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-medicine">
                <a href="medicine.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text"><i class="material-symbols-outlined"> <img src="../img/icons/medicine-icon.png" style="width: 28px;
                            opacity: 70%;"></i>Medicine</p>
                </a>
    </div>
    </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-equipment">
            <a href="equipment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">
                        <i class="custom-icon"><img src="../img/icons/equipment-icon.png" alt="Equipment Icon" style="opacity: 75%;"></i>
                        Equipment
                    </p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-doctor">
            <a href="doctors.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">
                        <i class="material-symbols-outlined">supervised_user_circle</i>
                        Staff
                    </p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">
                        <i class="custom-icon"><img src="../img/icons/appointment-icon.png" alt="Appointment Icon" style="opacity: 75%;"></i>
                        Appointment
                    </p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-patient">
            <a href="patient.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text"><i class="material-symbols-outlined">face</i>Patients</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row" >
        <td class="menu-btn menu-icon-settings   ">
            <a href="#" class="non-style-link-menu" onclick="toggleDarkMode(); return false;">
                <div><p class="menu-text"><i class="material-symbols-outlined">settings</i>Toggle Dark Mode</p></a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings">
            <a href="../logout.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text"><i class="material-symbols-outlined">power_settings_new</i>Logout</p>
            </a></div>
        </td>
    </tr>

    </table>
    </div>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">

            <tr>
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

    <!--  <form action="doctors.php" method="post" class="header-search">

                <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email" list="doctors">&nbsp;&nbsp;
                <?php
                echo '<datalist id="doctors">';
                $list11 = $database->query("select  docname,docemail from  doctor;");

                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $d = $row00["docname"];
                    $c = $row00["docemail"];
                    echo "<option value='$d'><br/>";
                    echo "<option value='$c'><br/>";
                };

                echo ' </datalist>';
                ?>
                                    <input type="Submit" value="Search" class="login-btn btn-primary-soft btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                
                                </form> -->

    </td>

    <!--  <?php
            date_default_timezone_set('Asia/Kolkata');

            $today = date('Y-m-d');
            echo $today;


            $patientrow = $database->query("select  * from  patient;");
            $doctorrow = $database->query("select  * from  doctor;");
            $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
            $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");


            ?> -->



    </tr>

    <td colspan="4">
        <center>
            <table class="filter-container" style="border: none;" border="0">
                <tr>
                    <td style="width: 50%; padding: 20px;">
                        <div style="background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 20px; height: 200px; position: relative; overflow: hidden; display: flex; flex-direction: column;">
                            <h4 style="text-align: center; color: #333; font-size: 22px; font-weight: 600; margin-bottom: 20px; letter-spacing: 1px;">MISSION</h4>
                            <div style="display: flex; flex-grow: 1; height: 100%;">
                                <div style="width: 6px; background-color: #3498db; border-radius: 3px 0 0 3px; margin-right: 20px; height: 100%;"></div>
                                <div style="display: flex; align-items: center;">
                                    <p style="color: #444; line-height: 1.6; font-size: 15px; margin: 0; text-align: justify;">
                                    WE WILL ENRICH, EDUCATE AND ENLIGHTEN POLYTECHNIC COLLEGE OF BOTOLAN (PCB) STUDENT THROUGH PROVIDING ACCESSIBLE HEALTH CARE, PROMOTING PREVENTION AND PARTNERING WITH PARENTS AND STAFF TO ENABLE STUDENTS TO PERFORM AT THEIR PERSONAL BEST.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="width: 50%; padding: 20px;">
                        <div style="background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 20px; height: 200px; position: relative; overflow: hidden; display: flex; flex-direction: column;">
                            <h4 style="text-align: center; color: #333; font-size: 22px; font-weight: 600; margin-bottom: 20px; letter-spacing: 1px;">VISION</h4>
                            <div style="display: flex; flex-grow: 1; height: 100%;">
                                <div style="width: 6px; background-color: #2ecc71; border-radius: 3px 0 0 3px; margin-right: 20px; height: 100%;"></div>
                                <div style="display: flex; align-items: center;">
                                    <p style="color: #444; line-height: 1.6; font-size: 15px; margin: 0; text-align: justify;">
                                    POLYTECHNIC COLLEGE OF BOTOLAN (PCB) WILL BE HEALTHY AND SAFE WHILE ACHIEVING ACADEMIC SUCCESS.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 20px;">
                        <div class="dashboard-stats" style="display: flex; justify-content: space-between; gap: 20px;">
                            <div style="background-color: #f07470; padding: 25px 25px 40px; width: 32%; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; flex-direction: column; height: 700px;">
                                <div style="margin-bottom: 30px;">
                                    <div style="color: #fff; font-size: 22px; font-weight: 500; margin-bottom: 15px;">
                                        Nurse
                                    </div>
                                    <div style="color: #fff; font-size: 40px; font-weight: bold;">
                                        <?php echo $doctorrow->num_rows ?>
                                    </div>
                                </div>
                                <div style="margin-top: auto; align-self: flex-end; background-color: rgba(255,255,255,0.2); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa fa-user-md" style="font-size: 28px; color: #fff;"></i>
                                </div>
                            </div>

                            <div style="background-color: #6ac17a; padding: 25px 25px 40px; width: 32%; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; flex-direction: column; height: 700px;">
                                <div style="margin-bottom: 30px;">
                                    <div style="color: #fff; font-size: 22px; font-weight: 500; margin-bottom: 15px;">
                                        Patients
                                    </div>
                                    <div style="color: #fff; font-size: 40px; font-weight: bold;">
                                        <?php echo $patientrow->num_rows ?>
                                    </div>
                                </div>
                                <div style="margin-top: auto; align-self: flex-end; background-color: rgba(255,255,255,0.2); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa fa-users" style="font-size: 28px; color: #fff;"></i>
                                </div>
                            </div>

                            <div style="background-color: #55c3dc; padding: 25px 25px 40px; width: 32%; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; flex-direction: column; height: 700px;">
                                <div style="margin-bottom: 30px;">
                                    <div style="color: #fff; font-size: 22px; font-weight: 500; margin-bottom: 15px;">
                                        Booking
                                    </div>
                                    <div style="color: #fff; font-size: 40px; font-weight: bold;">
                                        <?php echo $appointmentrow->num_rows ?>
                                    </div>
                                </div>
                                <div style="margin-top: auto; align-self: flex-end; background-color: rgba(255,255,255,0.2); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa fa-calendar" style="font-size: 28px; color: #fff;"></i>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </center>
    </td>
</tr>
</table>
</div>
    <script>
        // Function to toggle dark mode
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            
            // Save preference to localStorage
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.setItem('darkMode', 'disabled');
            }
        }
        
        // Check if dark mode was previously enabled
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.getItem('darkMode') === 'enabled') {
                document.body.classList.add('dark-mode');
            }
        });
    </script>
</body>

</html>