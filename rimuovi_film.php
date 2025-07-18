<?php
    
    require_once 'hw1_auth.php';
    if (!$userid = checkAuth()) exit;

    tvtime_remove_film();

    function tvtime_remove_film() {
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        $userid = mysqli_real_escape_string($conn, $userid);
        $id_film = mysqli_real_escape_string($conn, $_POST['id']);

        $query = "SELECT * FROM film  WHERE user_id = '$userid' AND film_id = '$id_film'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if(mysqli_num_rows($res) === 0) {
            echo json_encode(array('ok' => false));
            exit;
        }

        $query = "DELETE FROM film WHERE user_id = '$userid' AND film_id = '$id_film'";
         if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
            echo json_encode(array('ok' => true));
            exit;
        }

        mysqli_close($conn);
        echo json_encode(array('ok' => false));
    }