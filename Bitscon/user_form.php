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
    <link rel="icon" type="image/png" href="images/cnsclogo.png" />

    <link rel="stylesheet" href="css/design.css" />


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
                                        <img src="images/threelogos.png" style="width: 300px; padding-bottom: 30px;" alt="logo">
                                        <h4 class="gradient-text mt-1 mb-5 pb-1" style="font-family: Lexend;"><b>BITSCON 2024 ATTENDANCE TRACKING
                                                FORM</b></h4>
                                    </div>
                                        <form action="config/save_user_form.php" method="POST" id="attendanceForm">
                                            <p>Please enter details for attendance:</p>

                                            <div class="form-outline mb-4">
                                                <input type="text" id="firstname" name="firstname" class="form-control"
                                                    pattern="^[A-Za-z]+(?:\s+[A-Za-z]+)?$" placeholder="First Name" required />
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="text" id="lastname" name="lastname" class="form-control"
                                                pattern="^[A-Za-z]+(?:\s+[A-Za-z]+)?$" placeholder="Last Name" required />
                                            </div>

                                            <div class="form-outline mb-4">
                                                <select class="form-control" id="schoolInput" name="schoolInput" onchange="toggleOtherInput()"required>
                                                    <option value="">--- Select School Name ---</option>
                                                    <option value="ACLC COLLEGE SORSOGON">ACLC College Sorsogon</option>
                                                    <option value="ACLC COLLEGE OF IRIGA, INC.">ACLC College Of Iriga, Inc.</option>
                                                    <option value="AEMILIANUM COLLEGE INC.">Aemilianum College Inc.</option>
                                                    <option value="ATENEO DE NAGA UNIVERSITY">Ateneo De Naga University</option>
                                                    <option value="BAAO COMMUNITY COLLEGE">Baao Community College</option>
                                                    <option value="BICOL COLLEGE">Bicol College</option>
                                                    <option value="BICOL UNIVERSITY - MAIN">Bicol University - Main</option>
                                                    <option value="BICOL UNIVERSITY POLANGUI">Bicol University Polangui</option>
                                                    <option value="CAMARINES NORTE STATE COLLEGE">Camarines Norte State College</option>
                                                    <option value="CAMARINES SUR POLYTECHNIC COLLEGES">Camarines Sur Polytechnic Colleges</option>
                                                    <option value="CENTRAL BICOL STATE UNIVERSITY OF AGRICULTURE - SIPOCOT">Central Bicol State University Of Agriculture - Sipocot</option>
                                                    <option value="COMPUTER COMMUNICATION DEVELOPMENT INSTITUTE, INC. LEGAZPI">Computer Communication Development Institute, Inc. Legazpi</option>
                                                    <option value="COMPUTER COMMUNICATION DEVELOPMENT INSTITUTE, INC. SORSOGON">Computer Communication Development Institute, Inc. Sorsogon</option>
                                                    <option value="COMPUTER SYSTEM INSTITUTE, INC.">Computer System Institute, Inc.</option>
                                                    <option value="DEBESMSCAT">DEBESMSCAT</option>
                                                    <option value="DIVINE WORD COLLEGE OF LEGAZPI">Divine Word College Of Legazpi</option>
                                                    <option value="MABINI COLLEGES, INC.">Mabini Colleges, Inc.</option>
                                                    <option value="PARTIDO STATE UNIVERSITY">Partido State University</option>
                                                    <option value="SLTCFPDI">SLTCFPDI</option>
                                                    <option value="SORSOGON STATE UNIVERSITY - BULAN CAMPUS">Sorsogon State University - Bulan Campus</option>
                                                    <option value="THE LEWIS COLLEGE">The Lewis College</option>
                                                    <option value="UNIVERSITY OF SANTO TOMAS-LEGAZPI">University Of Santo Tomas-Legazpi</option>
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
                                    <img class="logo" src="images/codite.png" alt="image" width="400" height="340">
                                 
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