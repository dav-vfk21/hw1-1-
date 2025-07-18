<?php
    include 'hw1_dbconfig.php';

    session_start();
    session_destroy();

    header('Location: login_tvtime.php');
?>