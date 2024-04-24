<?php
include 'db_connection.php';

$conn = OpenCon();

// Initialize a variable to store the table rows
$tableRows = '';

// Fetch data from the database
$query = "SELECT a.attendee_id, CONCAT(a.fname, ' ', a.lname) AS name, a.number, a.school, t.date
          FROM attendee a
          RIGHT JOIN attendance t ON a.attendee_id = t.attendee_id";

$result = mysqli_query($conn, $query);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Extract data from each row
        $attendeeId = $row['attendee_id'];
        $name = $row['name'];
        $mobileNumber = "null";
        if ($row['number'] !== "null") {
            $mobileNumber = "+63" . $row['number'];
        }
        $school = $row['school'];
        $date = $row['date'];


        // Append the table row with the data to the $tableRows variable
        $tableRows .= "<tr>";
        $tableRows .= "<td>$attendeeId</td>";
        $tableRows .= "<td>$name</td>";
        $tableRows .= "<td>$mobileNumber</td>";
        $tableRows .= "<td>$school</td>";
        $tableRows .= "<td>$date</td>";
        $tableRows .= "</tr>";
    }
} else {
    // If no records found, display a single row with a message
    $tableRows = "<tr><td colspan='5'>No records found</td></tr>";
}


// Query to fetch unique dates from the attendance table
$query = "SELECT DISTINCT date FROM attendance";
$result = mysqli_query($conn, $query);

// Initialize a variable to store the options
$options = '';

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    // Append the default option "All" to the $options variable
    $options .= "<option value='SELECT_ALL'>All</option>";

    while ($row = mysqli_fetch_assoc($result)) {
        // Extract the date from each row
        $date = $row['date'];
        // Append the option to the $options variable
        $options .= "<option value='$date'>$date</option>";
    }
} else {
    // If no records found, display a default option
    $options = "<option value='SELECT_ALL'>All</option>";
}

// Close the database connection
CloseCon($conn);
?>