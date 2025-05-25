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
        
        /* Dark Mode Styles */
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

    $today = date('Y-m-d');
    $minDate = date('Y-m-d', strtotime('+7 days')); // At least 7 days from today
    $maxDate = date('Y-m-d', strtotime('+1 year'));

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
        <td class="menu-btn menu-icon-appointment">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">
                        <i class="custom-icon"><img src="../img/icons/appointment-icon.png" alt="Equipment Icon" style="opacity: 75%;"></i>
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
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings   ">
            <a href="#" class="non-style-link-menu" onclick="toggleDarkMode(); return false;">
                <div>
                    <p class="menu-text"><i class="material-symbols-outlined">settings</i>Toggle Dark Mode</p>
            </a></div>
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
                                    <!-- <i class="fa-solid fa-gift"></i>   -->
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
                <!--  <td width="13%">
                        <a href="doctors.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td> -->
                <td>

                    <!--  <form action="" method="post" class="header-search">

                           
                            <?php
                            //echo '<datalist id="doctors">';
                            // $list11 = $database->query("select  docname,docemail from  doctor;");

                            //for ($y=0;$y<$list11->num_rows;$y++){
                            //$row00=$list11->fetch_assoc();
                            // $d=$row00["docname"];
                            // $c=$row00["docemail"];
                            // echo "<option value='$d'><br/>";
                            // echo "<option value='$c'><br/>";
                            // };

                            //echo ' </datalist>';
                            ?>
                            
                       
                           
                        
                        </form>
                         -->
                </td>
                <!-- <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php
                            date_default_timezone_set('Asia/Kolkata');

                            $date = date('Y-m-d');
                            echo $date;
                            ?>
                        </p>
                    </td> -->
                <!--  <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
 -->

            </tr>

            <tr>
                <!-- <td colspan="2" style="padding-top:30px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Add New Medicine</p>
                    </td> -->

            </tr>

            <tr style="background: #dae1f3;">
                <?php
                $list11 = $database->query("select  brand,quantity from  medicine;");

                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                } ?>

                <td>
                    <p style="font-size: 23px;padding-left:30px;font-weight: 400; background: #dae1f3; margin-bottom: 0;padding: 5px;margin-top: 0;font-size: 20px;  color: #444;">All Medicine (<?php echo $list11->num_rows; ?>)</p>

                <td>
                    <form action="" method="post" class="header-search">

                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Medicine" list="medicine">&nbsp;&nbsp;

                        <?php
                        echo '<datalist id="medicine">';

                        $d = $row00["brand"];
                        $c = $row00["quantity"];
                        echo "<option value='$d'><br/>";
                        echo "<option value='$c'><br/>";


                        echo ' </datalist>';
                        ?>


                        <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">

                    </form>

                </td>


                <td style="background: #dae1f3; padding: 5px 30px; text-align: right;">
                    <a href="?action=add&id=none&error=0" class="non-style-link" title="Add Medicine"
                        style="
       display: inline-flex;
       align-items: center;
       gap: 10px;
       background-color: #1877f2;
       color: white;
       padding: 8px 16px;
       border-radius: 12px;
       font-size: 16px;
       font-weight: 600;
       box-shadow: 0 4px 6px rgba(24, 119, 242, 0.3);
       text-decoration: none;
       position: relative;
     ">
                        <!-- Paste your chosen SVG here -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <path d="M20.07 4.93a5.25 5.25 0 0 0-7.43 0L3.22 14.35a4.5 4.5 0 0 0 6.36 6.36l9.42-9.42a5.25 5.25 0 0 0 0-7.43zm-8.29 9.17-1.42-1.42 5.66-5.66 1.42 1.42-5.66 5.66z" />
                        </svg>
                        <span>Add Medicine</span>
                    </a>
                </td>



            </tr>
            <?php
            if ($_POST) {
                $keyword = $_POST["search"];

                $sqlmain = "select * from medicine where brand='$keyword' or quantity='$keyword' or quantity like '$keyword%' or quantity like '%$keyword' or quantity like '%$keyword%'";
            } else {
                $sqlmain = "select * from medicine order by id desc";
            }



            ?>

            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="93%" class="sub-table scrolldown" border="0">
                                <thead>
                                    <tr>
                                        <th class="table-headin">
                                            Brand

                                        </th>
                                        <th class="table-headin">
                                            Generic Name

                                        </th>
                                        <th class="table-headin">
                                            Quantity
                                        </th>
                                        <th class="table-headin">
                                            Dosage(ML)

                                        </th>
                                        <th class="table-headin">
                                            Expiration Date

                                        </th>
                                        <!-- <th class="table-headin">
                                    
                                    Category
                                    
                                </th> -->

                                        <th class="table-headin">

                                            Action
                                        </th>
                                    </tr>

                                </thead>
                                <tbody class="data">

                                    <?php


                                    $result = $database->query($sqlmain);

                                    if ($result->num_rows == 0) {
                                        echo '<tr>
                                    <td colspan="6">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.png" width=30%">
                                    
                                    <br>
                                    <p class="heading-main12" font-size:20px;color:rgb(49, 49, 49)">No medicine required—health powered by resilience.</p>
                                    <a class="non-style-link" href="patient.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Patients &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    } else {
                                        for ($x = 0; $x < $result->num_rows; $x++) {
                                            $row = $result->fetch_assoc();
                                            $medid = $row["id"];
                                            $brand = $row["brand"];
                                            $generic_name = $row["generic_name"];
                                            $quantity = $row["quantity"];
                                            $dosage = $row["dosage"];
                                            $expiration_date = $row["expiration_date"];

                                            echo '<tr>
                                            <td>' . substr($brand, 0, 20) . '</td>
                                            <td>' . substr($generic_name, 0, 20) . '</td>
                                            <td>' . substr($quantity, 0, 20) . '</td>
                                            <td>' . substr($dosage, 0, 20) . 'ML</td>
                                            <td>' . substr($expiration_date, 0, 20) . '</td>
                                            <td>
                                                <div style="display:flex;justify-content: center;">
                                                    <a href="?action=edit&id=' . $medid . '&error=0" class=" btn-primary btn button-icon" >
                                                        <i  class="material-symbols-outlined">edit_square</i>
                                                    </a>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <a href="?action=view&id=' . $medid . '" class=" btn-success btn button-icon">
                                                        <i class="material-symbols-outlined">visibility</i>
                                                    </a>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <a href="?action=drop&id=' . $medid . '&name=' . $brand . '" class="btn-danger btn button-icon ">
                                                        <i class="material-symbols-outlined">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>';
                                        }
                                    }

                                    ?>

                                </tbody>

                            </table>
                        </div>
                    </center>
                </td>
            </tr>



        </table>
    </div>
    </div>
    <?php
    if ($_GET) {

        $medid = $_GET["id"];
        $action = $_GET["action"];
        if ($action == 'drop') {
            $nameget = $_GET["brand"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure you want to delete this?</h2>
                        <a class="close" href="medicine.php">&times;</a>
                        <div class="content">
                          
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-medicine.php?id=' . $medid . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;

                        <a href="medicine.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'view') {
            $sqlmain = "select * from medicine where id='$medid'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $brand = $row["brand"];
            $quantity = $row["quantity"];
            $expiration_date = $row["expiration_date"];
            $generic_name = $row["generic_name"];
            $dosage = $row["dosage"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="medicine.php">&times;</a>
                        <br>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                            <td class="label-td" colspan="3">
        <label class="form-label">Brand:</label><br>
        <span>' . $brand . '</span>
    </td>
    <td class="label-td" colspan="3">
        <label class="form-label">Generic Name:</label><br>
        <span>' . $generic_name . '</span><br>
    </td>
    

    
</tr>

<tr>
    

    <td class="label-td" colspan="3">
        <label class="form-label">Quantity:</label><br>
        <span>' . $quantity . '</span>
    </td>

    <td class="label-td" colspan="3">
        <label class="form-label">Dosage:</label><br>
        <span>' . $dosage . '</span>
    </td>
    <td class="label-td" colspan="3">
        <label class="form-label">Expiration Date:</label><br>
        <span>' . $expiration_date . '</span>
    </td>
</tr>

                                <td colspan="2"><br>
                                    <a href="medicine.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                           
                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        } elseif ($action == 'add') {
            $error_1 = $_GET["error"];
            $errorlist = array(
                '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Confirmation Error! Reconfirm Password</label>',
                '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                '4' => "",
                '0' => '',

            );
            if ($error_1 != '4') {
                echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    
                        <a class="close" href="medicine.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="100%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                                <td class="label-td" colspan="2">' .
                    $errorlist[$error_1]
                    . '</td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Medicine.</p><br><br>
                                </td>
                            </tr>
                            
                           
                                <form action="add-medicine.php" method="POST" class="add-new-form">
                                <tr>
    <td class="label-td" colspan="3">
        <label for="brand" class="form-label">Brand:</label><br>
        <input type="text" name="brand" class="input-text" placeholder="Brand" required>
    </td>

    <td class="label-td" colspan="3">
        <label for="quantity" class="form-label">Quantity:</label><br>
        <input type="number" name="quantity" min="0" class="input-text" placeholder="Quantity" required>
    </td>

    <td class="label-td" colspan="3">
        <label for="expiration_date" class="form-label">Expiration Date:</label><br>
        <input type="date" name="expiration_date" class="input-text" required min="' . $minDate . '" max="' . $maxDate . '">
    </td>
</tr>
<tr>
    <td class="label-td" colspan="3">
        <label for="generic_name" class="form-label">Generic Name:</label><br>
        <input type="text" name="generic_name" class="input-text" placeholder="Generic Name" required>
    </td>

    <td class="label-td" colspan="3">
        <label for="dosage" class="form-label">Dosage:</label><br>
        <input type="text" name="dosage" min="0" class="input-text" placeholder="Dosage (e.g., 5ml)" required>
    </td>
</tr>
                               
                            </tr>
                         <tr>

                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Clear" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                    <input type="submit" value="Add" class="login-btn btn-primary btn">
                                </td>
                
                            </tr>
                           
                            </form>
                            </tr>
                        </table>
                        </div>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
            } else {
                echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>        
                            <br><br><br><br>
                                <h2>New Medicine Added Successfully!</h2>
                                <a class="close" href="medicine.php">&times;</a>
                                <div class="content">
                                    
                                    
                                </div>
                                <div style="display: flex;justify-content: center;">
                                
                                <a href="medicine.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

                                </div>
                                <br><br>
                            </center>
                    </div>
                    </div>
        ';
            }
        } elseif ($action == 'edit') {
            $sqlmain = "select * from medicine where id='$medid'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $brand = $row["brand"];
            $quantity = $row["quantity"];
            $expiration_date = $row["expiration_date"];
            $generic_name = $row["generic_name"];
            $dosage = $row["dosage"];
            /* $category=$row["category"];
            
            $spcil_res= $database->query("select category from medicine_category where id='$category'");
            $spcil_array= $spcil_res->fetch_assoc();
            $spcil_name=$spcil_array["category"];*/

            $error_1 = $_GET["error"];
            $errorlist = array(
                '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                '4' => "",
                '0' => '',

            );

            if ($error_1 != '4') {
                echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            
                                <a class="close" href="medicine.php">&times;</a> 
                                <div style="display: flex;justify-content: center;">
                                <div class="abc">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                        <td class="label-td" colspan="2">' .
                    $errorlist[$error_1]
                    . '</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Edit Medicine Details.</p>
                                        <br><br>
                                        </td><br>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <form action="edit-medicine.php" method="POST" class="add-new-form">
                                            
                                            <input type="hidden" value="' . $medid . '" name="id">
                                        </td>
                                    <tr>
                                    <td class="label-td" colspan="3">
        <label for="brand" class="form-label">Brand:</label><br>
        <input type="text" name="brand" class="input-text" placeholder="Brand"  value="' . $brand . '" required>
    </td>
 <td class="label-td" colspan="3">
        <label for="generic_name" class="form-label">Generic Name:</label><br>
        <input type="text" name="generic_name" class="input-text" placeholder="Generic Name"  value="' . $generic_name . '" required>
    </td>

    

   
</tr>

<tr>
   

   <td class="label-td" colspan="3">
        <label for="quantity" class="form-label">Quantity:</label><br>
        <input type="number" name="quantity" min="0" class="input-text" placeholder="Quantity"  value="' . $quantity . '" required>
    </td>

    <td class="label-td" colspan="3">
        <label for="dosage" class="form-label">Dosage:</label><br>
        <input type="text" name="dosage" min="0" class="input-text" placeholder="Dosage (e.g., 5ml)" value="' . $dosage . '" required>
    </td>

     <td class="label-td" colspan="3">
        <label for="expiration_date" class="form-label">Expiration Date:</label><br>
        <input type="date" name="expiration_date" class="input-text" min="' . $minDate . '" max="' . $maxDate . '" value="' . $expiration_date . '" required>
    </td>
</tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="reset" value="Clear" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                                            <input type="submit" value="Save" class="login-btn btn-primary btn">
                                        </td>
                        
                                    </tr>
                                
                                    </form>
                                    </tr>
                                </table>
                                </div>
                                </div>
                            </center>
                            <br><br>
                    </div>
                    </div>
                    ';
            } else {
                echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                        <br><br><br><br>
                            <h2>Edit Successfully!</h2>
                            <a class="close" href="medicine.php">&times;</a>
                            <div class="content">
                                
                                
                            </div>
                            <div style="display: flex;justify-content: center;">
                            
                            <a href="medicine.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

                            </div>
                            <br><br>
                        </center>
                </div>
                </div>
    ';
            };
        };
    };

    ?>
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