<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    echo "NOT_LOGGED_IN";
} else {
    echo $_SESSION['loggedin'];
    echo "LOGGED_IN";
}
?>