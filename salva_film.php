<?php
    
    require_once 'hw1_auth.php';
    if (!$userid = checkAuth()) exit;

    tvtime_series();

    function tvtime_series() {
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        $userid = mysqli_real_escape_string($conn, $userid);
        $id_series = mysqli_real_escape_string($conn, $_POST['id']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);

        $query = "SELECT * FROM film WHERE user_id = '$userid' AND film_id = '$id_series'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) > 0) {
            echo json_encode(array('ok' => true));
            exit;
        }

        $query = "INSERT INTO film(user_id, film_id, content) VALUES('$userid','$id_series', JSON_OBJECT('id', '$id_series', 'image', '$image'))";
        error_log($query);
        if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
            echo json_encode(array('ok' => true));
            exit;
        }

        mysqli_close($conn);
        echo json_encode(array('ok' => false));
    }