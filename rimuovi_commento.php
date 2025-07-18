<?php

    require_once 'hw1_auth.php';
    if (!$userid = checkAuth()) exit;

      if(isset($_POST["comment_id"])&& isset($_POST['tipo']))
      {
            $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'],$dbconfig['password'], $dbconfig['name']);
            $userid = mysqli_real_escape_string($conn, $userid);
            $id_commento = mysqli_real_escape_string($conn, $_POST["comment_id"]);
            $tipo = mysqli_real_escape_string($conn, $_POST["tipo"]);

       if ($tipo === 'serie') {
             $query = "DELETE FROM comments_serie WHERE id = '$id_commento' AND user_id = '$userid'";
        } else {
             $query = "DELETE FROM comments_film WHERE id = '$id_commento' AND user_id = '$userid'";
        }
         if (mysqli_query($conn, $query)) {
        echo json_encode(['ok' => true]);
    } else {
        echo json_encode(['ok' => false, 'error' => mysqli_error($conn)]);
    }
            mysqli_close($conn);
         }

?>