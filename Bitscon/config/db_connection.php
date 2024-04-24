<?php
 

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
 
// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
 
function OpenCon()
{
 
    /*     $database_host = "localhost";
    $database_username = "root";
    $database_password = "";
    $database = "bitscon"; */

    $database_host = $_ENV['DATABASE_HOST'];
    $database_username = $_ENV['DATABASE_USERNAME'];
    $database_password = $_ENV['DATABASE_PASSWORD'];
    $database = $_ENV['DATABASE'];

    $conn = new mysqli($database_host, $database_username, $database_password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        //echo "Connected successfully";
    }

    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}
  
?>