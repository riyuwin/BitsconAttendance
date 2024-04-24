<?php
/* include 'db_connection.php';

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$conn = OpenCon();

// Retrieve data from the AJAX request
$username = $_POST['username'];
$passwordInput = $_POST['password'];

$ADMIN_USERNAME = $_ENV["ADMIN_USERNAME"];
$ADMIN_PASSWORD = $_ENV["ADMIN_PASSWORD"];
if ($ADMIN_USERNAME === $username) {
    if ($ADMIN_PASSWORD === $passwordInput) {
        session_start(); // Start the session
        $_SESSION['loggedin'] = true;
        echo '200:OK';
    } else {
        echo 'PASSWORD_INCORRECT';
    }
} else {
    echo 'USERNAME_NOT_FOUND';
} */
?>


<?php 

session_start();

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == $_ENV["ADMIN_USERNAME"] && $password == $_ENV["ADMIN_PASSWORD"]){

        $_SESSION['username'] = $username; 
        $_SESSION['password'] = $password;  // Store hashed password in session
        header("location:../bitscon2024_webApp123/admin/attendance.php");
        exit(); 
    } else { 
        $_SESSION['error'] = "User not found";
        echo "User not found";
        header("location:../bitscon2024_webApp123/admin/login.php");
        exit(); 
    } 
}
?>