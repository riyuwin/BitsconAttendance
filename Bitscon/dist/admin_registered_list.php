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

    <link rel="stylesheet" href="../css/style.css" />

    <link rel="icon" type="image/png" href="../images/cnsclogo.png" />
    <title>Bitscon - Admin</title>
</head>

<body>




    <!-- Header -->
    <div class="container-fluid header_tab">
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="../images/cnsclogo.png" width="90px" height="85px" />
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
                <img src="../images/codite.png" width="110px" height="100px" />
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
                <a class="nav-link active" href="admin_registered_list.php">Registered List<span class="sr-only">(current)</span></a>
                <a class="nav-link" href="admin_attendance_list.php">Attendee List</a> 
            </div>
        </div>
    </nav>

    

    <br />

    

    <div class="container text-center">
        <h3>Registered Attendee List</h3>
        <hr>
    </div>

    <!-- Call out the retrieve attendee -->
    <?php include '../config/retrieve_registered.php'; ?>

    <!-- Table -->
    <div class="container"> 
        <div class="row"> 
            <div class="col-md-12">
                <h5>Upload File:</h5>
            </div>


            <div class="col-md-6">
                <label for="excelUpload">Update Registered List:</label>
                <input  id="excelUpload" type="file" name="excelUpload" /> 
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
                    <input type="text" id="searchInput" name="searchInput" class="form-control" pattern="[A-Za-z ]+" placeholder="Search" required />

                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="schoolInput">School:</label>            
                    <select class="form-control" id="schoolInput" name="schoolInput" onchange="filterTable()">
                        <option value="SELECT_ALL">All</option>
                        <option value="Camarines Norte State College">Camarines Norte State College</option>
                        <option value="Mabini Colleges">Mabini Colleges</option>
                        <option value="Ateneo De Naga">Ateneo De Naga</option>
                    </select>

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
                    </tr>
                </thead>
                <tbody>
                    <?php echo $tableRows; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        function filterTable() {
            var school = document.getElementById('schoolInput').value;
            var rows = document.querySelectorAll('#attendanceTable tbody tr');

            rows.forEach(row => {
                var rowSchool = row.cells[3].innerText; // Assuming the school name is in the 4th cell 

                if (school === 'SELECT_ALL' || rowSchool === school) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>


    <script>
    $(document).ready(function() {
        // Function to handle live filtering based on search input
        $('#searchInput').on('input', function() {
            var searchText = $(this).val().toLowerCase(); // Get the search text and convert to lowercase for case-insensitive search
            $('#attendanceTable tbody tr').each(function() {
                var rowData = $(this).find('td').text().toLowerCase(); // Get the text content of all cells in this row
                if (rowData.includes(searchText)) { // Check if the row data contains the search text
                    $(this).show(); // Show the row if it matches the search
                } else {
                    $(this).hide(); // Hide the row if it doesn't match the search
                }
            });
        });
    });
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
            xhr.open('POST', '../config/upload_excel.php', true);

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
            xhr.open('GET', '../config/clear_database.php', true);

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
</body>

</html>