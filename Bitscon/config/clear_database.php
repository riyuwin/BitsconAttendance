<?php
include 'db_connection.php';

$conn = OpenCon();

// Define a function to clear the database
function clearDatabase($conn)
{
    // Delete rows from the attendee table that are referenced by other tables
    $sql = "DELETE FROM attendee WHERE attendee_id IN (
        SELECT attendee_id FROM attendee WHERE attendee_id NOT IN (SELECT DISTINCT attendee_id FROM attendance)
    )";
    $conn->query($sql);
}

clearDatabase($conn);
CloseCon($conn);
?>