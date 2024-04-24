<?php

include 'db_connection.php';

$conn = OpenCon();

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
        $fname = $row['fname'];
        $lname = $row['lname'];
        $mobileNumber = $row['number'] !== "null" ? "+63" . $row['number'] : "null";
        $school = $row['school'];

        // Append the table row with the data to the $tableRows variable
        $tableRows .= "<tr>";
        $tableRows .= "<td>$attendeeId</td>";
        $tableRows .= "<td>$name</td>";
        $tableRows .= "<td>$mobileNumber</td>";
        $tableRows .= "<td>$school</td>";
        // Add a button with onclick event to trigger a JavaScript function
        /* $tableRows .= "<td><button class='btn btn-primary btn-sm' onclick='handleButtonClick($attendeeId)'><i class='fas fa-edit'></i> Edit</button></td>"; */
        $tableRows .= "<td><a href='update?id=$attendeeId&fname=$fname&lname=$lname&mobile=$mobileNumber&school=$school' class='btn btn-primary btn-sm'>Edit</a></td>";
        $tableRows .= "</tr>";
    }
} else {
    // If no records found, display a single row with a message
    $tableRows = "<tr><td colspan='5'>No records found</td></tr>";
}

echo "<script>
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.btn-primary');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const fname = this.getAttribute('data-fname');
            const lname = this.getAttribute('data-lname');
            const mobile = this.getAttribute('data-mobile');
            const school = this.getAttribute('data-school');
            
            // Populate modal fields
            document.getElementById('attendeeID').value = id;
            document.getElementById('firstname').value = fname;
            document.getElementById('lastname').value = lname;
            document.getElementById('schoolInputModal').value = school;
            document.getElementById('Phonenum').value = mobile.substring(3); // Remove +63
            
            // Show the modal
            $('#exampleModal').modal('show');

        });
    });


});
</script>";


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