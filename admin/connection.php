<?php
$host = 'localhost';
$dbname = 'registration';
$username = 'root';
$password = '';

$database = new mysqli($host, $username, $password, $dbname);

if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}
?>
