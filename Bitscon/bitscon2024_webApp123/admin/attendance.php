<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-3w3c2M1GyvwhTWeEdz6pHgmsavfVzca6xWoT/ZVnDXeQUq2KKZKM+d+4Uws/zlYFm3nILHRaEtbUJwXbpYpWhQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../../css/style.css" />

    <link rel="icon" type="image/png" href="../../images/cnsclogo.png" />
    <title>Bitscon - Admin</title>
</head>

<body>
    
    <?php
    session_start();

    if(!isset($_SESSION['username'])) {
        //header('Location: admin_login.php');
        header("location: login.php");
        exit;
    }
    ?>
        
    
    <!-- Header -->
    <div class="container-fluid header_tab">
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="../../images/cnsclogo.png" width="90px" height="85px" />
            </div>

            <div class="col-md-6 text-center">
                <span style="line-height: 1.5">
                    <h4 style="margin-bottom: 0; margin-top: 10px">
                        BITSCON 2024 ATTENDANCE TRACKING FORM
                    </h4>
                    <p style="margin-top: 0">
                        Camarines Norte State College<br />April 23-26, 2024
                    </p>
                </span>
            </div>

            <div class="col-md-3 text-center">
                <img src="../../images/cnsclogo.png" width="90px" height="85px" />
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light custom-bg-navbar">
        <!-- <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="registered/index.php">Registered List<span
                        class="sr-only">(current)</span></a>

                <a class="nav-link active" href="attendance.php">Attendee List</a>

                <?php if(isset($_SESSION['username'])) { ?>
                    <a class="nav-link" href="../../config/logout.php">Logout</a>
                <?php } ?>

            </div>
        </div>
    </nav>


    <br />

    <div class="container text-center">
        <h3>Attendee List</h3>
        <hr>
    </div>

    <!-- Table Filter -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="schoolInput">School:</label>
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

                    <!-- <select class="form-control" id="schoolInput" name="schoolInput" onchange="filterTable()">
                        <option value="SELECT_ALL">All</option>
                        <option value="Camarines Norte State College">Camarines Norte State College</option>
                        <option value="Mabini Colleges">Mabini Colleges</option>
                        <option value="Ateneo De Naga">Ateneo De Naga</option>
                    </select> -->
                </div>
            </div>

            <!-- Call out the retrieve attendee -->
            <?php include '../../config/retrieve_attendance.php'; ?>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="schoolInput">Date:</label>
                    <select class="form-control" id="dateInput" name="dateInput" onchange="filterTable()">
                        <?php echo $options; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4 text-right">
                <br />
            </div>
        </div>
        <hr>
    </div>
    <br />

    <div class="container container_menu">
        <div class="table-responsive-lg">
            <table class="table table-hover table-custom" id="attendanceTable">
                <thead>
                    <tr>
                        <th scope="col">Attendee ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Mobile Number</th>
                        <th scope="col">School</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $tableRows; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function filterTable() {
            var school = document.getElementById('schoolInput').value;
            var date = document.getElementById('dateInput').value;

            var rows = document.querySelectorAll('#attendanceTable tbody tr');

            rows.forEach(row => {
                var rowSchool = row.cells[3].innerText; // Assuming the school name is in the 4th cell
                var rowDate = row.cells[4].innerText; // Assuming the date is in the 5th cell

                if ((school === 'SELECT_ALL' || rowSchool === school) && (date === 'SELECT_ALL' || rowDate === date)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
        function updateRow(attendeeId) {
            console.log("Editing Attende ID: " + attendeeId);
        }
    </script>

</body>

</html>