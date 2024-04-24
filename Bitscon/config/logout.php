<?php

    session_start();
    if (session_destroy()){
        header("location: ../bitscon2024_webApp123/admin/login.php");
    }

?>