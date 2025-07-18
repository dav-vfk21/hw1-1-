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
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel='stylesheet' href='utente.css'>
        <script src='utente.js' defer></script>
         <link rel="preconnect" href="https://fonts.googleapis.com">
       <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Gidole&display=swap" rel="stylesheet">
        <meta charset="utf-8">
        <title>TV TIME - <?php echo $userinfo['name']." ".$userinfo['surname'] ?></title>
    </head>
         <body>
            <header>
        <nav>
            <div class = "logo">
               <img src="tvtime-icon-flat-square.png">TV TIME
            </div>
           <div class = "info_utente">
       <h1><?php echo $userinfo['name']." ".$userinfo['surname'] ?></h1>
           </div>
        </nav>
    </header>
    <main>
        <section class = "general">
            <div class = "Serie">
                  <h1>Serie<a href = "all_show.php"><img src = 'freccia_section.png'></a></h1>
                  <div id = "lista_series">

                  </div>
            </div>
     
            <div class = "Film">
                <h1>Film<a href = "all_movies.php"><img src = 'freccia_section.png'></a></h1>
                 <div id = "lista_film">

                 </div>
            </div>
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

<?php mysqli_close($conn); ?>
