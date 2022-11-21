<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Sales Analysis - 2022</title>
        <!-- CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" />
        <style>
            <?php 
                session_start();
                include("../css/style_signup.css"); 
            ?>
        </style>
        <link rel="shortcut icon" hrsef="../img/Logo.png">
        <!-- JavaScripts -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>
    <body class="gradient-background">
        <?php
            require('config.php');
            if(isset($_POST['username'],$_POST['password'])){//l'utilisateur a cliqué sur "S'inscrire", on demande donc si les champs sont défini avec "isset"
                if(empty($_POST['username'])){//le champ pseudo est vide, on arrête l'exécution du script et on affiche un message d'erreur
                    echo "The username field is empty";
                } elseif(!preg_match("#^[a-z0-9A-Z]+$#",$_POST['username'])){//le champ pseudo est renseigné mais ne convient pas au format qu'on souhaite qu'il soit, soit: que des lettres minuscule + des chiffres (je préfère personnellement enregistrer le pseudo de mes membres en minuscule afin de ne pas avoir deux pseudo identique mais différents comme par exemple: Admin et admin)
                    echo "The username must be entered in lower case letters without accents, without special characters.";
                } elseif(strlen($_POST['username'])>25){//le pseudo est trop long, il dépasse 25 caractères
                    echo "The username is too long, it exceeds 25 characters.";
                } elseif(empty($_POST['password'])){//le champ mot de passe est vide
                    echo "The password field is empty.";
                } elseif($_POST['password']!=$_POST['verif']){
                    echo "The 2 passwords are not equal.";
                } elseif(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM vendeur WHERE username='".$_POST['username']."'"))==1){//on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
                    echo "This username is already in use.";
                } elseif(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM vendeur WHERE email='".$_POST['email']."'"))==1){
                    echo "This mail is already used.";
                } else {
                    //toutes les vérifications sont faites, on passe à l'enregistrement dans la base de données:
                    //Bien évidement il s'agit là d'un script simplifié au maximum, libre à vous de rajouter des conditions avant l'enregistrement comme la longueur minimum du mot de passe par exemple
                    if(!mysqli_query($mysqli,"INSERT INTO vendeur SET username='".$_POST['username']."', password='".$_POST['password']."', email='".$_POST['email']."'")){//on crypte le mot de passe avec la fonction propre à PHP: md5()
                        echo "Error : ".mysqli_error($mysqli);//je conseille de ne pas afficher les erreurs aux visiteurs mais de l'enregistrer dans un fichier log
                    } else {
                        $data = mysqli_query($mysqli,'SELECT MAX(id) AS max_id FROM client') or die(mysql_error());
                        $row = mysqli_fetch_assoc($data);
                        $numClient = $row['max_id'];
                        for($i = 0; $i<100; $i++) {
                            $nbr = rand(0,5);
                            $sql="INSERT INTO CLIENT (NOM,PRENOM,PAYS,AVIS) VALUES((SELECT nom FROM Sheet1 ORDER BY RAND() LIMIT 1),(SELECT nom FROM Sheet1 ORDER BY RAND() LIMIT 1) ,(SELECT NameWoDiac FROM `location` GROUP BY Country ORDER BY rand() LIMIT 1),'$nbr')";
                            $result = mysqli_query($mysqli,$sql);
                            if (!$result) {
                             die('Invalid query: ' . mysqli_error());
                            }
                        }
                        for($i = 0; $i<100; $i++) {
                            $nbr = rand($numClient+1,$numClient+100);
                            $sql="INSERT INTO CLIENT_VENDEUR (ID_CLIENT,ID_VENDEUR) VALUES('$nbr',(SELECT id FROM vendeur WHERE username='".$_POST['username']."'))";
                            $result = mysqli_query($mysqli,$sql);
                            $prod=rand(1,300);
                            if (!$result) {
                             die('Invalid query: ' . mysqli_error());
                                }
                            $sql="INSERT INTO produit_client (ID_CLIENT,ID_PRODUIT) VALUES('$nbr','$prod')";
                            $result = mysqli_query($mysqli,$sql);
                            if (!$result) {
                                die('Invalid query: ' . mysqli_error());
                                }
                        }
                        $data = mysqli_query($mysqli,"SELECT id as id_user FROM vendeur WHERE username='".$_POST['username']."'") or die(mysql_error());
                        $row = mysqli_fetch_assoc($data);
                        $id = $row['id_user'];
                        for($i = 1; $i<=30; $i++) {
                            $rep=rand(1,5);
                            for($j=1; $j<=$rep; $j++) {
                                $sql="INSERT INTO jours_client (id_jours,id_client) VALUES($i,(SELECT ID_CLIENT FROM client_vendeur where ID_VENDEUR=$id ORDER BY RAND() LIMIT 1))";
                                $result = mysqli_query($mysqli,$sql);
                                if (!$result) {
                                    die('Invalid query: ' . mysqli_error());
                                }
                            }
                        }
                        
                        for($jours = 1; $jours<=30; $jours++) {
                            //$sql="INSERT INTO jours_vendeur (avis,id_jours, id_vendeur) VALUES((SELECT AVG(avis) FROM client,jours_client, client_vendeur where client.ID=jours_client.ID_CLIENT && jours_client.ID_JOURS=$jours && ID_VENDEUR=$id && client.ID=client_vendeur.ID_CLIENT),$jours,$id)";
                            $sql="INSERT INTO jours_vendeur (avis,id_jours, id_vendeur) VALUES((SELECT AVG(avis) from client where id in (SELECT jours_client.id_client from jours_client,client_vendeur where id_vendeur=$id && id_jours=$jours && client_vendeur.id_client=jours_client.id_client)),$jours,$id)";
                            $result = mysqli_query($mysqli,$sql);
                            if (!$result) {
                            die('Invalid query: ' . mysqli_error());
                            }
                        }
                        echo "</br>Congratulations, your account has been successfully created !</br>";
                        echo "</br><a href='login.php'>Reconnect</a>";
                        $_SESSION['email'] = $_POST['email'];
                        $email = $_SESSION['email'];
                        $_SESSION['id'] = $mysqli->insert_id;
                        $id = $_SESSION['id'];
                        $_SESSION['message'] = "success";
                    }
                }
            }

            if(isset($_SESSION["message"])){
                print '<div id="box-info">
                            <h5 class="info">Thanks ! your account has been successfully created.</h5>
                        </div>';
                unset($_SESSION['message']);
            }

        ?>

        <!--
        <div id="box-info">
            print(<h5 class="info">Test</h5>
        </div>
        -->
        <img src="../img/logo2.png" style="width:7%">
        <h7 style="color:white;">SALESANALYSIS</h7>
        <br>
        <div class="box">
            <form autocomplete="off" method="post" name="signup">
                <h2>Sign up</h2>
                <div class="inputBox">
                    <input type="text" required="required" name="username" id="username">
                    <span>Username</span>
                    <i></i>
                </div>
                <div class="inputBox">
                    <input type="text" required="required" name="email" id="email">
                    <span>Email</span>
                    <i></i>
                </div>
                <div class="inputBox">
                    <input type="password" required="required" name="password" id="password">
                    <span>Password</span>
                    <i></i>
                </div>
                <div class="inputBox">
                    <input type="password" required="required" name="verif" id="verif">
                    <span>Confirm Password</span>
                    <i></i>
                </div>
                <div class="links">
                    <a href="./login.php">Sign in</a>
                </div>
                <input type="submit" name="submit" value="Sign up">
            </form>
        </div>
    </body>
</html>