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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/style.css" />

    <link rel="icon" type="image/png" href="../../../images/cnsclogo.png" />
    <title>Bitscon - Admin</title>
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['username'])) {
        //header('Location: admin_login.php');
        header("location: ../login.php");
        exit;
    }
    ?>


    <!-- Header -->
    <div class="container-fluid header_tab">
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="../../../images/cnsclogo.png" width="90px" height="85px" />
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
                <img src="../../../images/codite.png" width="110px" height="100px" />
            </div>



        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light custom-bg-navbar">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">

                <a class="nav-link active" href="#">Registered List<span class="sr-only">(current)</span></a>

                <a class="nav-link" href="../attendance">Attendee List</a>


                <?php if (isset($_SESSION['username'])) { ?>
                    <a class="nav-link" href="../../../config/logout.php">Logout</a>
                <?php } ?>

            </div>
        </div>
    </nav>



    <br />



    <div class="container text-center">
        <h3>Registered Attendee List</h3>
        <hr>
    </div>

    <!-- Call out the retrieve attendee -->
    <?php include '../../../config/retrieve_registered.php'; ?>

    <!-- Table -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h5>Upload File:</h5>
            </div>


            <div class="col-md-6">
                <label for="excelUpload">Update Registered List:</label>
                <input id="excelUpload" type="file" name="excelUpload" />
            </div>

            <div class="col-md-6">
                <button class="btn btn-primary" id="uploadButton">Upload File</button>
            </div>
        </div>
        <hr>
    </div>
    <!-- Table -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h5>Filter:</h5>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="schoolInput">Search:</label>
                    <input type="text" id="searchInput" name="searchInput" class="form-control" pattern="[A-Za-z ]+"
                        placeholder="Search" required />

                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="schoolInput">School:</label>
                    <div class="form-outline mb-4">
                        <select class="form-control" id="schoolInput" name="schoolInput" required>
                            <option value="">ALL SCHOOLS</option>
                            <option value="ACLC COLLEGE SORSOGON">ACLC College Sorsogon</option>
                            <option value="ACLC COLLEGE OF IRIGA, INC.">ACLC College Of Iriga, Inc.</option>
                            <option value="AEMILIANUM COLLEGE INC.">Aemilianum College Inc.</option>
                            <option value="ATENEO DE NAGA UNIVERSITY">Ateneo De Naga University</option>
                            <option value="BAAO COMMUNITY COLLEGE">Baao Community College</option>
                            <option value="BICOL COLLEGE">Bicol College</option>
                            <option value="BICOL UNIVERSITY - MAIN">Bicol University - Main</option>
                            <option value="BICOL UNIVERSITY POLANGUI">Bicol University Polangui</option>
                            <option value="CAMARINES NORTE STATE COLLEGE">Camarines Norte State College</option>
                            <option value="CAMARINES SUR POLYTECHNIC COLLEGES">Camarines Sur Polytechnic Colleges
                            </option>
                            <option value="CENTRAL BICOL STATE UNIVERSITY OF AGRICULTURE - SIPOCOT">Central Bicol State
                                University Of Agriculture - Sipocot</option>
                            <option value="COMPUTER COMMUNICATION DEVELOPMENT INSTITUTE, INC. LEGAZPI">Computer
                                Communication Development Institute, Inc. Legazpi</option>
                            <option value="COMPUTER COMMUNICATION DEVELOPMENT INSTITUTE, INC. SORSOGON">Computer
                                Communication Development Institute, Inc. Sorsogon</option>
                            <option value="COMPUTER SYSTEM INSTITUTE, INC.">Computer System Institute, Inc.</option>
                            <option value="DEBESMSCAT">DEBESMSCAT</option>
                            <option value="DIVINE WORD COLLEGE OF LEGAZPI">Divine Word College Of Legazpi</option>
                            <option value="MABINI COLLEGES, INC.">Mabini Colleges, Inc.</option>
                            <option value="PARTIDO STATE UNIVERSITY">Partido State University</option>
                            <option value="SLTCFPDI">SLTCFPDI</option>
                            <option value="SORSOGON STATE UNIVERSITY - BULAN CAMPUS">Sorsogon State University - Bulan
                                Campus</option>
                            <option value="THE LEWIS COLLEGE">The Lewis College</option>
                            <option value="UNIVERSITY OF SANTO TOMAS-LEGAZPI">University Of Santo Tomas-Legazpi</option>
                            <option value="others">Others</option>
                        </select>

                    </div>
                </div>
            </div>


        </div>

    </div>
    </div>


    <br />

    <div class="container container_menu">
        <div class="table-responsive-lg">
            <table class="table table-hover  table-custom" id="attendanceTable">
                <thead>
                    <tr>
                        <th scope="col">Attendee ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Mobile Number</th>
                        <th scope="col">School</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody id="attendeeTableBody">
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.getElementById("schoolInput").addEventListener("change", getAttendeeData);
        document.getElementById("searchInput").addEventListener("input", getAttendeeData);
        document.addEventListener("DOMContentLoaded", function () {
            getAttendeeData();
        });
        function getAttendeeData() {
            const selectElement = document.getElementById("schoolInput");
            const school = selectElement.options[selectElement.selectedIndex].value;
            const searchText = document.getElementById("searchInput").value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../../../config/filter_registration.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var data = JSON.parse(xhr.responseText);
                    populateTable(data);
                }
            };
            var params = 'searchText=' + encodeURIComponent(searchText) +
                '&school=' + encodeURIComponent(school);
            xhr.send(params);
        }

        function populateTable(data) {
            var tableBody = document.getElementById("attendeeTableBody");
            var tableRows = ""; // Build table rows in a string
            data.forEach(function (row) {
                tableRows += "<tr>";
                tableRows += "<td>" + row.attendeeId + "</td>";
                tableRows += "<td>" + row.name + "</td>";
                tableRows += "<td>" + row.mobileNumber + "</td>";
                tableRows += "<td>" + row.school + "</td>";
                tableRows += "<td><a href='update?id=" + row.attendeeId + "&fname=" + row.fname + "&lname=" + row.lname + "&mobile=" + row.mobileNumber + "&school=" + row.school + "' class='btn btn-primary btn-sm'>Edit</a></td>";
                tableRows += "</tr>";
            });
            // Update the innerHTML once
            tableBody.innerHTML = tableRows;
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
    <script>

        document.getElementById("uploadButton").addEventListener("click", handleFileUpload);

        function handleFileUpload(event) {
            var fileInput = document.getElementById("excelUpload");
            var file = fileInput.files[0];

            if (!file) {
                console.error("No file selected.");
                return;
            }

            // Check if the selected file is an Excel file
            if (file.type !== "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
                console.error("Please select an Excel file.");
                return;
            }

            var reader = new FileReader();
            reader.onload = function (event) {
                var data = new Uint8Array(event.target.result);
                var workbook = XLSX.read(data, { type: 'array' });
                processExcelData(workbook);
            };
            reader.readAsArrayBuffer(file);
        }

        function processExcelData(workbook) {
            var sheet = workbook.Sheets[workbook.SheetNames[0]];
            var excelData = XLSX.utils.sheet_to_json(sheet, { header: 1 });

            clearDatabase();

            // Assuming the Excel file has columns: First Name, Last Name, School, Number
            // You may need to adjust this based on your actual Excel file structure
            for (var i = 1; i < excelData.length; i++) { // Start from 1 to skip header row
                var row = excelData[i];
                var fname = row[0];
                var lname = row[1];
                var school = row[2];
                var number = row[3];

                // Insert data into database (You'll need a server-side API for this)
                insertDataIntoDatabase(fname, lname, school, number);
            }
        }

        function insertDataIntoDatabase(fname, lname, school, number) {
            if (fname == null || lname == null) {
                console.log("Skipped undefined.");
                return;
            } else {
                console.log("Good data.");
            }
            if (number == undefined) number = null;

            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Define the request parameters (method, URL, async)
            xhr.open('POST', '../../../config/upload_excel.php', true);

            // Set the request header if necessary (e.g., content-type)
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            // Define the callback function to handle the response
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText); // Log the response from the server
                }
            };

            // Prepare the data to be sent in the request body
            var params = 'fname=' + encodeURIComponent(fname) +
                '&lname=' + encodeURIComponent(lname) +
                '&school=' + encodeURIComponent(school) +
                '&number=' + encodeURIComponent(number);

            // Send the request with the data
            xhr.send(params);
        }

        function clearDatabase() {
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Define the request parameters (method, URL, async)
            xhr.open('GET', '../../../config/clear_database.php', true);

            // Define the callback function to handle the response
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText); // Log the response from the server
                }
            };

            // Send the request
            xhr.send();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
</body>

</html>