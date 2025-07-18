<?php
    require_once 'hw1_auth.php';

    if (checkAuth()) {
        header("Location: sito_tvtime.php");
        exit;
    }   
    
    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["name"]) && 
        !empty($_POST["surname"]) && !empty($_POST["confirm_password"]) && !empty($_POST["allow"]))
    {
        $error = array();
        
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $query = "SELECT username FROM users WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        }

        $password = $_POST["password"];
        $simboli = '~!@#$% ^&*_-+=`|\(){}[]:;<>,.?/';
        $numeri_da_cercare = '0123456789';
        $conta_simboli = 0;
        $numeri = 0;

        if (strlen($_POST["password"]) < 8) {
            $error[] = "Caratteri password insufficienti";
        }

        for($i=0;$i < strlen($password);$i++){
            if(strpos($simboli,$password[$i]) !== false){
                $conta_simboli++;
            }
            if(strpos($numeri_da_cercare,$password[$i]) !== false){
                $numeri++;
            }
        }

         if($numeri < 2){
            $error[] = "La password deve contenere almeno 2 numeri";
        }

        if($conta_simboli < 2){
            $error[] = "La password deve contenere almeno 2 caratteri speciali";
        }

        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }


        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);

            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO users(username, password, name, surname, email) VALUES('$username', '$password', '$name', '$surname', '$email')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: sito_tvtime.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    }
    else if (isset($_POST["username"])) {
        $error = array("Riempi tutti i campi");
    }

?>
<html>
    <head>
        <title>
             Registrati a TV TIME!</title>
              <meta name="viewport" content="width=device-width,initial-scale=1" >
              <link rel="stylesheet" href="css_register.css"/>
              <script src ="js_register.js" defer></script>
              <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Figtree:ital,wght@0,300..900;1,300..900&family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&display=swap" rel="stylesheet">
    </head>
    <body>
    <article>
        <header><a href="index.php"><img src="tvtime-logo.png"></a></header> 
    <section>
        <h1>Effettua la tua prima registrazione su TV Time!</h1>
            
          <main>       
            <form name='registrati' method='post'>
                <p>
                    <label class = "nome">Nome<input type='text' name='name'<?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?>></label>
                </p>  
                
                <p>
                     <label class = "cognome">Cognome<input type='text' name='surname'<?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?>></label>
                </p>

                <p>
                     <label class = "nome_utente">Nome Utente<input type='text' name='username'<?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></label>
                </p>
        
                <p>
                     <label class = "email">E-mail<input type='text' name='email'  <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>></label>
                </p>
                 
                <p>
                    <label class = "password">Password<input type='password' name='password'<?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></label>
                </p>

                <p>
                    <label class = "conferma_password">Conferma Password<input type='password' name='confirm_password'<?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>></label>
                </p>  
                
                <p class="allow">
                     <input type='checkbox' name='allow' value="1" id="checkbox"<?php if(isset($_POST["allow"])){echo $_POST["allow"] ? "checked" : "";} ?>>
                     <label> Accetto i termini e condizioni d'uso di TV TIME</label>
                </p>
    
                 <label class = "invia">&nbsp<input type='submit' value="Registrati!"></label>
                  <?php if(isset($error)) {
                    foreach($error as $err) {
                        echo "<div class='errori'><img src='warning.png'><span>".$err."</span></div>";
                    }
                } ?>
            </form>
        </main>
            </section>
              <footer>2025,TV TIME,a Whip Media Company</footer>
      </article>
    </body>
</html>