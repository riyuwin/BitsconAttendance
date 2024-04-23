<?php

include 'db_connection.php';

$conn = OpenCon();

if(isset($_POST['submit'])){
    if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['schoolInput']) && !empty($_POST['Phonenum'])) {

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $school = $_POST['schoolInput'];
    $number = $_POST['Phonenum'];

    $formatted_number = "+63" . $number;

    $check_email_query = "SELECT * FROM attendee WHERE fname = '$fname' AND lname = '$lname'";
    $check_email_result = mysqli_query($conn, $check_email_query);
    
    if(mysqli_num_rows($check_email_result) > 0){
        $error = "Attendee already exists.";
    
        // Using simple JavaScript alert for testing
        echo "<script>alert('$error');</script>";
    
        // Adding a delay and then redirecting
        echo "<script>
            setTimeout(function() {
                window.location.href = '../dist/user_form.php';
            }, 1000); // Redirect after 1000 milliseconds (2 seconds)
        </script>";
        
        exit();
    }
    

    $query = "INSERT INTO attendee (fname, lname, number, school) VALUES ('$fname', '$lname', '$number', '$school')";

    $run = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if($run){
        header("Location: ../dist/user_form.php");
        exit();
    } else {
        $error = "Form not submitted";
        header("Location: ../dist/user_form.php?error=$error");
        exit();
    }

    CloseCon($conn);
    }
} else {
    header("Location: ../dist/user_form.php?error");
    exit();
}

?>