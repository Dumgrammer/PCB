<?php
require __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("../connection.php");

    
session_start();

$database = new mysqli("localhost", "root", "", "vaidyamitra");
if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $email = $_POST['email'];
    $action = $_POST['action'];

    if (!in_array($action, ['approve', 'decline'])) {
        die("Invalid action");
    }

    $newStatus = $action === 'approve' ? 'approved' : 'declined';

    // Update status in pending_patient
    $stmt = $database->prepare("UPDATE pending_patient SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $newStatus, $userId);
    $stmt->execute();
    $stmt->close();

    // If approved, migrate user to patient table
    if ($action === 'approve') {
        $stmt = $database->prepare("
            SELECT fname, mname, lname, email, password, pdob, ptel, student_id, pbarangay, pprovince, pcity 
            FROM pending_patient WHERE id = ?
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();
        $stmt->close();

        if ($userData) {
            // Ensure no empty fields
            $fname = $userData['fname'] ?? '';
            $mname = $userData['mname'] ?? '';
            $lname = $userData['lname'] ?? '';
            $email = $userData['email'] ?? '';
            $password = $userData['password'] ?? '';
            $dob = $userData['pdob'] ?? '';
            $ptel = $userData['ptel'] ?? '';
            $student_id = !empty($userData['student_id']) ? $userData['student_id'] : 'N/A';
            $barangay = $userData['pbarangay'] ?? '';
            $province = $userData['pprovince'] ?? '';
            $city = $userData['pcity'] ?? '';

            // Insert into patient
            $stmt = $database->prepare("
                INSERT INTO patient (
                    fname, mname, lname, pemail, ppassword, pdob, ptel, student_id, 
                    pbarangay, pprovince, pcity
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->bind_param(
                "sssssssssss",
                $fname, $mname, $lname, $email, $password, $dob, $ptel,
                $student_id, $barangay, $province, $city
            );

            if ($stmt->execute()) {
                $stmt->close();

                // Check if webuser exists
                $stmt = $database->prepare("SELECT * FROM webuser WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows === 0) {
                    $stmt_insert = $database->prepare("INSERT INTO webuser (email, usertype) VALUES (?, 'p')");
                    $stmt_insert->bind_param("s", $email);
                    $stmt_insert->execute();
                    $stmt_insert->close();
                }
                $stmt->close();

                // Delete from pending_patient
                $stmt = $database->prepare("DELETE FROM pending_patient WHERE id = ?");
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $stmt->close();

                echo "User approved and successfully registered. A confirmation email has been sent.";
            } else {
                echo "Error inserting into patient table: " . $stmt->error;
                $stmt->close();
                exit;
            }
        } else {
            echo "User data not found.";
            exit;
        }
    } else {
        echo "User status updated to declined.";
    }


$database->close();



    // Email Notification
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'adrainpadua@pcb.edu.ph';
        $mail->Password = 'fybn yzza waww jtbp'; // ⚠️ Use app password, not your main one!
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('adgt1378@gmail.com', 'Admin');
        $mail->addAddress($email);
        $mail->isHTML(true);

        if ($newStatus === 'approved') {
            $mail->Subject = "Your Registration Has Been Approved!";
            $mail->Body = "
                <p>Dear user,</p>
                <p>Congratulations! Your account registration has been <strong>APPROVED</strong>.</p>
                <p>You may now log in to the system using your registered email and password.</p>
                <br>
                <p>Best regards,<br>Nurse Gina F. Acuña.</p>
            ";
        } else {
            $mail->Subject = "Registration Declined";
            $mail->Body = "
                <p>Dear user,</p>
                <p>We regret to inform you that your registration has been <strong>DECLINED</strong>.</p>
                <p>If you believe this decision was a mistake, feel free to register again.</p>
                <br>
                <p>Thank you,<br>Nurse Gina F. Acuña.</p>
            ";
        }

        $mail->send();
        echo "<script>alert('User $newStatus and email sent'); window.location.href = 'patient.php';</script>";
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
