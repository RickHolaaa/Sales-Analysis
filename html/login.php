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
        <link rel="stylesheet" href="../css/style_signup.css">
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
        if (isset($_POST['username'])){
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($mysqli, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($mysqli, $password);
        $query = "SELECT * FROM `vendeur` WHERE username='$username' and password='$password'";
        $query1 = "SELECT username FROM `vendeur` WHERE username='$username'";
        $result = mysqli_query($mysqli,$query) or die(mysql_error());
        $result1 = mysqli_query($mysqli,$query1) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        $rows1 = mysqli_num_rows($result1);
        if($rows1==1)
        {
            if($rows==1){
                $_SESSION['username'] = $username;
                header("Location: index.php");
            }else{
                $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                echo $message;
            }
        }
        else
        {
            $message = "Compte inexistant. Veuillez creer un nouveau compte";
            echo 'Compte inexistant. <a href="./signup.php">Veuillez creer un nouveau compte</a>';
        }
        }
        ?>
        <img src="../img/logo2.png" style="width:7%">
        <h7>SALESANALYSIS</h7>
        <div class="box">
            <form autocomplete="off" method="post" name="login">
                <h2>Sign in</h2>
                <div class="inputBox">
                    <input type="text" required="required" name="username">
                    <span>Username</span>
                    <i></i>
                </div>
                <div class="inputBox">
                    <input type="password" required="required" name="password">
                    <span>Password</span>
                    <i></i>
                </div>
                <div class="links">
                    <a href="./mail.php">Forgot Password ?</a>
                    <a href="./signup.php">Sign up</a>
                </div>
                <input type="submit" name="submit" value="Sign in">
            </form>
        </div>
    </body>
</html>