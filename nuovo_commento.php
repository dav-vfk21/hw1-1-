<?php
    require_once 'hw1_auth.php';

    if (!$userid = checkAuth()) exit;

     if(isset($_POST["comment_text"]) && isset($_POST["tipo"]) && (isset($_POST["series_id"]) || isset($_POST["film_id"])))
      {  
            $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
            $userid = mysqli_real_escape_string($conn, $userid);
            $comment_text = mysqli_real_escape_string($conn, $_POST["comment_text"]);
            $tipo = mysqli_real_escape_string($conn, $_POST["tipo"]);
    if ($tipo === 'serie' && isset($_POST["series_id"])){
             $series_id = mysqli_real_escape_string($conn, $_POST['series_id']);
            $result = mysqli_query($conn, "SELECT id FROM serie WHERE series_id = '$series_id'");
        if ($row = mysqli_fetch_assoc($result)) {
            $serie_id = $row['id'];
                $insert = mysqli_query($conn, "INSERT INTO comments_serie(user_id, serie_id, comment_text) VALUES('$userid', '$serie_id', '$comment_text')");
        }
           
       } elseif($tipo === 'film' && isset($_POST["film_id"])){
             $film_id_check = mysqli_real_escape_string($conn, $_POST['film_id']);
              $result = mysqli_query($conn, "SELECT id FROM film WHERE film_id = '$film_id_check'");
        if ($row = mysqli_fetch_assoc($result)) {
            $film_id = $row['id'];
             $insert = mysqli_query($conn, "INSERT INTO comments_film(user_id, film_id, comment_text) VALUES('$userid', '$film_id', '$comment_text')");
        }
     }
            mysqli_close($conn);
    echo json_encode(['success' => true]);
}
      else {
    echo json_encode(['success' => false, 'error' => 'Dati mancanti']);
}

?>