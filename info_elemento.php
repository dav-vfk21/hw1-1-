<?php 
    require_once 'hw1_auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login_tvtime.php");
        exit;
    }
    if(isset($_GET['tipo'])){
  $tipo = $_GET['tipo'];
  }else{
    $tipo = 'serie';
  }
   if(isset($_GET['id'])){
        $id= $_GET['id'];
      }else{
        $id = null;
    }
    if(isset($_GET['visione'])){
      $visione = $_GET['visione'];
    }else{
      $visione = 'info';
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
  <meta name="viewport" content="width=device-width,initial-scale=1" >
    <link rel="stylesheet" href="info_elemento.css">
    <script src ="info_elemento.js" defer></script>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Figtree:ital,wght@0,300..900;1,300..900&family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&display=swap" rel="stylesheet">
    </head>
<body>
     <nav>
            <div class = "pagina_precedente">
        <a href = 'sito_tvtime.php'><img src = 'precedente.png'></a>
             </div>
         
    <?php   

        $api_key = '8394c5526d833373a7389670d508ee9f'; 

        if ($tipo === 'film') {
           $endpoint = 'movie';
        } else {
           $endpoint = 'tv';
        }

        $url = "https://api.themoviedb.org/3/$endpoint/$id?api_key=$api_key&language=it-IT";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($res, true);
        
      if(isset($data['name'])){
        $title = $data['name'];
      }elseif(isset($data['title'])){
        $title = $data['title'];
    }else{
        $title = 'Titolo non disponibile';
    }
        echo "<div id = 'poster'>";    
       
        if (isset($data['poster_path'])) {
    $poster_url = "https://image.tmdb.org/t/p/w500" . $data['poster_path'];
    echo "<img src='$poster_url'>";
    echo "<div class = 'titolo_container'><h1 class = 'titolo'>$title</h1></div>";
    }else{
      $poster_url = "placeholder.jpg";
      echo "<img src = '$poster_url'>";
      echo "<h1 class = 'titolo'>Titolo non disponibile</h1>";
    } 
    echo "</div>"; 
?>
   </nav>
   <header> 
    <div class = "info_elemento">

    
          <?php      
        if ($tipo === 'film') {
            $url = "https://api.themoviedb.org/3/movie/$id?api_key=$api_key&language=it-IT";
        } else {
            $url = "https://api.themoviedb.org/3/tv/$id?api_key=$api_key&language=it-IT";
        }

             $curl = curl_init();
             curl_setopt($curl, CURLOPT_URL, $url);
             curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
             $response = curl_exec($curl);
             curl_close($curl);

             $item = json_decode($response, true); 

             echo "<div class='scelta'>";
            echo  "<div class='flex_scelta_info'>";
            if ($tipo == 'serie' && $visione == 'info' ) {
               echo "<a id='info' class='active' href='info_elemento.php?tipo=serie&id=$id&visione=info'>Info</a>";
               echo "<a id='episodi' href='info_elemento.php?tipo=serie&id=$id&visione=episodi'>Episodi</a>";
            }elseif ($tipo == 'serie' && $visione == 'episodi'){
               echo "<a id='info'href='info_elemento.php?tipo=serie&id=$id&visione=info'>Info</a>";
               echo "<a id='episodi'class='active' href='info_elemento.php?tipo=serie&id=$id&visione=episodi'>Episodi</a>";
            } else{
               echo "<a id='info'  class='active' href='info_elemento.php?tipo=film&id=$id&visione=info'>Info</a>";
            }
                echo "</div>";
                echo "</div>";
          ?>
          </div>
    </header>
    <section>    
      <?php
        if($tipo === 'serie'){
          if(isset($item['seasons']) && $item['seasons'] !== ''){
            $num_stagioni = count($item['seasons']) . ' '. 'stagioni';
          }
          if(isset($item['first_air_date']) && $item['first_air_date'] !== ''){
            $data_rilascio = $item['first_air_date'];
          }
          if(isset($item['status']) && $item['status'] !== ''){
            $stato = $item['status'];
          }
        }
        else{ 
          $num_stagioni = '';
          $data_rilascio = '';
          $stato = '';
        }
         if (isset($item['vote_average']) && $item['vote_average'] !== '') {
              $rating_vote = $item['vote_average'];
        }
        else{
          $rating_vote = 0 ;
        }

        if($rating_vote <= 1.5){
          $img_voto = '1-stella.png';
        }
        elseif($rating_vote <= 3.5){
          $img_voto = '2-stelle.png';
        }
        elseif($rating_vote <= 6.5){
          $img_voto = '3-stelle.png';
        }
        elseif($rating_vote <= 8.5){
          $img_voto = '4-stelle.png';
        }
        elseif($rating_vote <= 10){
          $img_voto = '5-stelle.png';
        }
          
        if ($tipo === 'film') {
            $url_cast = "https://api.themoviedb.org/3/movie/$id/credits?api_key=$api_key&language=it-IT";
        } else {
            $url_cast = "https://api.themoviedb.org/3/tv/$id/credits?api_key=$api_key&language=it-IT";
      }

        $curl_cast = curl_init();
        curl_setopt($curl_cast, CURLOPT_URL, $url_cast);
        curl_setopt($curl_cast, CURLOPT_RETURNTRANSFER, 1);
        $response_cast = curl_exec($curl_cast);
        curl_close($curl_cast);

        $item_cast = json_decode($response_cast, true);
        
if ($tipo == 'serie' ) {
    if ($visione == 'info') {
         echo "<div id = 'separatore'></div>";
        echo "<h2>Informazioni sulla serie</h2>";
        echo "<p> $num_stagioni * $data_rilascio * $stato</p>";
        echo "<img id = 'logo'src ='tvtime-icon-flat-square.png'><img id = 'voto' src = '$img_voto'>$rating_vote/10";
        if(!$item['overview']){
          echo "<p>Nessuna trama disponibile</p>";
        }else{
          echo "<p>".$item['overview']. "</p>";
        }
        echo "<div id = 'separatore'></div>";
        echo "<div class = 'info_cast'>";
        echo "<div class='cast'><h2>Cast</h2></div>";
        echo "<div class ='flex_cast'>";

        $numero_attori = 0;

        if (isset($item_cast['cast'])) {
    foreach ($item_cast['cast'] as $attore ) {
      if($numero_attori >= 16) break;
          $nome_attore = $attore['name'];
          $nome_personaggio = $attore['character'];
          
          if($attore['profile_path']){
            $img_attore =  'https://image.tmdb.org/t/p/w200' .$attore['profile_path'];
          }
          else{
            $img_attore ='placeholder.jpg';
          }
          
        echo "<div class='cast_member'>";
        echo "<img src='$img_attore' value =' $nome_attore'>";
        echo "<div class='nome_attore'>$nome_attore</div>";
        echo "<div class='nome_personaggio'>($nome_personaggio)</div>";
        echo "</div>";
        
        $numero_attori++;
       }
       if(!$numero_attori){
        echo "<p>Cast non disponibile</p>";
       }
    }
    echo "</div>";
    echo "</div>";
   echo "<div id = 'separatore'></div>";
   echo "<div class = 'link_commenti'>";
   echo "<h2>Commenti</h2><a href = 'commenti.php?tipo=$tipo&id=$id&titolo=$title' id = 'commenti'><img src = 'successivo.png'></a>";
    }
    elseif ($visione == 'episodi') {
      for($stagione = 1;$stagione <= count($item['seasons']);$stagione++){
         echo "<div id = 'separatore'></div>"; 
       echo "<h2>Episodi Stagione : $stagione</h2>";
       
        $url_stagioni = "https://api.themoviedb.org/3/tv/$id/season/$stagione?api_key=$api_key&language=it-IT";

        
        $curl_episodi = curl_init();
        curl_setopt($curl_episodi, CURLOPT_URL, $url_stagioni);
        curl_setopt($curl_episodi, CURLOPT_RETURNTRANSFER, 1);
        $response_episodi = curl_exec($curl_episodi);
        curl_close($curl_episodi);

        $episodi = json_decode($response_episodi, true);


if (isset($episodi['episodes']) && count($episodi['episodes']) > 0) {
    echo "<div class='lista_episodi'>";
    foreach ($episodi['episodes'] as $ep) {
        $titolo = $ep['name'];
        if($ep['still_path']){
          $immagine = 'https://image.tmdb.org/t/p/w300' . $ep['still_path'];;
        }else{
          $immagine = 'placeholder.jpg';
        }
        $numero = $ep['episode_number'];

        echo "<div class='episodio'>";
        echo "<img src='$immagine'>";
        echo "<div class='info_episodio'>";
        echo "<h3>$numero : $titolo</h3>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
      }
      }
      }
} elseif ($tipo == 'film') {
    echo "<div class = 'state'><img src = 'calendario.png'>".$item['release_date']."</div>";
    echo "<div id = 'separatore'></div>";
    echo "<h2>Informazioni Film</h2>";
    echo "<img id = 'logo'src ='tvtime-icon-flat-square.png'><img id = 'voto' src = '$img_voto'>$rating_vote/10";
       if(!$item['overview']){
          echo "<p>Nessuna trama disponibile</p>";
        }else{
          echo "<p>".$item['overview']. "</p>";
        }
    echo "<div id = 'separatore'></div>";
     echo "<div class = 'info_cast'>";
        echo "<div class='cast'><h2>Cast</h2></div>";
        echo "<div class ='flex_cast'>";

        $numero_attori = 0;

        if (isset($item_cast['cast'])) {
    foreach ($item_cast['cast'] as $attore ) {
      if($numero_attori >= 16) break;
          $nome_attore = $attore['name'];
          $nome_personaggio = $attore['character'];
          
          if($attore['profile_path']){
            $img_attore =  'https://image.tmdb.org/t/p/w200' .$attore['profile_path'];
          }
          else{
            $img_attore ='placeholder.jpg';
          }
          
        echo "<div class='cast_member'>";
        echo "<img src='$img_attore' value =' $nome_attore'>";
        echo "<div class='nome_attore'>$nome_attore</div>";
        echo "<div class='nome_personaggio'>($nome_personaggio)</div>";
        echo "</div>";
        
        $numero_attori++;
       }
       if(!$numero_attori){
        echo "<p>Cast non disponibile</p>";
       }
    }
    echo "</div>";
    echo "</div>";
   echo "<div id = 'separatore'></div>";
   echo "<div class = 'link_commenti'>";
   echo "<h2>Commenti</h2><a href = 'commenti.php?tipo=$tipo&id=$id&titolo=$title' id = 'commenti'><img src = 'successivo.png'></a>";
 
}
?>

</section>
            <footer>
              <div id = "salva_elemento">
            <button><img src = 'salva_elemento.png'><span id ="testo">Aggiungi elemento in lista</span></button>
          </div>
        </footer>
        <script>
  const elementoDaSalvare = {
    id: "<?php echo $id; ?>",
    image: "<?php echo $poster_url; ?>",
    tipo: "<?php echo $tipo; ?>"
  };
</script>
    </body>
</html>