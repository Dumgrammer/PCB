<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="author" content="Mayuri K">
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
        .input-text {
            border: 0.5px solid black;
            box-shadow: 0 8px 10px rgba(0, 0, 0, 0.2); /* cool subtle shadow */
            padding: 10px;
            border-radius: 6px; /* soft rounded corners */
            transition: box-shadow 0.3s ease-in-out;
        }

            .input-text:focus {
            box-shadow: 0 0 12px rgba(30, 144, 255, 0.6); /* glowing shadow on focus */
            outline: none;
        }

        body{
            margin: 2%;
            background-color: #F6F7FA;
        }
        .container{
            width: 45%;
            background-color: white;
            border: 2px solid rgb(235, 235, 235);
            border-radius: 8px;
            margin: 0;
            padding: 0;
            box-shadow: 0 3px 5px 0 rgba(240, 240, 240, 0.3);
            animation: transitionIn-Y-over 0.5s;

        }

        td{
            text-align: center;

        }
        .header-text{
            font-weight: 600;
            font-size: 30px;
            letter-spacing: -1px;
            margin-bottom: 10px;
        }

        .sub-text{
            font-size: 15px;
            color: rgb(138, 138, 138);
        }

        .form-label{
            color: rgb(44, 44, 44);
            text-align: left;
            font-size: 14px;
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
            margin-top: 15px;
            margin-bottom: 15px;
            width: 100%;
        }
        .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.7);
                z-index: 1000;
            }
            .popup {
                margin: 70px auto;
                padding: 20px;
                background: #fff;
                border-radius: 10px;
                width: 40%;
                position: relative;
                text-align: center;
                box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            }
            .popup h2 {
                margin-top: 0;
                color: #333;
            }
            .popup .close {
                position: absolute;
                top: 10px;
                right: 15px;
                text-decoration: none;
                font-size: 24px;
                color: #333;
            }
            .btn-primary {
                background-color: #007bff;
                border: none;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }
            .btn-primary:hover {
                background-color: #0056b3;
            }
            .image-upload-container {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .image-preview {
                width: 150px;
                height: 150px;
                border: 2px dashed #ccc;
                border-radius: 50%;
                margin: 10px auto;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                background-color: #f8f8f8;
            }
            .image-preview img {
                max-width: 100%;
                max-height: 100%;
                display: none;
            }
            .file-input {
                display: none;
            }
            .upload-button {
                padding: 8px 16px;
                background-color: #f0f0f0;
                border: 1px solid #ddd;
                border-radius: 4px;
                cursor: pointer;
                font-size: 14px;
                transition: all 0.3s;
            }
            .upload-button:hover {
                background-color: #e0e0e0;
            }
    </style>
    
</head>
<body>
<?php
$database = new mysqli("localhost", "root", "", "vaidyamitra");
if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}

date_default_timezone_set('Asia/Manila');
$_SESSION["date"] = date('Y-m-d');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = trim($_POST['fname']);
    $mname = trim($_POST['mname']);
    $lname = trim($_POST['lname']);
    $pdob = $_POST['pdob'];
    $ptel = trim($_POST['ptel']);
    $pbarangay = trim($_POST['pbarangay']);
    $pcity = trim($_POST['pcity']);
    $pprovince = trim($_POST['pprovince']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $student_id = $_POST['student_id'];
    $course = $_POST['course'];
    
    // Initialize image as null
    $image = null;

    if ($password !== $cpassword) {
        die("Passwords do not match!");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format'); history.back();</script>";
        exit();
    }

    // Check for duplicate email or student ID
    $checkStmt = $database->prepare("
        SELECT email FROM pending_patient WHERE email = ? 
        UNION 
        SELECT pemail FROM patient WHERE pemail = ?
        UNION 
        SELECT student_id FROM pending_patient WHERE student_id = ? 
        UNION 
        SELECT student_id FROM patient WHERE student_id = ?
    ");
    $checkStmt->bind_param("ssss", $email, $email, $student_id, $student_id);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo "<script>alert('Email or Student ID already exists!'); history.back();</script>";
        $checkStmt->close();
        $database->close();
        exit();
    }
    $checkStmt->close();

    // Process image upload if exists
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        // Check if extension is allowed
        if (in_array($file_ext, $allowed)) {
            // Generate a unique filename
            $new_filename = $student_id . '_' . time() . '.' . $file_ext;
            
            // Create directory if it doesn't exist
            if (!file_exists('uploads/patients')) {
                mkdir('uploads/patients', 0777, true);
            }
            
            $upload_path = 'uploads/patients/' . $new_filename;
            
            // Move uploaded file
            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $image = $new_filename;
            } else {
                echo "<script>alert('Failed to upload image'); history.back();</script>";
                exit();
            }
        } else {
            echo "<script>alert('Invalid image format. Allowed formats: jpg, jpeg, png, gif'); history.back();</script>";
            exit();
        }
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into pending_patient
    $stmt = $database->prepare("INSERT INTO pending_patient (
        fname, mname, lname, pdob, ptel, pbarangay, pcity, pprovince,
        email, password, student_id, course, status, image
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?)");

    $stmt->bind_param(
        "sssssssssssss",
        $fname, $mname, $lname, $pdob, $ptel, $pbarangay, $pcity, $pprovince, $email, $hashedPassword, $student_id, $course, $image
    );

    if ($stmt->execute()) {
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <br><br>
                    <h2>Account Registration Successful, please wait for Email confirmation!</h2>
                    <a class="close" href="login.php">&times;</a>
                    <div class="content"></div>
                    <div style="display: flex; justify-content: center;">
                        <a href="login.php" class="non-style-link">
                            <button class="btn-primary btn" style="margin:10px;padding:10px;">
                                <font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font>
                            </button>
                        </a>
                    </div>
                </center>
            </div>
        </div>';
    } else {
        echo "<script>alert('Error: {$stmt->error}'); history.back();</script>";
    }

    $stmt->close();
    $database->close();
}
?>

