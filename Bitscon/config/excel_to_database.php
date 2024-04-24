<?php

// Include the PhpSpreadsheet library
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

// database connection
include 'db_connection.php';


// Function to insert data into database
function insertDataIntoDatabase($conn, $fname, $lname, $school, $number) {
    $sql = "INSERT INTO Attendees (fname, lname, school, number) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fname, $lname, $school, $number);
    $stmt->execute();
    $stmt->close();
}

// Function to read Excel file and insert data into database
function readExcelAndInsertIntoDatabase($file) {
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
if (isset($_FILES['excel_file'])) {
    $file = $_FILES['excel_file'];

    // Check if file upload is successful
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Process the uploaded file
        readExcelAndInsertIntoDatabase($file);
        echo "File uploaded and data inserted into the database successfully.";
    } else {
        echo "Error uploading file.";
    }
}