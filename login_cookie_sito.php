<?php

    if(isset($_COOKIE["username"]))
    {
        header("Location: sito_cookie.php");
        exit;
    }
    if(isset($_POST["username"]) && isset($_POST["password"]))
    {
        if($_POST["username"] == "utente1" && $_POST["password"] == "secret")
        {
            setcookie("username", "utente1");
            header("Location: sito_cookie.php");
            exit;
        }
        else
        {
            $errore = true;
        }
    }

?>
<html>
    <head>
        <title>Accedi a TV TIME!</title>
        <link rel='stylesheet' href='css_login_cookie.css'>
        <script src='js_login_cookie.js' defer></script>
    </head>
    <body>
        <article>
        <header><img src="tvtime-logo.png"></header>
            <section>
        <h1>Effettua il login su TV Time!</h1>
        <?php
            if(isset($errore))
            {
                echo "<p class='errore'>";
                echo "Credenziali non valide.";
                echo "</p>";
            }
        ?>
                <main>
            <form name='nome_form' method='post'>
                <p>
                    <label>Nome utente <input type='text' name='username'></label>
                </p>

                <p>
                    <label>Password <input type='password' name='password'></label>
                </p>

                <p>
                    <label>&nbsp;<input type='submit'></label>
                </p>
            </form>
        </main>
    </section>
    <footer>2025,TV TIME,a Whip Media Company</footer>
      </article>
    </body>
</html>
