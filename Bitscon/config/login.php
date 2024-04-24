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
include 'db_connection.php';

session_start(); // Start session at the beginning

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$conn = OpenCon();

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == $_ENV["ADMIN_USERNAME"] && $password == $_ENV["ADMIN_PASSWORD"]){
        $_SESSION['username'] = $email; 
        $_SESSION['password'] = $password; 
        header("location:../dist/admin_registered_list.php");
        exit(); // Exit after redirect

    } else { 
        // If user is not found
        $_SESSION['error'] = "User not found";
    }

    // Redirect back to the login form
    header("location:../dist/admin_login.php");
    exit();
 
}
?>