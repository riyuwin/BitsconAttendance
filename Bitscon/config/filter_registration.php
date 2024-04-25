<?php

include 'db_connection.php';

$conn = OpenCon();

$tableRows = array(); // Initialize an empty array to hold table rows

$searchText = $_POST["searchText"];
$school = $_POST["school"];
$query = '';
// Fetch data from the database
if ($school !== "") {
    $query .= "SELECT * FROM attendee where `school`='$school';";
} else {
    $query .= "SELECT * FROM attendee";
}
$result = mysqli_query($conn, $query);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Extract data from each row
        $attendeeId = $row['attendee_id'];
        $name = $row['fname'] . ' ' . $row['lname'];
        $mobileNumber = $row['number'] !== "null" || $row['number'] !== "+63" ? "+63" . $row['number'] : "null";
        $school = $row['school'];
        // Build an associative array for each row
        $concatenatedValue = "$attendeeId $name $mobileNumber $school";
        if (mb_stripos($concatenatedValue, $searchText) !== false) {
            $rowData = array(
                "attendeeId" => $attendeeId,
                "name" => $name,
                "mobileNumber" => $mobileNumber,
                "school" => $school
            );
            $tableRows[] = $rowData;
        }
    }
    // Encode the $tableRows array to JSON format and echo it
    echo json_encode($tableRows);
} else {
    // If no records found, echo an empty array
    echo json_encode(array());
}
?>