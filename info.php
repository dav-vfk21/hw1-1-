<?php 
include_once 'hw1_auth.php';

if(isset($_GET['tipo'])){
  $tipo = $_GET['tipo'];
  }else{
    $tipo = 'serie';
  }
?>
<html>   
   <head> 
     <title><?php
     if (isset($_GET['title'])) { 
    $title = $_GET["title"];
    echo  $title . " | TV TIME";
     }
    ?>
      </title> 
  <meta name="viewport" content="width=device-width,initial-scale=1" >
    <link rel="stylesheet" href="info.css">
    <script src ="info.js" defer></script>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Figtree:ital,wght@0,300..900;1,300..900&family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&display=swap" rel="stylesheet">
    </head><body>
      <nav class="schermata_logo">
        <div class="interno_logo"> 
            <a class="Postazione base"href="index.php">
                <img src="tvtime-logo.png">
            </a>
            <div class="offcanvas-body">
                <div class="justify-content_start_flex-grow-1_nav">
                    <div id="link">
                      <div class="dropdown_serie">
                        <div id="serie"><strong id="sezione_serie">Serie</strong></div>
                        <button class="bottone_serie"><img src="freccia_giu.png"></button>
                        <div id="pulsante_giu_serie" class="hidden1">
                            <a href="tendenza_serie.php">Di tendenza</a>
                            <a href="most_add_series.php">I piu'aggiunti</a>
                            <a href="most_watch_series.php">Piu'visti</a>
                            <a href="most_watch_series_lasthour.php">Le piu'viste</a>
                        </div>
                      </div>
                      <div class="dropdown_film">
                        <div id="film"><strong id="sezione_film">Film</strong></div>
                        <button class="bottone_film"><img src="freccia_giU.png"></button>
                        <div id="pulsante_giu_film" class="hidden2">
                            <a href="tendenza_film.php">Di tendenza</a>
                            <a href="most_add_film.php">I piu' aggiunti</a>
                        </div>
                      </div>
                       <div class="dropdown_generi">
                        <div id="generi"><strong id="generi_scelta">Generi</strong></div>
                            <button class="bottone_generi"><img src="freccia_giu.png"></button>
                            <div id="pulsante_giu_generi" class="hidden3">
                                <div class="sezione_generi">
                                <a href="animazione.php">Animazione</a>
                                <a href="anime.php">Anime</a>
                                <a href="arti_marziali.php">Arti Marziali</a>
                                <a href="avventura.php">Avventura</a>
                                <a href="azione.php">Azione</a>
                                <a href="casa_e_giardino.php">Casa e giardino</a>
                                <a href="commedia.php">Commedia</a>
                                <a href="commedia_romantica.php">Commedia romantica</a>
                                <a href="crimine.php">Crimine</a>
                                <a href="cucina.php">Cucina</a>
                                <a href="documentario.php">Documentario</a>
                                <a href="drammatico.php">Drammatico</a>
                                <a href="famiglia.php">Famiglia</a>
                                <a href="fantascienza.php">Fantascienza</a>
                                <a href="fantasy.php">Fantasy</a>
                                <a href="game_show.php">Game show</a>
                                <a href="guerra.php">Guerra</a>
                                <a href="horror.php">Horror</a>
                                <a href="indie.php">Indie</a>
                                <a href="mistero.php">Mistero</a>
                                <a href="musical.php">Musical</a>
                                <a href="notizie.php">Notizie</a>
                                <a href="reality.php">Reality</a>
                                <a href="soap_opera.php">Soap opera</a>
                                <a href="sport.php">Sport</a>
                                <a href="storico.php">Storico </a>
                                <a href="suspance.php">Suspance</a>
                                <a href="talk_show.php">Talk show </a>
                                <a href="thriller.php">Thriller</a>
                                <a href="viaggi.php">Viaggi </a>
                                <a href="western.php">Western</a>
                                </div>
                            </div>
                       </div>
                    <form class="ricerca">
                        <label for="titolo"><img src="icona_ricerca.png">
                        <input type="submit" id="submit" value="Cerca titoli"> 
                        <input type="text" id="titolo">
                        </label>
                    </form>
                    
                    <section id="generi-view-film">
                    
                    </section>
                    <section id="generi-view-serie">
                    
                    </section>


                    <section id="modal-view" class="hiddenPhotos">

                    </section>

                     </div>
                <div class="credenziali"> 
                    <a href="login_tvtime.php"> Accedi</a> | <a href="register.php">Registrati</a>
             </div>
                </div>
            </div>
        </div>
      </nav>
    <main>
      <header>
        <?php
   if(isset($_GET['id'])){
        $id= $_GET['id'];
      }else{
        $id = null;
    }
        $api_key = '8394c5526d833373a7389670d508ee9f'; 
        $base_img_url = "https://image.tmdb.org/t/p/w200";

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

        echo "<div class=header_media_info>" ;
        echo "<div class=flex_header_media_details>" ;
        echo "<div class=header_poster_wrapper>";
        echo "<div class=header_poster>";

    if (isset($item['poster_path']) && $item['poster_path'] !== '') {
    $poster = $base_img_url . $item['poster_path'];
    } else {
    $poster = 'placeholder.jpg';
    }
    if (isset($item['popularity'])) {
    $popularity = $item['popularity'];
    } else {
    $popularity = 0;
    }

