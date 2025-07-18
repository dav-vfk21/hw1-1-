 <?php 

require_once 'hw1_auth.php';

if (!checkAuth()) exit;

header('Content-Type: application/json');
    

    $api_key = '8394c5526d833373a7389670d508ee9f';
    $query = urlencode($_GET["q"]);
    $url = "https://api.themoviedb.org/3/search/multi?query=$query&api_key=$api_key&language=it-IT";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $res=curl_exec($ch);
    curl_close($ch);
    echo $res;
?>
