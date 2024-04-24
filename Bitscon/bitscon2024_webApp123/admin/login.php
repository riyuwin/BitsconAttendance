<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Muhamad Nauval Azhar">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="This is a login page template based on Bootstrap 5">
    <title>Admin | Attendance Tracking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lexend' rel='stylesheet'>
    <style>
        .show-password-btn {
            cursor: pointer;
        }

        h1 {
            font-family: Lexend;
        }

        .btn {
            font-family: Lexend;
        }
    </style>
</head>

<body>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <img src="../../images/threelogos.png" alt="logo" width="350" height="100">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Admin Login</h1>
                            <form action="../config/login.php" method="POST">
                                <div class="mb-3">
                                    <label class="mb-2 text-muted">Username</label>
                                    <input id="username" type="text" class="form-control" name="username" value=""
                                        required>
                                </div>
                                <div id="error-message-username" class="text-danger"></div>

                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="password">Password</label>
                                        <div class="input-group">
                                            <input id="password" type="password" class="form-control" name="password"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div id="error-message-password" class="text-danger"></div>

                                <br>
                                <div class="d-flex align-items-center">
                                    <button type="submit" name="submit" class="btn btn-outline-secondary ms-auto">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function signinAttempt(event) {
            event.preventDefault();
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Define the request parameters (method, URL, async)
            xhr.open('POST', '../../config/login.php', true);

            // Set the request header if necessary (e.g., content-type)
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            // Define the callback function to handle the response
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    if (xhr.responseText === "200:OK") {
                        window.location.href = 'attendance.php';
                    } else if (xhr.responseText === "PASSWORD_INCORRECT") {
                        ErrorMessage('password', 'Incorrect Password!');
                        ErrorMessage('username', null);
                    } else if (xhr.responseText === "USERNAME_NOT_FOUND") {
                        ErrorMessage('username', 'Incorrect Username!');
                        ErrorMessage('password', null);
                    }
                    console.log(xhr.responseText);
                }
            };

            // Prepare the data to be sent in the request body
            var params = 'username=' + encodeURIComponent(username) +
                '&password=' + encodeURIComponent(password);

            // Send the request with the data
            xhr.send(params);
        }

        function ErrorMessage(Target, Message) {
            document.getElementById('error-message-'+Target).innerText = Message;
        }

    </script>

</body>

</html>