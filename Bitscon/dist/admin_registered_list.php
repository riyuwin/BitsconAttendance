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
                <img src="../images/cnsclogo.png" width="90px" height="85px" />
            </div>
        </div>
    </div>
    <br />

    <div class="container text-center">
        <h3>Registered Attendee List</h3>
        <hr>
    </div>

    <!-- Table -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="schoolInput">School:</label>
                    <select class="form-control" id="schoolInput" name="schoolInput">
                        <option value="SELECT_ALL">All</option>
                        <option value="Camarines Norte State College">Camarines Norte State College</option>
                        <option value="Mabini Colleges">Mabini Colleges</option>
                        <option value="Ateneo De Naga">Ateneo De Naga</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <label for="excelUpload">Update Registered List:</label>
                <input class="form-control form-control-sm" id="excelUpload" type="file" name="excelUpload" />
                <!--CREATE AN UPLOAD BUTTON THAT CALLS THE FUNCTION NAMED UploadFile() FROM PHP-->
            </div>
        </div>
        <hr>
    </div>
    <br />

    <!-- Call out the retrieve attendee -->
    <?php include '../config/retrieve_registered.php'; ?>

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
</body>

</html>