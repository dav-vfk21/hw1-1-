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
  ?>
  <html>
    <head>
      <title>Soap opera</title>
      <meta name="viewport" content="width=device-width,initial-scale=1" >
    <link rel="stylesheet" href="generi.css">
    <script src ="tendenza_serie.js" defer></script>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Figtree:ital,wght@0,300..900;1,300..900&family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&display=swap" rel="stylesheet">
    </head>
<body>
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
        <section class="mostra_generi">
          <div class="generi_serie_film">
             <h1>Generi<span>/</span>Soap opera</h1>
              <?php  
             echo "<div class='scelta_generi'>";
            echo  "<div class='flex_scelta_generi'>";
            if ($tipo == 'serie') {
               echo "<a id='series' class='active' href='soap_opera.php?tipo=serie'>Serie</a>";
               echo "<a id='films' href='soap_opera.php?tipo=film'>Film</a>";
            } elseif ($tipo == 'film') {
               echo "<a id='series' href='soap_opera.php?tipo=serie'>Serie</a>";
               echo "<a id='films' class='active' href='soap_opera.php?tipo=film'>Film</a>";
            } else {
               echo "<a id='series' class='active' href='soap_opera.php?tipo=serie'>Serie</a>";
               echo "<a id='films' href='soap_opera.php?tipo=film'>Film</a>";
            }
                echo "</div>";
                echo "</div>";
          ?>
  <?php
     include_once 'generi_tmdb.php';

     $api_key = '8394c5526d833373a7389670d508ee9f'; 
     $conta_poster = 0;
     $genere_id = null;
     
if ($tipo === 'film' && isset($generi_film['soap']) && $generi_film['soap'] !== null) {
    $genere_id = $generi_film['soap'];
} elseif (($tipo === 'serie' || $tipo === '') && isset($generi_serie['soap'])) {
    $genere_id = $generi_serie['soap'];
}
if ($genere_id !== null) {
    if ($tipo == 'serie' || $tipo == '') {
        $url = "https://api.themoviedb.org/3/discover/tv?api_key=$api_key&with_genres=$genere_id&page=$page&language=it-IT";
    } elseif ($tipo == 'film') {
        $url = "https://api.themoviedb.org/3/discover/movie?api_key=$api_key&with_genres=$genere_id&page=$page&language=it-IT";
    }
} else {
    $url = null;
     echo "<p id='error'>Nessun risultato trovato.</p>";
}

if ($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($curl);
    curl_close($curl);

    $data = json_decode($response, true);
    $controllo_bool = isset($data['results']) && count($data['results']) > 0;

if ($controllo_bool) {
    $base_img_url = "https://image.tmdb.org/t/p/w200";
    echo "<div class = 'flex_conteiner_item'>";
    foreach ($data['results'] as $item) {
          if ($tipo == 'serie') {
            $id = $item['id'];
            if (isset($item['name'])) {
                $title = $item['name'];
            } else {
                $title = 'Senza titolo';
            }

            if (isset($item['first_air_date'])) {
                $date = $item['first_air_date'];
            } else {
                $date = '';
            }
        } elseif ($tipo == 'film') {
          $id = $item['id'];
            if (isset($item['title'])) {
                $title = $item['title'];
            } else {
                $title = 'Senza titolo';
            }

            if (isset($item['release_date'])) {
                $date = $item['release_date'];
            } else {
                $date = '';
            }
        } else {
            if (isset($item['title'])) {
                $title = $item['title'];
            } elseif (isset($item['name'])) {
                $title = $item['name'];
            } else {
                $title = 'Senza titolo';
            }

            if (isset($item['release_date'])) {
                $date = $item['release_date'];
            } elseif (isset($item['first_air_date'])) {
                $date = $item['first_air_date'];
            } else {
                $date = '';
            }
        }
        $year = 'N/A';
        if ($date && strlen($date) >= 4) {
            $year = $date[0] . $date[1] . $date[2] . $date[3];
        }

        if ($item['poster_path']) {
            $poster = $base_img_url . $item['poster_path'];
            $conta_poster++;
        } else {
            $poster = 'placeholder.jpg';
            $conta_poster++;
        }

        echo "<div class='item'>";
        echo "<a href='info.php?tipo=$tipo&id=$id&title=$title'><img src='$poster' value='$title'></a>";
        echo "<div><strong>$title</strong> ($year)</div>";
        echo "</div>";
    }
    echo "</div>";
    if($conta_poster >= 20){
     echo "<div class='paginazione'>";
if ($page > 1) {
    $prev = $page - 1;
    echo "<a href='soap_opera.php?tipo=$tipo&page=$prev' class='pagina_destra'><img src='precedente.png'>Precedente</a>";
}

$next = $page + 1;
echo "<a href='soap_opera.php?tipo=$tipo&page=$next' class='pagina_sinistra'>Successiva <img src = 'successivo.png'</a>";
echo "</div>";
    }
} else {
    if ($tipo == 'serie' || $tipo == 'film') {
        echo "<p>Nessun risultato trovato.</p>";
    } else {
        echo "<p>Tipo non valido.</p>";
    }
    }
 }
?> 
          </section>
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
    </div>
      
    </footer>
  </body>
</html>