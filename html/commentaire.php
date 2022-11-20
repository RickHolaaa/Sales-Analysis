<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
require("config.php");
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
                              <a href="./commentaire.php" class="nav-link section">
                                <i class='fas fa-chart-bar mr-3 fa-fw'></i>
                                        Reviews
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
                            <div class="col-md-8 pt-5 pb-5"> 
                                <h2 style="font-weight:bold; padding-left:40px;">Reviews</h2>
                            </div>
                            <div class="col-md-4 pt-5 profile pr-2 pb-5">
                            <!--Profile-->
                                <div class="icons">
                                    <a href="./commentaire.php">
                                    <img class="" src="../img/ring.png" style="width: 50px;">
                                    </a>
                                    <a href="./settings.php">
                                    <?php 
                                      $sql =  "SELECT IMAGE FROM image WHERE USERNAME_ID=".$_SESSION['id'];
                                      $result = $mysqli->query($sql);
                                      // Transformer en liste 
                                      $row = $result->fetch_assoc();
                                    ?>
                                    <img src="data:image/png;charset=utf8;base64,<?php echo base64_encode($row['IMAGE']); ?>" width="43px">
                                    </a>
                                    <a href="logout.php">
                                        <img class="" src="../img/lgout.png" style="width: 50px;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!--Map representation-->
                        <?php
                            // Fonction : affichage des clients
                            function show_database(){
                                global $mysqli;
                                $sql = 'SELECT * from client';
                                $query = $mysqli->query($sql);
                                $row = $query->fetch_all(MYSQLI_ASSOC);
                                $somme = 0;
                                $cpt = 0;
                                foreach($query as $client){
                                    $sql2 = "SELECT * from commentaire WHERE ID_CLIENT='".$client['ID']."'";
                                    $query2 = $mysqli->query($sql2);
                                    $row2 = $query2->fetch_assoc();
                                    print("<div class='comm'><p><b>First Name :</b> ".$client['NOM'].", <b>Last Name :</b> ".$client['PRENOM'].", <b>Country :</b> ".$client["PAYS"].", <b>Stars :</b> ".$client['AVIS']."</p>
                                    <p><b>Review :</b> ".$row2['TEXT']."</p></div><br>");
                                    $somme+=$client["AVIS"];
                                    $cpt++;
                                }
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
                            
                                $sql = "DELETE FROM commentaire WHERE ID>=1";
                                $query = $mysqli->query($sql);
                                $sql = "ALTER TABLE commentaire AUTO_INCREMENT=1";
                                $query = $mysqli->query($sql);
                            }

                            // Fonction récupérer des avis
                            function create_review(){
                                global $mysqli;
                                
                                $sql = 'SELECT * from client';
                                $query = $mysqli->query($sql);
                                $row = $query->fetch_assoc();
                                // Récupérer les noms et prénoms
                                $cpt = 0;
                                $size = sizeof($row);
                                // 1 -> product name
                                // 4 -> review
                                // 5 -> stars
                                if(($open = fopen("../data/shoes.csv","r")) !== FALSE){
                                    while((($data = fgetcsv($open,50,",")) !== FALSE) && ($cpt<$size)){
                                        $avis[] = $data;

                                    }
                                    fclose($open);
                                }
                                // Récupérer la taille de la liste
                                $sizeofarray = sizeof($avis);

                                // Création de commande
                                if($size<=sizeof($avis)){
                                    // Afficher $size identités
                                    for($i=0;$i<$size;$i++){
                                        $i1 = rand(0,sizeof($avis)-1); // LIGNE
                                        //echo $array[$i1][1]." ".$array[$i2][2]." ".sizeof($array);
                                        //$sql = "INSERT INTO commentaire SET NOM='".$identite[$i2][2]."', PRENOM='".$identite[$i1][1]."', PAYS='".$pays[$indicePays]['nom_en_gb']."', AVIS=".$avis;
                                        //$query = $mysqli->query($sql);
                                    }
                                }
                                
                                $sql = 'SELECT * from client';
                                $query = $mysqli->query($sql);
                                $row = $query->fetch_all(MYSQLI_ASSOC);
                                foreach($query as $client){
                                    if(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM commentaire WHERE ID_CLIENT=".$client['ID']))==0){
                                        $com = rand(1,$sizeofarray-1);
                                        while(((strpos(implode("",$avis[$com]),"'")) !== false )||(count($avis[$com])!==11)){
                                            $com = rand(1,$sizeofarray-1);
                                        }
                                        $sql = "INSERT INTO commentaire SET TEXT='".$avis[$com][4]."', ID_CLIENT=".$client['ID'];
                                        $query = $mysqli->query($sql);   
                                    }
                                    
                                }
                            }
                            //reset_client();

                            //reset_client();
                            //create_client(100);
                            create_review();
                            show_database();
                        ?>
                </div>
            </div>
        </div>
    </body>
</html>