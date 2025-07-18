<?php
    include 'hw1_auth.php';
    
    if (checkAuth()) {
        header('Location: sito_tvtime.php');
        exit;
    }
    

    if (!empty($_POST["username"]) && !empty($_POST["password"]) )
    {
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        $username = mysqli_real_escape_string($conn, $_POST['username']);

        $query = "SELECT * FROM users WHERE username = '".$username."'";

        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;
        
        if (mysqli_num_rows($res) > 0) {

            $entry = mysqli_fetch_assoc($res);
            if (password_verify($_POST['password'], $entry['password'])) {

                $_SESSION["username"] = $entry['username'];
                $_SESSION["userid"] = $entry['id'];
                header("Location: sito_tvtime.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }

        $error = "Username e/o password errati.";
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {

        $error = "Inserisci username e password.";
    }
?>
<html>
    <head>
        <title>Accedi a TV TIME!</title>
        <link rel='stylesheet' href='login.css'>
        <script src='js_login_db_escape.js' defer></script>
    </head>
    <body>
        <article>
        <header><a href="index.php"><img src="tvtime-logo.png"></a></header>
            <section>
        <h1>Effettua il login su TV Time!</h1>
        <?php                
        
                if (isset($error)) {
                    echo "<p class='errore'>$error</p>";
                }
                
            ?>
        <main>
            <form name='nome_form' method='post'>
                <p>
                    <label class = "nome_utente">Nome utente <input type='text' name='username'<?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></label>
                </p>
                <p>
                    <label class = "password">Password <input type='password' name='password'<?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></label>
                </p>
                <p>
                    <label class="invia">&nbsp<input type='submit' value="Effettua il login!"></label>
                </p>
            </form>
           </main>
            <div class="registrati"><h4>Non hai un account?</h4></div>
            <div class="link-registrati"><a class="link" href="register.php">ISCRIVITI A TVTIME!</a></div>
        </section>
         <footer>2025,TV TIME,a Whip Media Company</footer>
      </article>
    </body>
</html>