<center>
<div class="container">
    <form method="POST" action="signup.php" enctype="multipart/form-data">
        <table border="0">
            <tr>
                <td colspan="6">
                    <h2>Sign Up</h2>
                    <p>Add Your Personal Details to Continue</p>
                </td>
            </tr>

            <!-- Profile Image -->
            <tr>
                <td class="label-td" colspan="6">
                    <label class="form-label">Profile Picture:</label>
                    <div class="image-upload-container">
                        <div class="image-preview">
                            <img id="preview-image" src="#" alt="Preview">
                            <span id="placeholder-text">No image selected</span>
                        </div>
                        <label for="image-upload" class="upload-button">Choose Image</label>
                        <input type="file" name="image" id="image-upload" class="file-input" accept="image/*">
                    </div>
                </td>
            </tr>

            <!-- Name -->
            <tr>
                <td class="label-td" colspan="6"><label class="form-label">Name:</label></td>
            </tr>
            <tr>
                <td class="label-td" colspan="2"><input type="text" name="fname" class="input-text" placeholder="First Name" required></td>
                <td class="label-td" colspan="2"><input type="text" name="mname" class="input-text" placeholder="Middle Name" required></td>
                <td class="label-td" colspan="2"><input type="text" name="lname" class="input-text" placeholder="Last Name" required></td>
            </tr>

            <!-- DOB + Phone -->
            <tr>
                <td class="label-td" colspan="3"><label class="form-label">Date of Birth:</label></td>
                <td class="label-td" colspan="3"><label class="form-label">Phone Number:</label></td>
            </tr>
            <tr>
                <td class="label-td" colspan="3">
                    <input type="date" name="pdob" class="input-text" required>
                </td>
                <td class="label-td" colspan="3">
                    <input type="tel" name="ptel" class="input-text" placeholder="09XXXXXXXXX"
                        pattern="09[0-9]{9}" maxlength="11" minlength="11" required
                        title="Phone number must be 11 digits and start with 09"
                        inputmode="numeric"
                        oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                </td>
            </tr>

            <!-- Student ID + Email -->
            <tr>
                <td class="label-td" colspan="3"><label class="form-label">Student ID:</label></td>
                <td class="label-td" colspan="3"><label class="form-label">Email:</label></td>
            </tr>
            <tr>
                <td class="label-td" colspan="3">
                    <input type="text" name="student_id" class="input-text" placeholder="19-00540"
                        maxlength="8" minlength="8" required
                        inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,7);
                        if (this.value.length > 2) {
                            this.value = this.value.slice(0,2) + '-' + this.value.slice(2);
                        }">
                </td>
                <td class="label-td" colspan="3">
                    <input type="email" name="email" placeholder="fullname@pcb.edu.ph" class="input-text" required>
                </td>
            </tr>

            <!-- Course -->
            <tr>
                <td class="label-td" colspan="6"><label class="form-label">Course:</label></td>
            </tr>
            <tr>
                <td class="label-td" colspan="6">
                    <select name="course" class="input-text" required>
                        <option value="" disabled selected>Select Course</option>
                        <optgroup label="Institute of Computing Studies">
                            <option value="BSIT">Bachelor of Science in Information Technology (BSIT)</option>
                            <option value="BSIS">Bachelor of Science in Information Systems (BSIS)</option>
                            <option value="ACT">Associate in Computer Technology (ACT)</option>
                            <option value="BSCS">Bachelor of Science in Computer Science (BSCS)</option>
                        </optgroup>
                        <optgroup label="Institute of Education">
                            <option value="BEED">Bachelor of Elementary Education (BEED)</option>
                            <option value="BCAED">Bachelor of Culture and Arts Education (BCAED)</option>
                            <option value="BCED">Bachelor of Secondary Education (BCED)</option>
                        </optgroup>
                    </select>
                </td>
            </tr>

            <!-- Address -->
            <tr>
                <td class="label-td" colspan="6"><label class="form-label">Address:</label></td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <select name="pbarangay" class="input-text" required>
                        <option value="" disabled selected>Select Barangay</option>
                        <option value="Bancal">Bancal</option>
                        <option value="Bangan">Bangan</option>
                        <option value="Batonlapoc">Batonlapoc</option>
                        <option value="Belbel">Belbel</option>
                        <option value="Beneg">Beneg</option>
                        <option value="Binuclutan">Binuclutan</option>
                        <option value="Burgos">Burgos</option>
                        <option value="Cabatuan">Cabatuan</option>
                        <option value="Capayawan">Capayawan</option>
                        <option value="Carael">Carael</option>
                        <option value="Danacbunga">Danacbunga</option>
                        <option value="Maguisguis">Maguisguis</option>
                        <option value="Malomboy">Malomboy</option>
                        <option value="Mambog">Mambog</option>
                        <option value="Moraza">Moraza</option>
                        <option value="Nacolcol">Nacolcol</option>
                        <option value="Owaog-Nibloc">Owaog-Nibloc</option>
                        <option value="Paco Poblacion">Paco Poblacion</option>
                        <option value="Palis">Palis</option>
                        <option value="Panan">Panan</option>
                        <option value="Parel">Parel</option>
                        <option value="Paudpod">Paudpod</option>
                        <option value="Poonbato">Poonbato</option>
                        <option value="Porac">Porac</option>
                        <option value="San Isidro">San Isidro</option>
                        <option value="San Juan">San Juan</option>
                        <option value="San Miguel">San Miguel</option>
                        <option value="Santiago">Santiago</option>
                        <option value="Tampo Poblacion">Tampo Poblacion</option>
                        <option value="Taugtog">Taugtog</option>
                        <option value="Villar">Villar</option>
                    </select>
                </td>
                <td class="label-td" colspan="2">
                    <input type="text" name="pcity" class="input-text" value="Botolan" readonly>
                </td>
                <td class="label-td" colspan="2">
                    <input type="text" name="pprovince" class="input-text" value="Zambales" readonly>
                </td>
            </tr>

            <!-- Password -->
            <tr>
                <td class="label-td" colspan="3">
                    <label class="form-label">Password:</label>
                    <input type="password" name="password" class="input-text"
                        pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                        title="At least 8 characters, include letters and numbers." required>
                </td>
                <td class="label-td" colspan="3">
                    <label class="form-label">Confirm Password:</label>
                    <input type="password" name="cpassword" class="input-text" required>
                </td>
            </tr>

            <!-- Buttons -->
            <tr>
                <td colspan="3"><input type="reset" value="Clear" class="login-btn btn-primary-soft btn"></td>
                <td colspan="3"><input type="submit" name="signup" value="Sign Up" class="login-btn btn-primary btn"></td>
            </tr>

            <!-- Already have account -->
            <tr>
                <td colspan="6">
                    <br>
                    <label class="sub-text">Already have an account? </label>
                    <a href="login.php" class="hover-link1 non-style-link">Login</a>
                    <br><br><br>
                </td>
            </tr>
        </table>
    </form>
</div>
</center>

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const email = document.querySelector('input[name="email"]').value;
    const password = document.querySelector('input[name="password"]').value;
    const cpassword = document.querySelector('input[name="cpassword"]').value;
    if (!email.endsWith('@pcb.edu.ph')) {
        alert('Email must end with @pcb.edu.ph');
        e.preventDefault();
    } else if (!/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(password)) {
        alert('Password must be at least 8 characters and include both letters and numbers.');
        e.preventDefault();
    } else if (password !== cpassword) {
        alert('Passwords do not match!');
        e.preventDefault();
    }
});

// Image preview functionality
document.getElementById('image-upload').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview-image');
    const placeholder = document.getElementById('placeholder-text');
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        }
        
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
        placeholder.style.display = 'block';
    }
});
</script>

</body>
</html>