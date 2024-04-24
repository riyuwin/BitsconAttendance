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

        // Append the table row with the data to the $tableRows variable
        $tableRows .= "<tr>";
        $tableRows .= "<td>$attendeeId</td>";
        $tableRows .= "<td>$name</td>";
        $tableRows .= "<td>$mobileNumber</td>";
        $tableRows .= "<td>$school</td>";
        $tableRows .= "<td><svg  width='15px' height='15px'  xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z'/></svg></td>";
        $tableRows .= "</tr>";
    }
} else {
    // If no records found, display a single row with a message
    $tableRows = "<tr><td colspan='5'>No records found</td></tr>";
}

// Query to fetch unique dates from the attendance table
$query = "SELECT DISTINCT school FROM attendee";
$result = mysqli_query($conn, $query);

// Initialize a variable to store the options
$options = '';

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    // Append the default option "All" to the $options variable
    $options .= "<option value='SELECT_ALL'>All</option>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        // Extract the date from each row
        $school = $row['school'];
        // Append the option to the $options variable
        $options .= "<option value='$school'>$school</option>";
    }
} else {
    // If no records found, display a default option
    $options = "<option value='SELECT_ALL'>All</option>";
}


// Function to insert data into database
function insertDataIntoDatabase($conn, $fname, $lname, $school, $number)
{
    $sql = "INSERT INTO Attendees (fname, lname, school, number) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fname, $lname, $school, $number);
    $stmt->execute();
    $stmt->close();
}

// Function to read Excel file and insert data into database
function readExcelAndInsertIntoDatabase($file)
{
    $conn = OpenCon();
    // Create a new Reader instance
    $reader = new Xlsx();

    // Load the Excel spreadsheet from the temporary file
    $spreadsheet = $reader->load($file['tmp_name']);
    $worksheet = $spreadsheet->getActiveSheet();

    // Iterate through rows in the Excel file
    foreach ($worksheet->getRowIterator() as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        // Initialize variables to store data from Excel
        $fname = "";
        $lname = "";
        $school = "";
        $number = "";

        // Iterate through cells in the row
        foreach ($cellIterator as $cell) {
            $column = $cell->getColumn();
            $value = $cell->getValue();

            // Assign values based on column headers
            switch ($column) {
                case 'A':
                    $fname = $value;
                    break;
                case 'B':
                    $lname = $value;
                    break;
                case 'C':
                    $school = $value;
                    break;
                case 'D':
                    $number = $value;
                    break;
                default:
                    break;
            }
        }

        // Insert data into database
        insertDataIntoDatabase($conn, $fname, $lname, $school, $number);
    }

    $conn->close();
}

// Check if a file has been uploaded
function UploadFile()
{
    if (isset($_FILES['excelUpload'])) {
        $file = $_FILES['excelUpload'];

        // Check if file upload is successful
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Process the uploaded file
            readExcelAndInsertIntoDatabase($file);
            echo "File uploaded and data inserted into the database successfully.";
        } else {
            echo "Error uploading file.";
        }
    }
}
// Close the database connection
CloseCon($conn);
?>