<?php
// Include your database connection file
include_once 'db_connection.php';

$conn = OpenCon();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Collect data from the form
    $id = $_POST['attendeeID']; // Assuming you have an input field with name 'attendeeID'
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $school = $_POST['school'];
    $phonenum = $_POST['Phonenum']; // Assuming you have an input field with name 'Phonenum'

    // Update the database using prepared statements to prevent SQL injection
    $query = "UPDATE attendee SET fname=?, lname=?, school=?, number=? WHERE attendee_id=?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssi', $firstname, $lastname, $school, $phonenum, $id);

        if (mysqli_stmt_execute($stmt)) {
            // Update successful
            //echo "Data updated successfully";

            // Display appropriate message and redirect
            echo "<script>alert('Data updated successfully')</script>";
            echo "<script>
                setTimeout(function() {
                    window.location.href = '../dist/admin_registered_list.php';
                }, 1000); // Redirect after 1000 milliseconds (1 second)
            </script>"; 
            
            // You can optionally redirect the user to a success page or display a success message here
        } else {
            // Update failed
            echo "Error updating data: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Handle prepare statement error
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    CloseCon($conn);

} else {
    // Handle invalid form submission or direct access to this file
    echo "Invalid request";
}
?>
