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
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
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

.menu-row {
        position: relative; /* Needed for absolute dropdown positioning */
    }

    .menu-btn {
        position: relative;
        padding: 10px;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        top: 100%; /* directly below the menu button */
        left: 0;
        background-color: #fff;
        min-width: 200px;
        box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
        z-index: 1;
        border-radius: 5px;
        overflow: hidden;
    }

    .dropdown-content a {
        padding: 12px 16px;
        display: block;
        text-decoration: none;
        color: #333;
        background-color: #fff;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    /* Show dropdown on hover */
    .menu-row:hover .dropdown-content {
        display: block;
    }

    .menu-text {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 28px; /* bigger for thickness */
            margin: 0 8px;
            transition: transform 0.2s ease;
            text-shadow: 0 0 1px rgba(0,0,0,0.2); /* subtle thickness */
        }

        .icon-btn:hover {
            transform: scale(1.2);
        }

        .btn-approve {
            color: #28a745; /* green */
        }

        .btn-decline {
            color: #dc3545; /* red */
        }

        .no-data {
            text-align: center;
            color: #888;
            font-style: italic;
            padding: 20px 0;
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
               
                <tr >
                    <!-- <td colspan="2" style="padding-top:30px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Add New Medicine</p>
                    </td> -->
                    
                </tr>

                <tr style="background: #dae1f3;">
            <?php 
                  $list11 = $database->query("select  fname,mname,lname from  pending_patient;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();} ?>   

                    <td>
    <p style="font-size: 23px;padding-left:30px;font-weight: 400; background: #dae1f3; margin-bottom: 0;padding: 5px;margin-top: 0;font-size: 20px;  color: #444;">All Pending Registration (<?php echo $list11->num_rows; ?>)</p>

             <td >
                         <form action="" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Medicine" list="pending_patient">&nbsp;&nbsp;
                            
                            <?php
                                echo '<datalist id="pending_patient">';
                               
                                    $d=$row00["fname"];
                                    $c=$row00["lname"];
                                    echo "<option value='$d'><br/>";
                                    echo "<option value='$c'><br/>";
                               

                            echo ' </datalist>';
?>
                            
                       
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        
                        </form>
                            
                    </td>
                    
                </tr>
                <?php
                    if($_POST){
                        $keyword=$_POST["search"];
                        
                        $sqlmain= "select * from pending_patient where fname='$keyword' or mname='$keyword' or lname like '$keyword%' or student_id like '%$keyword' or ptel like '%$keyword%'";
                    }else{
                        $sqlmain= "select * from medicine order by id desc";

                    }



                ?>
                  
                <tr>
                   <td colspan="4">
                       <center>
    <div class="abc">
            <table width="93%" class="sub-table scrolldown" border="0">
                
                        <thead>
                        <tr>
                            <th class="table-headin">
                              Profile
                                
                                </th>
                            <th class="table-headin">
                              Student ID
                                
                                </th>
                                <th class="table-headin">
                              Last Name
                                
                                </th>
                                <th class="table-headin">
                              First Name
                                
                                </th>
                                  <th class="table-headin">
                               Middle Name
                                
                                 </th>
                                  <th class="table-headin">
                               Email
                                
                                 </th>
                                <th class="table-headin">
                                    
                                    Action
                                    </th>
                                </tr>

                        </thead>
            <tbody class="data">
                <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
                <?php
                $sqlmain = "SELECT id, fname, mname, lname, email, student_id, image FROM pending_patient WHERE status = 'pending'";
                $result = $database->query($sqlmain);

                if ($result->num_rows === 0) {
                    echo "<tr><td colspan='7' class='no-data'>No pending registrations.</td></tr>";
                } else {
                    while ($row = $result->fetch_assoc()) {
                        $id = htmlspecialchars($row['id']);
                        $student_id = htmlspecialchars($row['student_id']);
                        $email = htmlspecialchars($row['email']);
                        $lname = htmlspecialchars($row['lname']);
                        $mname = htmlspecialchars($row['mname']);
                        $fname = htmlspecialchars($row['fname']);
                        
                        // Check if image exists and provide fallback
                        if (!empty($row["image"]) && file_exists("../uploads/patients/" . $row["image"])) {
                            $imagePath = "../uploads/patients/" . $row["image"];
                        } else {
                            // Use a placeholder image from a public CDN
                            $imagePath = "https://ui-avatars.com/api/?name=" . urlencode($fname . "+" . $lname) . "&background=random&color=fff&size=128";
                        }

                        echo "<tr>
                        <td style='text-align: center;'>
                            <img src='$imagePath' alt='Profile' style='width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 1px solid #ddd;'>
                        </td>
                        <td>$student_id</td>
                                <td>$lname</td>
                                <td>$fname</td>
                                <td>$mname</td>
                                <td>$email</td>
                                <td>
                                    <form action='admin-approval.php' method='POST' style='display:inline-flex; gap: 10px;'>
                                        <input type='hidden' name='user_id' value='$id'>
                                        <input type='hidden' name='email' value='$email'>

                                        <button type='submit' name='action' value='approve' class='icon-btn btn-approve' title='Approve'>
                                            <span class='material-icons-round'>check</span>
                                        </button>

                                        <button type='submit' name='action' value='decline' class='icon-btn btn-decline' title='Decline'>
                                            <span class='material-icons-round'>close</span>
                                        </button>

                                        
                                </td>
                              </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</center>
                   
            </table>
        </div>
    </div>

</body>
</html>