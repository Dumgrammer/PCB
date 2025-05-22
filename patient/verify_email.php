<?php
session_start();

$database = new mysqli("localhost", "root", "", "vaidyamitra");
if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verify token and update is_verified status
    $stmt = $database->prepare("SELECT * FROM patient WHERE verification_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Mark email as verified
        $stmt2 = $database->prepare("UPDATE patient SET is_verified = 1 WHERE verification_token = ?");
        $stmt2->bind_param("s", $token);
        $stmt2->execute();

        echo "Email verified successfully! Please wait for admin approval.";
    } else {
        echo "Invalid or expired token.";
    }
} else {
    echo "Invalid request.";
}
?>
