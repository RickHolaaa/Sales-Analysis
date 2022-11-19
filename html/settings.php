<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");

?>
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
            <?php include('../css/style_settings.css'); ?>
        </style>
        <link rel="shortcut icon" href="../img/free-bar-chart-icon-676-thumb.png">
        <!-- JavaScripts -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <!--Any Chart-->
        <script src="https://cdn.anychart.com/releases/8.9.0/js/anychart-base.min.js"></script>
        <script src="https://cdn.anychart.com/releases/8.9.0/js/anychart-map.min.js"></script>
        <script src="https://cdn.anychart.com/geodata/latest/custom/world/world.js"></script>

        <script src="https://cdn.anychart.com/releases/8.9.0/js/anychart-data-adapter.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.3.15/proj4.js"></script>

        <script src="https://cdn.anychart.com/releases/8.9.0/js/anychart-exports.min.js"></script>
        <script src="https://cdn.anychart.com/releases/8.9.0/js/anychart-ui.min.js"></script>

        <script src="https://cdn.anychart.com/releases/8.9.0/themes/dark_glamour.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.anychart.com/releases/8.9.0/css/anychart-ui.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.anychart.com/releases/8.9.0/fonts/css/anychart-font.min.css">
        <script src="../js/map.js"></script>
    </head>
    <body>
        <div class="container-fluid text-light">
            <?php
            // On applique la configuration 
              require('config.php');
            // Si on clique sur le bouton DELETE pour supprimer son compte
                if (isset($_POST['deleted'])){
                  $user_id = $_SESSION['id']; // On récupère l'ID de l'utilisateur
                  $query = "DELETE FROM vendeur WHERE id='" . $user_id . "'"; // Supprimer de la table "vendeur", l'utilisateur avec l'id actuel
                  $launch_query = $mysqli->query($query); // On exécute la commande
                  if($launch_query){ // Si la commande s'est bien exécutée
                    $_SESSION['message']="Compte supprimé avec succès."; // Afficher un mot de succès
                    header("Location: login.php"); // Renvoyer faire la page login
                    exit(0);
                  }
                  else{
                    $_SESSION["message"]="Problème..."; //
                    header("Location : settings.php");
                    exit(0);
                  }
                }
              // Si on veut changer de mot de passe
                if(isset($_POST['old-pass'],$_POST['new-pass'],$_POST['confirm-new-pass'])){
                  $old_pass = $_POST['old-pass']; // On récupère l'ancien mot de passe du formulaire
                  $new_pass = $_POST['new-pass']; // On récupère le nouveau mot de passe du formulaire
                  $confirm_new_pass = $_POST['confirm-new-pass']; // On récupère la confirmation du nouveau mot de passe du formulaire
                  $sql = "SELECT * FROM vendeur WHERE ID = '".$_SESSION['id']."'";
		              $query = $mysqli->query($sql);
		              $row = $query->fetch_assoc();
                  $phppass = $row['password'];
                  if($row['password']!=$old_pass){
                    echo "<p style='text-align:center;'>Ce n'est pas votre ancien mot de passe</p>";
                  }
                  else if($new_pass!=$confirm_new_pass){ // Si le nouveau mot de passe du formulaire n'est pas répété 2 fois (confirmation)
                    echo "<p style='text-align:center;'>Veuillez confirmer votre nouveau mot de passe</p>"; // Afficher un message d'erreur
                  }
                  else{
                    $sql = "UPDATE vendeur SET password = '".$new_pass."' WHERE id ='".$_SESSION['id']."'"; // Modifier le mot de passe (base de données) par le nouveau mot de passe du formulaire
                    $query = $mysqli->query($sql); // Exécuter la commande
                    $_SESSION['password'] = $new_pass;
                    echo "<p style='text-align:center;'>Mot de passe modifié avec succès</p>";
                  }
                }

                if (isset($_POST['updated'])){ // Si on veut modifier l'username ou l'email
                  $get_usr = $_POST['settings_usr']; // On récupère le nouveau username
                  $get_email = $_POST['settings_email']; // On récupère le nouvel email
                  if(empty($_POST['settings_usr'])){ //le champ pseudo est vide, on arrête l'exécution du script et on affiche un message d'erreur
                    echo "<p style='text-align:center;'>Le champ username est vide.</p>";
                  } elseif(!preg_match("#^[a-z0-9A-Z]+$#",$_POST['settings_usr'])){ //le champ pseudo est renseigné mais ne convient pas au format qu'on souhaite qu'il soit, soit: que des lettres minuscule + des chiffres (je préfère personnellement enregistrer le pseudo de mes membres en minuscule afin de ne pas avoir deux pseudo identique mais différents comme par exemple: Admin et admin)
                      echo "<p style='text-align:center;'>L'username doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.</p>";
                  } elseif(strlen($_POST['settings_usr'])>25){//le pseudo est trop long, il dépasse 25 caractères
                      echo "<p style='text-align:center;'>L'username est trop long, il dépasse 25 caractères.</p>";
                  } else { // Cas possible
                    $sql = "SELECT * FROM vendeur WHERE id = '".$_SESSION['id']."'"; // On récupère les informations de l'utilisateur avec l'ID actuel
                    $query = $mysqli->query($sql);
                    $row = $query->fetch_assoc();
                    $phpusr = $row['username']; // On récupère l'username de l'ID associé
                    $phpemail = $row['email']; // On récupère l'email de l'ID associé
                    
                    if(($phpusr==$get_usr)&&($phpemail==$get_email)){ // Si on valide sans rien modifier
                      echo "<p style='text-align:center;'>Vous n'avez rien modifié</p>";
                    } else if(($phpusr!=$get_usr)&&($phpemail==$get_email)){ // Si on valide en modifiant que l'username
                      if(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM vendeur WHERE username='".$_POST['settings_usr']."'"))==1){  // Si l'username est déjà présent dans la base de données
                        echo "<p style='text-align:center;'>Cet username est déjà utilisé.</p>";
                      } else {
                        echo "<p style='text-align:center;'>Username modifié avec succès</p>";
                        $sql = "UPDATE vendeur SET username = '".$get_usr."' WHERE id ='".$_SESSION['id']."'";
                        $query = $mysqli->query($sql);
                        $_SESSION['username']=$get_usr;
                      }
                    } else if(($phpusr==$get_usr)&&($phpemail!=$get_email)){ // Si on valide en modifiant que l'email
                      if (mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM vendeur WHERE email='".$_POST['settings_email']."'"))==1){ // Si l'email est déjà présent dans la base de données
                        echo "Cet email est déjà utilisé.";
                      } else {
                        echo "<p style='text-align:center;'>Email modifié avec succès</p>";
                        $sql = "UPDATE vendeur SET email = '".$get_email."' WHERE id ='".$_SESSION['id']."'"; // On modifie l'email (base de données) par l'email du formulaire
                        $query = $mysqli->query($sql);
                        $_SESSION['email']=$get_email;
                      }
                    } else if(($phpusr!=$get_usr)&&($phpemail!=$get_email)){ // Si on valide en modifiant l'username et l'email
                      if ((mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM vendeur WHERE email='".$_POST['settings_email']."'"))==1)&&(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM vendeur WHERE username='".$_POST['settings_usr']."'"))==1)){
                        echo "Cet username et ce mail sont déjà utilisés";
                      } else {
                        echo "<p style='text-align:center;'>Username et email modifiés avec succès</p>";
                        $sql = "UPDATE vendeur SET username = '".$get_usr."' WHERE id ='".$_SESSION['id']."'"; // On modifie l'username (base de données) par l'email du formulaire
                        $query = $mysqli->query($sql);
                        $query = $mysqli->query($sql);
                        $sql = "UPDATE vendeur SET email = '".$get_email."' WHERE id ='".$_SESSION['id']."'"; // On modifie l'email (base de données) par l'email du formulaire
                        $query = $mysqli->query($sql);
                        $query = $mysqli->query($sql);
                        $_SESSION['username']=$get_usr; // On actualise l'username de la session
                        $_SESSION['email']=$get_email; // On actualise l'email de la session
                      }
                    } else{
                      echo "ERREUR";
                    }
                  }
                }
            ?>
            <div class="row">
                <div class="col-md-2 bg-menu">
                    <div class="logo">
                        <img src="../img/logo2.png">
                        <h4>SalesAnalysis</h4>
                    </div>
                    <br><br><br><br><br>
                    <div class="menu">
                        <ul class="nav flex-column mb-0">
                            <li class="nav-item">
                                <a href="./index.php" class="nav-link section">
                                    <i class="fa fa-th-large mr-3 fa-fw"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link section">
                                    <i class='fa fa-calendar mr-3 fa-fw'></i>
                                    Calendar
                                </a>
                            </li>
                            <li class="nav-item">
                              <a href="./statistics.php" class="nav-link section">
                                <i class='fas fa-chart-bar mr-3 fa-fw'></i>
                                        Statistic
                                    </a>
                            </li>
                            <li class="nav-item">
                              <a href="#" class="nav-link section">
                                <i class='fa fa-envelope mr-3 fa-fw'></i>
                                        Notifications
                                    </a>
                            </li>
                            <li class="nav-item">
                                <a href="./settings.php" class="nav-link section">
                                    <i class='fa fa-user-circle mr-3 fa-fw'></i>
                                        Settings
                                      </a>
                            </li>
                          </ul>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="container">
                        <!--Partie Youness-->
                        <!--Dashboard Search Profile-->
                        <div class="row">
                            <!--Dashboard-->
                            <div class="col-md-4 pt-5 pl-5">
                                <h2>Settings</h2>
                            </div>
                            <div class="col-md-4 pt-5 pb-5">
                            <!--SearchBar-->
                                <div class="input-group">
                                    <input class="form-control rounded-pill py-2 pr-5 mr-1 border-0" type="search" value="search" id="example-search-input1">
                                    <span class="input-group-append">
                                        <div class="input-group-text border-0 bg-transparent ml-n5"><i class="fa fa-search"></i></div>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 pt-5 profile pr-5 pb-5">
                            <!--Profile-->
                                <div class="icons">
                                    <a href="./messages.html">
                                    <img class="" src="../img/ring.png" style="width: 12%;">
                                    </a>
                                    <a href="./signup.html">
                                        <img src="../img/memoji-iphone-ios-13-modified.png" style="width: 10%;"">
                                    </a>
                                    <a href="logout.php">
                                        <img class="" src="../img/lgout.png" style="width: 12%;">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--Calendar TotalCustomer TotalRevenue TotalProfit Map-->
                        <!--Map representation-->
                    </div>
                    <div class="container">
                        <div class="row">

                            <div class="card-body">
                                <nav class="nav nav-pills">
                                    <a href="#profile" data-toggle="tab" class="nav-item nav-link active">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>Profile Information
                                    </a>
                                    <a href="#account" data-toggle="tab" class="nav-item nav-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings mr-2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>Account Settings
                                    </a>
                                    <a href="#security" data-toggle="tab" class="nav-item nav-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield mr-2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>Security
                                    </a>
                                </nav>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                              <div class="card-header d-md-none">
                                <ul class="nav" role="tablist">
                                  <li class="nav-item">
                                    <a href="#profile" data-toggle="tab" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></a>
                                  </li>
                                  <li class="nav-item">
                                    <a href="#account" data-toggle="tab" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></a>
                                  </li>
                                  <li class="nav-item">
                                    <a href="#security" data-toggle="tab" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></a>
                                  </li>
                                </ul>
                              </div>
                              <div class="card-body tab-content">
                                <div class="tab-pane active" id="profile">
                                  <h6>YOUR PROFILE INFORMATION</h6>
                                  <hr>
                                  <div class="change_profile">
                                    <img>
                                  </div>
                                  <br>
                                  <form method="post">
                                    <div class="form-group">
                                        <label for="fullName">Username</label>
                                        <?php
                                          $usr = $_SESSION['username'];
                                          echo "<input type='text' class='form-control' id='fullName' aria-describedby='fullNameHelp' placeholder='Enter your fullname' value='$usr' name='settings_usr'>";
                                        ?>
                                      </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <?php
                                          $mail = $_SESSION['email'];
                                          echo "<input type='text' class='form-control' id='email' aria-describedby='fullNameHelp' placeholder='Enter your email' value='$mail' name='settings_email'>";
                                        ?>
                                      <br>
                                    <button type="submit" class="btn btn-primary" name="updated">Update Profile</button>
                                    <button type="reset" class="btn btn-light">Reset Changes</button>
                                    </div>
                                  </form>
                                </div>
                                <div class="tab-pane" id="account">
                                  <h6>ACCOUNT SETTINGS</h6>
                                  <hr>
                                  <form method="post">
                                    <div class="form-group">
                                      <label class="d-block text-danger">Delete Account</label>
                                      <p class="text-muted font-size-sm">Once you delete your account, there is no going back. Please be certain.</p>
                                    </div>
                                    
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-password">
                                      Delete Account
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="background-color:#252831;">
                                          <div class="modal-header border-0">
                                            <h5 class="modal-title" id="exampleModalLabel">You're about to delete your account</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true" style="color:white;">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body border-0">
                                            <p style="color: #9E9DA3; font-size: 15px;"> Do you really want to delete your account ? This process cannot be undone.</p>
                                          </div>
                                          <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-danger" name="deleted" type="submit" value="deleted" id="deleted">Delete</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                  </form>
                                </div>
                                <div class="tab-pane" id="security">
                                  <h6>SECURITY SETTINGS</h6>
                                  <hr>
                                  <form method="post" >
                                    <div class="form-group">
                                      <label class="d-block">Change Password</label>
                                      <input type="text" class="form-control" placeholder="Enter your old password" id="old-pass" name="old-pass" required>
                                      <input type="text" class="form-control mt-1" placeholder="New password" id="new-pass" name="new-pass" required>
                                      <input type="text" class="form-control mt-1" placeholder="Confirm new password" id="confirm-new-pass" name="confirm-new-pass" required>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Change my password</button>
                                  </form>
                    
                                </div>
                              </div>
                          </div>
                      </div>
                </div>
            </div>
        </div>
    </body>
</html>