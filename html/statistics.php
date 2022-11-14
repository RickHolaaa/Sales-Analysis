<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");

?>
<!DOCTYPE html>
<html lang="fr" style="background-color: #181921;">
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Sales Analysis - 2022</title>
        <!-- CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" />
        
        <style>
            <?php include('../css/style_stat.css'); ?>
        </style>

        <link rel="shortcut icon" href="../img/free-bar-chart-icon-676-thumb.png">
        <!-- JavaScripts -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    </head>
    <body>
        <div class="container-fluid text-light">
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
                                        Messages
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
                            <div class="col-md-4 pt-5 pb-5"> 
                                <h2>Statistics</h2>
                            </div>
                            <div class="col-md- pt-5 pb-5">
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
                                    <img class="" src="../img/notif.png" style="width: 15%;">
                                    <a href="./signup.php">
                                        <img src="../img/memoji-iphone-ios-13-modified.png" style="width: 10%;"">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!--Map representation-->
                        <?php
                            // Fonction : affichage des clients
                            require('config.php');

                            function show_database(){
                                global $mysqli;
                                $sql = 'SELECT * from client';
                                $query = $mysqli->query($sql);
                                $row = $query->fetch_all(MYSQLI_ASSOC);
                                $somme = 0;
                                $cpt = 0;
                                foreach($query as $client){
                                    print("<p><b>Nom :</b> ".$client['NOM'].", <b>Prénom :</b> ".$client['PRENOM'].", <b>Pays :</b> ".$client["PAYS"].", <b>Avis :</b> ".$client['AVIS']."</p>");
                                    $somme+=$client["AVIS"];
                                    $cpt++;
                                }
                                printf("Moyenne des avis : ".$somme/$cpt."<br>");
                            }
                            // Appel de la fonction affichage
                            //show_database();

                            // Fonction : création de clients
                            function create_client($size){
                                global $mysqli;
                                
                                $sql = 'SELECT * from client';
                                $query = $mysqli->query($sql);
                                $row = $query->fetch_assoc();
                                // Récupérer les noms et prénoms
                                $cpt = 0;
                                if(($open = fopen("../data/names.csv","r")) !== FALSE){
                                    while((($data = fgetcsv($open,1000,",")) !== FALSE) && ($cpt<$size)){
                                        $identite[] = $data;
                                        $cpt++;
                                    }
                                    fclose($open);
                                }
                                // Récupérer les pays de la database
                                $sql = 'SELECT * from pays';
                                $query = $mysqli->query($sql);
                                $pays = $query->fetch_all(MYSQLI_ASSOC);
                                $sizeofcountry = sizeof($pays);
                                // Récupérer la taille de la liste
                                $sizeofarray = sizeof($identite);
                                // Si $size ne dépasse pas la taille maximale
                                /*
                                if($size<=sizeof($identite)){
                                    // Afficher $size identités
                                    for($i=0;$i<$size;$i++){
                                        $i1 = rand(0,sizeof($identite)-1);
                                        echo "i1: ".$i1."<br>";
                                        $i2 = rand(0,sizeof($identite)-1);
                                        echo "i2: ".$i2."<br>";
                                        echo "<pre style='color: white;'>";
                                        echo $identite[$i1][1]." ".$identite[$i2][2]." ".sizeof($identite);
                                        echo"</pre>";
                                    }
                                }
                                else{
                                    echo sizeof($identite);
                                }
                                */
                                // Création de commande
                                if($size<=sizeof($identite)){
                                    // Afficher $size identités
                                    for($i=0;$i<$size;$i++){
                                        $i1 = rand(0,sizeof($identite)-1); // Prénom
                                        $i2 = rand(0,sizeof($identite)-1); // Nom
                                        $indicePays = rand(0,$sizeofcountry-1);
                                        $avis = rand(0,5);
                                        //echo $array[$i1][1]." ".$array[$i2][2]." ".sizeof($array);
                                        $sql = "INSERT INTO client SET NOM='".$identite[$i2][2]."', PRENOM='".$identite[$i1][1]."', PAYS='".$pays[$indicePays]['nom_en_gb']."', AVIS=".$avis;
                                        $query = $mysqli->query($sql);
                                    }
                                }
                            }

                            // Appel de la fonction création
                            //create_client(100);

                            // Fonction : Réinitialiser tableau CLIENT
                            function reset_client(){
                                global $mysqli;

                                $sql = "DELETE FROM client WHERE ID>=1";
                                $query = $mysqli->query($sql);
                                $sql = "ALTER TABLE client AUTO_INCREMENT=1";
                                $query = $mysqli->query($sql);
                            }
                            //reset_client();

                            reset_client();
                            create_client(100);
                        ?>
                    <?php 
                        show_database();
                        print($_SESSION['username']);
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>