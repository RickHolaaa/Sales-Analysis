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
        <link rel="stylesheet" href="../css/style_signin.css">
        <link rel="shortcut icon" hrsef="../img/Logo.png">
        <!-- JavaScripts -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>
    <body class="gradient-background">
        <?php
            require('config.php');
            session_start();
            if(isset($_POST['username'],$_POST['password'])){//l'utilisateur à cliqué sur "S'inscrire", on demande donc si les champs sont défini avec "isset"
                if(empty($_POST['username'])){//le champ pseudo est vide, on arrête l'exécution du script et on affiche un message d'erreur
                    echo "Le champ username est vide.";
                } elseif(!preg_match("#^[a-z0-9A-Z]+$#",$_POST['username'])){//le champ pseudo est renseigné mais ne convient pas au format qu'on souhaite qu'il soit, soit: que des lettres minuscule + des chiffres (je préfère personnellement enregistrer le pseudo de mes membres en minuscule afin de ne pas avoir deux pseudo identique mais différents comme par exemple: Admin et admin)
                    echo "L'username doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
                } elseif(strlen($_POST['username'])>25){//le pseudo est trop long, il dépasse 25 caractères
                    echo "L'username est trop long, il dépasse 25 caractères.";
                } elseif(empty($_POST['password'])){//le champ mot de passe est vide
                    echo "Le champ Mot de passe est vide.";
                } elseif($_POST['password']!=$_POST['verif']){
                    echo "Les 2 mots de passe ne sont pas égaux.";
                } elseif(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM vendeur WHERE username='".$_POST['username']."'"))==1){//on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
                    echo "Cet username est déjà utilisé.";
                } elseif(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM vendeur WHERE email='".$_POST['email']."'"))==1){
                    echo "Ce mail est déjà utilisé.";
                } else {
                    //toutes les vérifications sont faites, on passe à l'enregistrement dans la base de données:
                    //Bien évidement il s'agit là d'un script simplifié au maximum, libre à vous de rajouter des conditions avant l'enregistrement comme la longueur minimum du mot de passe par exemple
                    if(!mysqli_query($mysqli,"INSERT INTO vendeur SET username='".$_POST['username']."', password='".$_POST['password']."', email='".$_POST['email']."'")){//on crypte le mot de passe avec la fonction propre à PHP: md5()
                        echo "Une erreur s'est produite: ".mysqli_error($mysqli);//je conseille de ne pas afficher les erreurs aux visiteurs mais de l'enregistrer dans un fichier log
                    } else {
                        echo "</br>Vous êtes inscrit avec succès!</br>";
                        echo "</br><a href='login.php'>Veuillez vous reconnecter</a>";
                    }
                }
            }
        ?>
        <img src="../img/logo2.png" style="width:7%">
        <h7>SALESANALYSIS</h7>
        <div class="box">
            <form autocomplete="off" method="post" name="login">
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