<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>BITSCON 2024 | Attendance System</title>

    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lexend' rel='stylesheet'>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="icon" type="image/png" href="../images/cnsclogo.png" />

    <link rel="stylesheet" href="../css/design.css" />


</head>


<body>

<section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="../images/threelogos.png" style="width: 300px; padding-bottom: 30px;" alt="logo">
                                        <h4 class="gradient-text mt-1 mb-5 pb-1" style="font-family: Lexend;"><b>BITSCON 2024 ATTENDANCE TRACKING
                                                FORM</b></h4>
                                                </div>

                                    <form action="../config/update_record.php" method="POST" id="attendanceForm">
                                        <p>Please update attendee record:</p>

                                        
                                        <div class="form-outline mb-4">
                                            <input type="text" id="attendeeID" name="attendeeID" class="form-control" placeholder="Attendee ID" readonly
                                                value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="firstname" name="firstname" class="form-control"
                                                pattern="^[A-Za-z]+(?:\s+[A-Za-z]+)?$" placeholder="First Name" required
                                                value="<?php echo isset($_GET['fname']) ? $_GET['fname'] : ''; ?>" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="lastname" name="lastname" class="form-control"
                                                pattern="^[A-Za-z]+(?:\s+[A-Za-z]+)?$" placeholder="Last Name" required
                                                value="<?php echo isset($_GET['lname']) ? $_GET['lname'] : ''; ?>" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="school" name="school" class="form-control" placeholder="School" required
                                                value="<?php echo isset($_GET['school']) ? $_GET['school'] : ''; ?>" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <div class="input-group">
                                                <span class="input-group-text">+63</span>
                                                <input type="text" id="Phonenum" name="Phonenum" class="form-control"
                                                    placeholder="Phone number" pattern="\d{10}" title="Please enter a 10-digit phone number" required
                                                    value="<?php echo isset($_GET['mobile']) ? substr($_GET['mobile'], 3) : ''; ?>" />
                                            </div>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="button-19" type="submit" name="submit">Submit</button>
                                            <div id="error-message" class="text-danger mt-2"></div>
                                            <div id="confirmation-message" class="text-green mt-2"></div>
                                        </div>
                                    </form>



                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">

                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h1 class="mb-8 text-center" style="font-family: Lexend;">WELCOME TO BITSCON 2024!</h1>
                                    <img class="logo" src="../images/codite.png" alt="image" width="400" height="320">
                                 
                                    <p style="text-align: justify; font-family: Lexend;">Join us for an electrifying event packed with
                                        excitement, unparalleled experiences, and a
                                        wealth of knowledge on the latest innovations shaping our world.</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
    function toggleOtherInput() {
        var selectElement = document.getElementById("schoolInput");
        var otherInput = document.getElementById("otherSchoolInput");
        var otherSchoolInput = document.getElementById("otherSchool");

        if (selectElement.value === "others") {
            otherInput.style.display = "block";
            otherSchoolInput.required = true;
        } else {
            otherInput.style.display = "none";
            otherSchoolInput.required = false;
        }
    }
    </script>
    
</body>

</html>