<?php

include 'db_connection.php';

$conn = OpenCon();

// Initialize a variable to store the table rows
$tableRows = '';

// Fetch data from the database
$query = "SELECT * FROM attendee";
$result = mysqli_query($conn, $query);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Extract data from each row
        $attendeeId = $row['attendee_id'];
        $name = $row['fname'] . ' ' . $row['lname'];
        $mobileNumber = "null";
        if ($row['number'] !== "null") {
            $mobileNumber = "+63" . $row['number'];
        }
        $school = $row['school'];
        /* $date = $row['date']; */

        // Append the table row with the data to the $tableRows variable
        $tableRows .= "<tr>";
        $tableRows .= "<td>$attendeeId</td>";
        $tableRows .= "<td>$name</td>";
        $tableRows .= "<td>$mobileNumber</td>";
        $tableRows .= "<td>$school</td>";
        $tableRows .= "</tr>";
    }
} else {
    // If no records found, display a single row with a message
    $tableRows = "<tr><td colspan='5'>No records found</td></tr>";
}

// Close the database connection
CloseCon($conn);
?>