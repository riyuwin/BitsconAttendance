<?php


require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function OpenCon()
{
    $database_host = $_ENV['DATABASE_HOST'];
    $database_username = $_ENV['DATABASE_USERNAME'];
    $database_password = $_ENV['DATABASE_PASSWORD'];
    $database = $_ENV['DATABASE'];

    $conn = new mysqli($database_host, $database_username, $database_password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    CreateTables($conn);

    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}

function CreateTables($conn)
{
    // CREATE ATTENDEE TABLE IF NOT EXISTS
    $query = "SELECT attendee_id FROM attendee";
    try {
        $result = mysqli_query($conn, $query);
    } catch (mysqli_sql_exception $th) {
        $query = "CREATE TABLE attendee (
                              attendee_id int(11) AUTO_INCREMENT,
                              fname varchar(100) NOT NULL,
                              lname varchar(100) NOT NULL,
                              number varchar(100),
                              school varchar(500) NOT NULL,
                              PRIMARY KEY  (attendee_id))";
        $result = mysqli_query($conn, $query);
    }

    // CREATE ATTENDANCE TABLE IF NOT EXISTS
    $query = "SELECT attendance_id FROM attendance";
    try {
        $result = mysqli_query($conn, $query);
    } catch (mysqli_sql_exception $th) {
        $query = "CREATE TABLE attendance (
                              attendance_id int(11) AUTO_INCREMENT,
                              attendee_id int(11) NOT NULL,
                              date date NOT NULL,
                              PRIMARY KEY  (attendance_id),
                              FOREIGN KEY (attendee_id) REFERENCES attendee(attendee_id))";
        $result = mysqli_query($conn, $query);
    }
}

?>