<?php

include 'db_connection.php';

$conn = OpenCon();

if (isset($_POST['submit'])) {
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['schoolInput']) && !empty($_POST['Phonenum'])) {

        $fname = trim($_POST['firstname']);
        $lname = trim($_POST['lastname']);
        $school = trim($_POST['schoolInput']);
        $number = trim($_POST['Phonenum']);

        // Get the current date in the format MM/DD/YYYY
        $currentDate = date('Y-m-d'); // Format ang date sa 'Y-m-d' (e.g., 2024-04-25)

        $formatted_number = "+63" . $number;

        if ($school == "others") {
            $school = trim($_POST['otherSchool']);
        }

        // Check if the attendee already exists based on first name and last name
        $check_attendee_query = "SELECT attendee_id FROM attendee WHERE fname = '$fname' AND lname = '$lname'";
        $check_attendee_result = mysqli_query($conn, $check_attendee_query);

        if ($check_attendee_result) {
            // Check if any rows were returned
            if (mysqli_num_rows($check_attendee_result) > 0) {
                // Fetch the first row from the result
                $row = mysqli_fetch_assoc($check_attendee_result);
                // Get the value of attendee_id from the fetched row
                $attendee_id = $row['attendee_id'];

                // Check if the attendee has already attended on the current date
                $check_attendance_query = "SELECT * FROM attendance WHERE attendee_id = '$attendee_id' AND date='$currentDate'";
                $check_attendance_result = mysqli_query($conn, $check_attendance_query);

                if (mysqli_num_rows($check_attendance_result) > 0) {
                    $error = "Attendee already attended today.";
                } else {
                    // Insert the attendee's attendance for the current date
                    $insert_attendance_query = "INSERT INTO attendance (attendee_id, date) VALUES ('$attendee_id', '$currentDate')";
                    $insert_attendance_result = mysqli_query($conn, $insert_attendance_query);
                    if ($insert_attendance_result) {
                        // Attendance inserted successfully
                        $success = "Attendance recorded successfully.";
                    } else {
                        // Failed to insert attendance
                        $error = "Failed to record attendance.";
                    }
                }

                // Display appropriate message and redirect
                echo "<script>alert('" . ($error ?? $success ?? "Unknown error") . "')</script>";
                echo "<script>
                    setTimeout(function() {
                        window.location.href = '../user_form.php';
                    }, 1000); // Redirect after 1000 milliseconds (1 second)
                </script>";

                exit();
            } else {
                $error = "Attendee is not registered.";

                // Display appropriate message and redirect
                echo "<script>alert('" . ($error ?? $success ?? "Unknown error") . "')</script>";
                echo "<script>
                    setTimeout(function() {
                        window.location.href = '../user_form.php';
                    }, 1000); // Redirect after 1000 milliseconds (1 second)
                </script>";

            }
        } else {
            // Handle query execution errors
            $error = "Error executing the query: " . mysqli_error($conn);
            echo $error;
            exit();
        }

        CloseCon($conn);
    }
} else {
    header("Location: ../user_form.php?error");
    exit();
}

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

        // Retrieve the inserted row
        $sql = "SELECT * FROM attendee WHERE fname = ? AND lname = ? AND school = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $fname, $lname, $school);
        $stmt->execute();
        $result = $stmt->get_result();
        $insertedRow = $result->fetch_assoc();
        $stmt->close();

        return $insertedRow;
    } else {
        return null;
    }
}

?>