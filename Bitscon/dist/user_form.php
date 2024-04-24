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
                                        <form action="../config/save_user_form.php" method="POST" id="attendanceForm">
                                            <p>Please enter details for attendance:</p>

                                            <div class="form-outline mb-4">
                                                <input type="text" id="firstname" name="firstname" class="form-control"
                                                    pattern="^[A-Za-z]+(?:\s+[A-Za-z]+)?$" placeholder="First Name" required />
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="text" id="lastname" name="lastname" class="form-control"
                                                    pattern="[A-Za-z ]+" placeholder="Last Name" required />
                                            </div>

                                            <div class="form-outline mb-4">
                                                <select class="form-control" id="schoolInput" name="schoolInput" onchange="toggleOtherInput()"required>
                                                    <option value="">--- Select School Name ---</option>
                                                    <option value="Camarines Norte State College">Camarines Norte State College</option>
                                                    <option value="Mabini Colleges">Mabini Colleges</option>
                                                    <option value="Ateneo De Naga">Ateneo De Naga</option>
                                                    <option value="others">Others</option>
                                                </select>
                                            </div>

                                            <div class="form-outline mb-4">
                                            <div id="otherSchoolInput" style="display: none;">
                                            <label for="otherSchool">Please specify:</label>
                                            <input type="text" class="form-control" id="otherSchool" name="otherSchool">
                                            </div>

                                            </div>
                                            
  
                                            <div class="form-outline mb-4">
                                                <div class="input-group">
                                                    <span class="input-group-text">+63</span>
                                                    <input type="text" id="Phonenum" name="Phonenum" class="form-control"
                                                        placeholder="Phone number" pattern="\d{10}"
                                                        title="Please enter a 10-digit phone number" required />
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
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateForm() {
            const form = document.getElementById('attendanceForm');
            const firstName = form.elements['firstname'].value.trim().toUpperCase();
            const middleInitial = form.elements['midinitial'].value.trim().toUpperCase();
            const lastName = form.elements['lastname'].value.trim().toUpperCase();
            const phoneNum = form.elements['Phonenum'].value.trim();
            const school = form.elements['schoolInput'].value.trim().toUpperCase();

            if (!/^[A-Za-z]+(?:\s[A-Za-z]+)*$/.test(firstName)) {
                ErrorMessage('Please enter letters only for First Name.');
                return;
            }

            if (!/^[A-Za-z]$/.test(middleInitial) && middleInitial.length > 0) {
                ErrorMessage('Please enter a letter only for Middle Initial.');
                return;
            }

            if (!/^[A-Za-z]+(?:\s[A-Za-z]+)*$/.test(lastName)) {
                ErrorMessage('Please enter letters only for Last Name.');
                return;
            }

            if (school.length == 0) {
                ErrorMessage('Please select your school.');
                return;
            }

            if (!/^[0-9]{10}$/.test(phoneNum)) {
                ErrorMessage('Please enter a 10-digit number only for Phone Number.');
                return;
            }

            submitAttendance(firstName, middleInitial, lastName, phoneNum, school, form);
        }

        async function submitAttendance(firstName, middleInitial, lastName, phoneNum, school, form) {

            const requestBody = {
                "fname": firstName,
                "minitial": middleInitial,
                "lname": lastName,
                "number": phoneNum,
                "school": school
            };

            try {
                const response = await fetch("http://localhost:8090/api/public/attendance", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(requestBody)
                });
                if (response.status === 409) {
                    ErrorMessage('You already submitted your attendance!');
                    form.reset();
                } else if (response.status === 400) {
                    ErrorMessage('Please check your data if it is correct.');
                } else if (response.status === 200) {
                    ConfirmationMessage("Submitted!");
                    form.reset();
                }

            } catch (error) {
                console.error('There was a problem with the fetch operation:', error);
            }
        }

        function ErrorMessage(Message) {
            document.getElementById('error-message').innerText = Message;
            document.getElementById('confirmation-message').innerText = null;
        }
        function ConfirmationMessage(Message) {
            document.getElementById('confirmation-message').innerText = Message;
            document.getElementById('error-message').innerText = null;
        }
    </script> -->
</body>

</html>