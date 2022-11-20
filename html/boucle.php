<!DOCTYPE html>
<html>
    <head>
        <title>Cours PHP & MySQL</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="cours.css">
    </head>
    
    <body>
        <h1>Titre principal</h1>
        <?php
        include('config.php');
        /*
            //Creation de 50 client
            for($i = 0; $i<50; $i++) {
                $nbr = rand(0,5);
                $sql="INSERT INTO CLIENT (NOM,PRENOM,PAYS,AVIS) VALUES((SELECT nom FROM Sheet1 ORDER BY RAND() LIMIT 1),(SELECT nom FROM Sheet1 ORDER BY RAND() LIMIT 1) ,(SELECT nom_en_gb FROM PAYS ORDER BY RAND() LIMIT 1),'$nbr')";
                $result = mysqli_query($mysqli,$sql);
                if (!$result) {
                 die('Invalid query: ' . mysqli_error());
                }
            }
            */
            //Affiliation de 20 client au vendeur 1
            /*
            for($i = 0; $i<20; $i++) {
                $nbr = rand(1,50);
                $id_v=1;
                $sql="INSERT INTO CLIENT_VENDEUR (ID_CLIENT,ID_VENDEUR) VALUES('$nbr','$id_v')";
                $result = mysqli_query($mysqli,$sql);
                if (!$result) {
                 die('Invalid query: ' . mysqli_error());
                }
            }*/
            //Affiliation de 5 client par jours pendant 4 jours
            /*
            for($i = 1; $i<=4; $i++) {
                for($nb_client=0; $nb_client<5;$nb_client++)
                {
                    $sql="INSERT INTO jours_client (id_jours,id_client) VALUES($i,(SELECT ID_CLIENT FROM client_vendeur where ID_VENDEUR=1 ORDER BY RAND() LIMIT 1))";
                    $result = mysqli_query($mysqli,$sql);
                    if (!$result) {
                    die('Invalid query: ' . mysqli_error());
                    }
                }
            }*/
            /*
            //Insertion de l'avis moyen du jour i pour les clients du vendeur 1
            for($jours = 1; $jours<=4; $jours++) {
                $sql="INSERT INTO jours_vendeur (avis,id_jours, id_vendeur) VALUES((SELECT AVG(avis) FROM client,jours_client, client_vendeur where client.ID=jours_client.ID_CLIENT && jours_client.ID_JOURS=$jours && ID_VENDEUR=1 && client.ID=client_vendeur.ID_CLIENT),$jours,1)";
                $result = mysqli_query($mysqli,$sql);
                if (!$result) {
                die('Invalid query: ' . mysqli_error());
                }
            }
            */
            
            for($jours = 1; $jours<=400; $jours++) {
                $val1=rand(2000,4000)/10;
                $val2=rand(5000,6000)/10;

                $sql="INSERT INTO produit (prix_achat,prix_vente) VALUES($val1,$val2)";
                $result = mysqli_query($mysqli,$sql);
                if (!$result) {
                die('Invalid query: ' . mysqli_error());
                }
            }
        ?>
        <p>Un paragraphe</p>
    </body>
</html>