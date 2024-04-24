<?php
$servername = "localhost";
$username = "root";
$password = ""; // Default password is empty for XAMPP
$dbname = "bitscon2024";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$firstname = $_POST['firstname'];
$midinitial = $_POST['midinitial'];
$lastname = $_POST['lastname'];
$Phonenum = $_POST['Phonenum'];

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO attendance (firstname, midinitial, lastname, Phonenum) VALUES (?, ?, ?, ?)");

// Bind parameters
$stmt->bind_param("ssss", $firstname, $midinitial, $lastname, $Phonenum);

// Execute the statement
if ($stmt->execute()) {
    echo "<script>alert('Attendance Successful');</script>"; // Display JavaScript alert
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