if(isset($_GET['name'])){
        $title = $_GET['name'];
      }elseif(isset($_GET['title'])){
        $title = $_GET['title'];
    }else{
        $title = 'Titolo non disponibile';
    }

   echo "<img class='poster-title' src='$poster' value='$title'>";  

        echo "<div class=link_trailer>";
        echo "<div class=trailer>";
      if (isset($_GET['title'])) { 
           $title = $_GET["title"];
     }
     $titolo = str_replace(' ','+',$title) . '+trailer';
     
        echo "<a class = indirizzamento href=https://www.youtube.com/results?search_query=$titolo><img id=bottone_trailer src=play_cerchio.png>Riproduci vari trailer</a>";
        
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        if (isset($item['overview']) && $item['overview'] !== '') {
              $overview = $item['overview'];
        } else {
              $overview = 'Trama non disponibile';
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

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

   if (isset($_GET['id'])){
       $id = mysqli_real_escape_string($conn, $_GET['id']);
   } 
   if (isset($_GET['tipo'])){
    $tipo = mysqli_real_escape_string($conn, $_GET['tipo']);
   } else{
     $tipo = 'serie';
   }

$commenti_tot = 0;

if ($tipo === 'serie' && $id !== null) {
    $query = "
        SELECT s.series_id, COUNT(c.id) AS numero_commenti
        FROM serie s
        LEFT JOIN comments_serie c ON c.serie_id = s.id
        WHERE s.series_id = $id
        GROUP BY s.series_id
    ";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $commenti_tot = $row['numero_commenti'];
    }
}

mysqli_close($conn);


        echo "<div class = 'header_descrizione_completa'>";
        echo "<div class = 'header_descrizione'>";
        echo "<div class = 'header_descrizione_nome'>$title</div>";
        echo "<div class = 'header_descrizione_rilascio'>". $num_stagioni .'  '. $data_rilascio. '  '. $stato. "</div>";
        echo "<div class = 'header_descrizione_voto'>
              <img id = rating src = 'tvtime-icon-flat-square.png'>
                  <div class = 'rating_stars'><img src= '$img_voto'>
              </div>";
        echo "<div class = 'header_descrizione_trama'>$overview</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";       
        
        echo "<div class = 'header_status_wrapper'>";
        echo "<div class = 'header_status'>";
        echo "<div class = 'header_status_top'>";
        echo "<div class = 'header_status_added'><span></span>$popularity hanno aggiunto questa serie";
        echo "</div>";
        echo "<div class = 'header_status_comment'><span></span>Commenti $commenti_tot";
        echo "</div>";
        echo "</div>";
        echo "<a class = 'header_add' href='info_elemento.php?id=$id&tipo=$tipo&title=$title&name=$title'><span>+</span><div class = 'header_status_add'>Aggiungi alla lista da vedere</div></a>";
        echo "<a class = 'header_watch' href ='info_elemento.php?id=$id&tipo=$tipo&title=$title&name=$title'><img id = 'aggiungi_genere' src='play_yellow.png'>Guarda ora</a>";
        echo "<a class = 'header_seen' href ='info_elemento.php?id=$id&tipo=$tipo&title=$title&name=$title'>Gia'vista?</a>";

        echo "</div>";

        echo "</div>";
        echo "</div>";
        ?>
      </header>
      <?php

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
        
        if($tipo === 'serie'){
          echo "<section class= 'info_episodi_stagioni'>";
          echo "<div class = 'episodi'>";
          echo "<h2>Episodi</h2>";
        
        $stagione_uno = 1;
        $url_stagioni = "https://api.themoviedb.org/3/tv/$id/season/$stagione_uno?api_key=$api_key&language=it-IT";

        
        $curl_episodi = curl_init();
        curl_setopt($curl_episodi, CURLOPT_URL, $url_stagioni);
        curl_setopt($curl_episodi, CURLOPT_RETURNTRANSFER, 1);
        $response_episodi = curl_exec($curl_episodi);
        curl_close($curl_episodi);

        $episodi = json_decode($response_episodi, true);


if (isset($episodi['episodes']) && count($episodi['episodes']) > 0) {
  echo "<div class = 'flex_episodi'>";
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
    echo "</div>";  
} else {
    echo "<p>Nessun episodio disponibile per la prima stagione.</p>";
}
 echo "</div>";
          echo "</div>";
        echo "</section>"; 
         echo "<section class = 'info_cast'>";
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
        echo "<h4>Cast non disponibile</h4>";
       }
    }
    echo "</div>";
      echo "</section>";
       echo "<section class = 'info_commenti'>";
        echo "<div class ='header_comment'><h2>Commenti</h2></div>";
       echo "<div id = 'lista_commenti'>";
        echo "</div>";
        echo "<div class ='flex_commento'>";
        echo "<a id = 'watch_all_comments' href = 'commenti.php?tipo=$tipo&id=$id&titolo=$title'>Vedi tutti i commenti</a>";
        echo "<div>";
     echo "</section>";
        }
        else{
          echo "<section class = 'info_cast'>";
        echo "<div class='cast'><h2>Cast</h2></div>";      
         echo "<div class = 'flex_cast'>";
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
    }
 echo "</div>";

      echo "</section>";
       echo "<section class = 'info_commenti'>";
        echo "<div class ='header_comment'><h2>Commenti</h2></div>";
        echo "<div id = 'lista_commenti'>";
     echo "</section>";
        }          
    ?>  
    </main>
        <footer class="footer_e_sottofooter">
        <div class="footer_container">
            <div class="row">
                <div class="colonna_sinistra">
            <div class="row_colonna_sinistra">
       <div class="reparto_lingue">
                <div class="vstack">
                     <div class="navbar_brand">
             <a href="index.php">
                 <img src="tvtime-icon-flat-square.png">
             </a>
             </div>
       <div class="dropdown_lingua">
        <button id="lingua" >Italiano <img src="freccia_giu.png"></button>
        <div id="lingue" class="hidden4">
            <a href="index.php">Italiano</a>
            <a href="index_english.php">Inglese</a>
            <a href="index_spanish.php">Spagnolo</a>
            <a href="index_french.php">Francese</a>
        </div>
        </div>
    </div>
    </div>

    <div class="colonna_azienda">
  <h5 class="titolo_colonna1">Azienda</h5>
  <div class="flex_colonna1">
    <div class="azienda-item">
      <a class="info" href="https://www.tvtime.com/it/about">Info</a>
    </div>
    <div class="azienda-item">
      <a class="articoli" href="https://www.tvtime.com/articles">Articoli</a>
    </div>
    <div class="azienda-item">
      <a class="work" href="https://whipmedia.com/careers/">Lavora con noi</a>
    </div>
    <div class="azienda-item">
      <a class="privacy" href="https://www.tvtime.com/it/privacy">Regolamento sulla privacy</a>
    </div>
    <div class="azienda-item">
      <a class="privacy_policy" href="https://www.tvtime.com/it/privacy#toc_14">CA Privacy Policy</a>
    </div>
    <div class="azienda-item">
      <a class="condizioni_uso" href="https://www.tvtime.com/it/terms">Condizioni d'uso</a>
    </div>
  </div>
