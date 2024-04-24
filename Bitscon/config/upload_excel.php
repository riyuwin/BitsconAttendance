<?php
include 'db_connection.php';

$conn = OpenCon();

// Retrieve data from the AJAX request
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$school = $_POST['school'];
$number = $_POST['number'];

// Call the insertDataIntoDatabase function
insertDataIntoDatabase($conn, $fname, $lname, $school, $number);

function insertDataIntoDatabase($conn, $fname, $lname, $school, $number)
{
    // Check if the data already exists in the table
    $sql = "SELECT COUNT(*) AS count FROM attendee WHERE fname = ? AND lname = ? AND school = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $fname, $lname, $school);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $existingRecords = $row['count'];
    $stmt->close();

    // If the data doesn't exist, insert it into the table
    if ($existingRecords == 0) {
        $sql = "INSERT INTO attendee (fname, lname, school, number) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $fname, $lname, $school, $number);
        $stmt->execute();
        $stmt->close();
        echo "Data inserted successfully.";
    } else {
        echo "Data already exists.";
    }
}

CloseCon($conn);
?>