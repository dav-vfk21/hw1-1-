<?php 
    require_once 'hw1_auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login_tvtime.php");
        exit;
    }
?>

<html>
      <?php 
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT * FROM users WHERE id = '$userid'";
    $res_1 = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res_1);   
  ?>

    <head> 
        <title>TV TIME</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="sito_base.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gidole&display=swap" rel="stylesheet">
    </head>
    <body>
        <nav>
            <img src="tvtime-logo.png">
            <p><a class = "login" href='logout_tvtime.php'>Esci dalla sessione</a></p>
        </nav>
        <header>
        <div class = "show_list">
            <h2>Comincia a salvare qualche serie o film!</h2>
          <div class ="sfoglia_serie"><a href="sfoglia_serie.php">Sfoglia tutte le serie</a></div>
        </div>
    </header>
    <main>
        <section>

        </section>
    </main>
        <footer>
            <a href = "sito_tvtime.php" class = "link_serie"><img src='serie.png'>Serie</a>
            <a href = "film.php" class = "link_film"><img src='film.png'>Film</a>
            <a href = "esplora.php" class = "link_esplora"><img src= 'icona_ricerca.png'>Esplora</a>
            <a href = "utente.php" class = "link_utente"><img src = 'utente.png'>Profilo</a>
        </footer>
    </body>
</html>