</div>

  <div class="colonna_link">
  <h5 class="titolo_colonna2">Link</h5>
  <div class="flex_colonna2">
    <div class="link-item">
      <a class="supporto" href="https://tvtime.zendesk.com/hc/it">Supporto</a>
    </div>
    <div class="link-item">
      <a class="contatti" href="https://www.tvtime.com/it/about#contact">Contatti</a>
    </div>
  </div>
</div>


 <div class="colonna_social">
  <h5 class="titolo_colonna3">Seguici</h5>
  <div class="flex_colonna3">
    <div class="social-item">
      <a class="facebook" href="https://www.facebook.com/tvtimeapp"><img src="facebook.jpg"></a>
    </div>
    <div class="social-item">
      <a class="instagram" href="https://www.instagram.com/tvtimeapp/"><img src="instagram.png"></a>
    </div>
     <div class="social-item">
      <a class="x" href="https://x.com/tvtime"><img src="x.png"></a>
    </div>
  </div>
</div>
            

    </div>
    </div>
    <div class="separatore"></div>
     <div class="footer_download">
                <h3 class="testo_bianco">
                <span class="titolo_download">Scarica l'app TV Time</span>
                </h3>
                <div class="row-store">
                    <div class="footer_qr_code"><img src="qr_code.png"></div>
                 <div class="footer_playstore">
                    <div class="google_play_store">
                    <a href="https://play.google.com/store/apps/details?id=com.tozelabs.tvshowtime&hl=it&pli=1">
                        <img src="play.png">
                    </a>
                 </div>
                 <div class="app_store">
                    <a href="https://apps.apple.com/it/app/tv-time-monitora-serie-e-film/id431065232">
                        <img src="appstore.png">
                    </a>
                </div>
            </div>
                </div>
            
              </div>

            </div>
    </div> 
        <section class="footer_copyright">
            <div class="container">
                <div class="row-copyright">
            <div class="col">
               <div class="text-center"> 2025,TV TIME,a Whip Media Company
                 </div>
               </div>
           </div>
        </div>
    </section>
    </footer>
  <script>
    const tipo = <?php echo json_encode($tipo); ?>;
  const id_tipo = <?php echo json_encode($id); ?>;
</script>
  </body>
</html>