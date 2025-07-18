<?php
    if(!isset($_COOKIE['username']))
    {
        header("Location: login_cookie_sito.php");
        exit;
    }
?>
<html>
    <head>
    </head>
    <title>TV TIME!</title>
     <meta name="viewport" content="width=device-width,initial-scale=1">
     <link rel="stylesheet" href="css_login_cookie.css">
        <script src="js_login_cookie.js" defer></script>
    <body>
        <h1>Bentornato/a <?php echo $_COOKIE["username"]; ?>!</h1>
        <p><a href='logout_cookie_tvtime.php'>Esci dalla sessione</a></p>
    </body>
</html>