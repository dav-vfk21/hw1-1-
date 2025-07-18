<?php 
    require_once 'hw1_auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login_tvtime.php");
        exit;
    }
?>
<?php
if(isset($_GET['tipo'])){
  $tipo = $_GET['tipo'];
  }else{
    $tipo = 'serie';
  }
      $page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
   if(isset($_GET['id'])){
        $id= $_GET['id'];
      }else{
        $id = null;
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
        <link rel="stylesheet" href="sfoglia_serie-film.css">
    <script src ="sito_base.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gidole&display=swap" rel="stylesheet">
    </head>
    <body>
        <nav>
            <img src="tvtime-logo.png">        
               <div class = "show_list">
            <a href = 'sito_tvtime.php'><img src = 'precedente.png'></a><h2>Scopri di più</h2>
               </div>
          <?php  
             echo "<div class='scelta_generi'>";
            echo  "<div class='flex_scelta_generi'>";
            if ($tipo == 'serie' || $tipo == '' ) {
               echo "<a id='series' class='active' href='sfoglia_serie.php?tipo=serie'>Serie</a>";
               echo "<a id='films' href='sfoglia_film.php?tipo=film'>Film</a>";
            } elseif ($tipo == 'film') {
               echo "<a id='series' href='sfoglia_serie.php?tipo=serie'>Serie</a>";
               echo "<a id='films' class='active' href='sfoglia_film.php?tipo=film'>Film</a>";
            } 
                echo "</div>";
                echo "</div>";
          ?>
          
        </nav>

    <main>
        <section>

              <?php
        $api_key = '8394c5526d833373a7389670d508ee9f';

        if ($tipo === 'film') {
           $endpoint = 'movie';
        } else {
           $endpoint = 'tv';
        }

        $url = "https://api.themoviedb.org/3/discover/$endpoint?api_key=$api_key&id=$id&language=it-IT&page=$page";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($res, true);

          if(!$data || !isset($data['results'])){
            echo "<p>Errore nel caricamento dei contenuti</p>";
          }else{
            foreach ($data['results'] as $item){
              if(isset($item['title'])){
                $titolo = $item['title'];
              }
              else{
                $titolo = $item['name'];
              }
          if(isset($item['poster_path']) && $item['poster_path'] != ''){
            $immagine = "https://image.tmdb.org/t/p/w342". $item['poster_path'];
            }else{
              $immagine = "placeholder.jpg";
            }
            echo "<div class='card'>";
            echo "<a href ='info_elemento.php?tipo=$tipo&id={$item['id']}&titolo=$titolo'><img src='$immagine' value='$titolo' ></a>";
            echo "<h3>$titolo<button id = 'save_item'><img src ='salva_elemento.png'></button></h3>";
            echo "</div>";
          }
        }
         echo "<div class='paginazione'>";
if ($page > 1) {
    $prev = $page - 1;
    echo "<a href='sfoglia_serie.php?tipo=$tipo&page=$prev' class='pagina_destra'><img src='precedente.png'>Precedente</a>";
}

$next = $page + 1;
echo "<a href='sfoglia_serie.php?tipo=$tipo&page=$next' class='pagina_sinistra'>Successiva <img src = 'successivo.png'></a>";
echo "</div>";
      ?>

        </section>
    </main>
    </body>
</html>