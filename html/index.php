<?php
    //include auth_session.php file on all user panel pages
    include("auth_session.php");
    require("config.php");
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
        <link rel="stylesheet" href="../css/styl" />
        <style>
            <?php 
                    include("../css/style.css"); 
            ?>
        </style>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
        </style>

        <link rel="shortcut icon" href="../img/free-bar-chart-icon-676-thumb.png">
        <!-- JavaScripts -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <!-- javascript pour le graph des avis-->
        <script type="text/javascript" src="./jquery.min.js"></script>
        <script type="text/javascript" src="./Chart.min.js"></script>
        <script type="text/javascript" src="./linegraph.js"></script>

        <!--Any Chart-->
        <script src="https://cdn.anychart.com/releases/8.9.0/js/anychart-base.min.js"></script>
        <script src="https://cdn.anychart.com/releases/8.9.0/js/anychart-map.min.js"></script>
        <script src="https://cdn.anychart.com/geodata/latest/custom/world/world.js"></script>

        <script src="https://cdn.anychart.com/releases/8.9.0/js/anychart-data-adapter.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.3.15/proj4.js"></script>

        <script src="https://cdn.anychart.com/releases/8.9.0/js/anychart-exports.min.js"></script>
        <script src="https://cdn.anychart.com/releases/8.9.0/js/anychart-ui.min.js"></script>

        <script src="../js/dark.js"></script>
        <script src="https://cdn.anychart.com/themes/2.0.0/coffee.min.js"></script>
        <script src="https://cdn.anychart.com/themes/2.0.0/dark_blue.min.js"></script>
            
        <link rel="stylesheet" type="text/css" href="https://cdn.anychart.com/releases/8.9.0/css/anychart-ui.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.anychart.com/releases/8.9.0/fonts/css/anychart-font.min.css">
        <script>
            <?php 
            require_once("../js/map.js");
            require_once("./linegraph.js")
            ?>
        </script>
    </head>
    <style type="text/css">      
      #container { 
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
      } 
    </style>

    <body style="background-color:#181921;">
    
    <script>
        jQuery(window).load(function(){ jQuery(".loader").fadeOut("200"); });
    </script>
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
                        <div class="row" style="margin-bottom:-50px;">
                            <!--Dashboard-->
                            <div class="col-md-4 pt-5 pb-5"> 
                                <h2 style="font-weight:bold;">Dashboard</h2>
                                <br><br>
                                <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
                                <p>You are now user dashboard page.</p>
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
                                    <img class="" src="../img/ring.png" style="width:50px;">
                                    </a>
                                    <a href="./signup.html">
                                        <img src="../img/memoji-iphone-ios-13-modified.png" style="width: 43px;"">
                                    </a>
                                    <a href="logout.php">
                                        <img class="" src="../img/lgout.png" style="width: 50px;">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--Calendar TotalCustomer TotalRevenue TotalProfit Map-->
                        <!--Map representation-->
                        <div class="row">
                            <!--Calendar TotalCustomer TotalRevenue TotalProfit-->
                                <div class="col-md-6">
                                    <!--Calendar-->
                                    <div class="container calendar-total">
                                        <br>
                                        <div class="row calendar pl-3 pt-3 mb-3">
                                            <!-- August 2022    <  > -->
                                            <div class="date-select">
                                                <p style="font-weight:bold;">October 2022</p>
                                                <div class="arrows">
                                                    <a><</a>
                                                    <a>></a>
                                                </div>
                                            </div>
                                            <!-- Mo Tu We Th Fri Sa-->
                                            <br>
                                            <div class="row jour">
                                                <p>Sa</p>
                                                <p>Su</p>
                                                <p>Mo</p>
                                                <p>Tu</p>
                                                <p>We</p>
                                                <p>Th</p>
                                                <p>Fri</p>
                                                <p>Sa</p>
                                            </div>
                                            <!-- 24 25 26 27 28 29-->
                                          
                                            <div class="row jour-num">
                                            <form method="post" action="">
                                            <input class="day" type="submit" value="1" name="btn">
                                            <input class="day" type="submit" value="2" name="btn">
                                            <input class="day" type="submit" value="3" name="btn">
                                            <input class="day" type="submit" value="4" name="btn">
                                            <input class="day" type="submit" value="5" name="btn">
                                            <input class="day" type="submit" value="6" name="btn">
                                            <input class="day" type="submit" value="7" name="btn">
                                            <input class="day" type="submit" value="8" name="btn">
                                            </form>
                                            </div>
                                            <div class="row jour-num">
                                            <form method="post" action="">
                                            <input class="actual-day" type="submit" value="9" name="btn">
                                            <input class="day" type="submit" value="10" name="btn">
                                            <input class="day" type="submit" value="11" name="btn">
                                            <input class="day" type="submit" value="12" name="btn">
                                            <input class="day" type="submit" value="13" name="btn">
                                            <input class="day" type="submit" value="14" name="btn">
                                            <input class="day" type="submit" value="15" name="btn">
                                            <input class="day" type="submit" value="16" name="btn">
                                            </form>
                                            </div>
                                            <div class="row jour-num">
                                            <form method="post" action="">
                                            <input class="day" type="submit" value="17" name="btn">
                                            <input class="day" type="submit" value="18" name="btn">
                                            <input class="day" type="submit" value="19" name="btn">
                                            <input class="day" type="submit" value="20" name="btn">
                                            <input class="day" type="submit" value="21" name="btn">
                                            <input class="day" type="submit" value="22" name="btn">
                                            <input class="day" type="submit" value="23" name="btn">
                                            <input class="day" type="submit" value="24" name="btn">
                                            </form>
                                            </div>
                                            <div class="row jour-num">
                                            <form method="post" action="">
                                            <input class="day" type="submit" value="25" name="btn">
                                            <input class="day" type="submit" value="26" name="btn">
                                            <input class="day" type="submit" value="27" name="btn">
                                            <input class="day" type="submit" value="28" name="btn">
                                            <input class="day" type="submit" value="29" name="btn">
                                            <input class="day" type="submit" value="30" name="btn">
                                            <input class="day" type="submit" value="31" name="btn">
                                            </form>
                                            <form method="post" action="index.php">
                                            <input class="day" type="submit" value="" name="btn">
                                            </form>
                                            </div>
                                            
                                            <?php $_SESSION['jours']=1; ?>
                                            
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!--Maquette carte representation client-->
                                    <h5>Sales Mapping by Country</h5>
                                    <div id="container"></div>
                                
                <!--Carte en attendant de la mettre dans un fichier different-->
    <script>
    anychart.onDocumentReady(function() {
      anychart.data.loadJsonFile("http://localhost/sales-analysis/html/locationdata.php",
      function (data) {
      
      // set the color theme
       anychart.theme('darkGlamour');
      
      // set the map chart
      var map = anychart.map();
      
      // set the global geodata
      map.geoData('anychart.maps.world');

      // set the chart title
      map.title( '');

      // create a dataset from data
      var portsDataSet = anychart.data.set(data).mapAs();

      // helper function to create several series
      var createSeries = function (name, data, color) {
        
        // set the marker series
        var series = map.marker(data);
        
        // configure the series settings
        series
          .name(name)
          .fill(color)
          .stroke('none')
          .type('circle')
          .size(3)
          .labels(false)
          .selectionMode('none');

        series
          .legendItem()
          .iconType('circle')
          .iconFill(color);
      };

      // create 5 series, filtering the data by the outflows at each port
      createSeries(
        'Up to 100,000',
        portsDataSet.filter('outflows', filterFunction(0, 100000)),
        '#D1FAE9'
      );
      createSeries(
        '100,000 - 1,000,000',
        portsDataSet.filter('outflows', filterFunction(100000, 1000000)),
        '#9CE0E5'
      );
      createSeries(
        '1,000,000 - 5,000,000',
        portsDataSet.filter('outflows', filterFunction(1000000, 5000000)),
        '#00ACC3'
      );
      createSeries(
        '5,000,000 - 10,000,000',
        portsDataSet.filter('outflows', filterFunction(5000000, 10000000)),
        '#355CB1'
      );
      createSeries(
        'More than 10,000,000 outflows',
        portsDataSet.filter('outflows', filterFunction(10000000, 0)),
        '#002D79'
      );

      // enable and configure the map tooltip
      map
        .tooltip() 
        .useHtml(true)
        .padding([8, 13, 10, 13])
        .width(350)
        .fontSize(12)
        .fontColor('#e6e6e6')
        .titleFormat(function () {
          return this.getData('Name');
        })
        .format(function () {
          return (
            '<span style="color: #bfbfbf">Country: </span>'+
            this.getData('Country') +
            '<br/>' +
            '<span style="color: #bfbfbf">Outflows: </span>' +
            this.getData('outflows').toFixed(0)
          );
        });

      // turn on the map legend
      map.legend(false);

      // add zoom ui controls
      var zoomController = anychart.ui.zoom();
      zoomController.render(map);

      // set the container
      map.container('container');

      // draw the map
      map.draw();

      });
    });

    // helper filter function
    function filterFunction(val1, val2) {
      if (val2) {
        return function (fieldVal) {
          return val1 <= fieldVal && fieldVal < val2;
        };
      }
      return function (fieldVal) {
        return val1 <= fieldVal;
      };
    }

    </script>

    <!--Carte en attendant de la mettre dans un fichier different-->
                                </div>
                            </div>
                            <br>
                            <br><br>
                            <!--TotalCustomer TotalRevenue TotalPRofit-->
                                        <div class="row total gy-3">
                                            <div class="col-3 total-customer pt-3 pb-3">
                                                <p style="font-size: 100%;">Total Customer</p>
                                                <div class="total-cust">
                                                    <p>$45.52</p>
                                                    <p class="pourc">-2.3%</p>
                                                </div>
                                            </div>
                                            <div class="col-3 total-revenue pt-3 pb-3">
                                                <p style="font-size: 100%;">Total Revenue</p>
                                                <div class="total-rev">
                                                <?php
                                                    $data = $mysqli->query('SELECT SUM(prix_vente) as sum FROM produit WHERE id in (SELECT id_produit from produit_client where id_client in (SELECT id_client FROM client_vendeur WHERE id_vendeur=9))') or die(mysql_error());
                                                    $row = $data->fetch_assoc();
                                                    $numClient = $row['sum'];
                                                    echo '$'.sprintf("%.2f", $numClient);
                                                    
                                                ?>
                                                    <p></p>
                                                    <p class="pourc">+4.2%</p>
                                                </div>
                                            </div>
                                            <div class="col-3 total-profit pl-3 pt-3 pb-3">
                                                <p style="font-size: 100%;">Total Profit</p>
                                                <div class="total-prof">
                                                <?php
                                                    $data = $mysqli->query("SELECT SUM(prix_achat) as sum FROM produit WHERE id in (SELECT id_produit from produit_client where id_client in (SELECT id_client FROM client_vendeur WHERE id_vendeur in (SELECT id from vendeur WHERE username='".$_SESSION['username']."')))") or die(mysql_error());
                                                    $row = $data->fetch_assoc();
                                                    $numClient = $row['sum'];
                                                    $data1 = $mysqli->query("SELECT SUM(prix_vente) as sum FROM produit WHERE id in (SELECT id_produit from produit_client where id_client in (SELECT id_client FROM client_vendeur WHERE id_vendeur in (SELECT id from vendeur WHERE username='".$_SESSION['username']."')))") or die(mysql_error());
                                                    $row1 = $data1->fetch_assoc();
                                                    $numClient1 = $row1['sum'];
                                                    $numClient1=$numClient1-$numClient;
                                                    echo '$'.sprintf("%.2f", $numClient1);
                                                    
                                                ?>
                                                    <p></p>
                                                    <p class="pourc">-8.4%</p>
                                                </div>
                                            </div>
                                        </div>
                            <!--CustomerSatisfaction 3Memojis-->
                            <div class="container">
                                <div class="row">
                                    <!--Chart customer satisfaction-->
                                    <div class="col-md-6">
                                        <h3>Customer satisfaction</h3>
                                        <br><br>
                                        <div class="chart-container">
                                            <canvas id="mycanvas"></canvas>
                                        </div>
                                    </div>
                                    <!--3Memsojis-->
                                    <div class="col-md-6" style="margin-top:50px;">
                                    <br>
                                        <div class="row memojis">
                                            <div class="col-md-3 memoji">
                                                <img src="../img/memoji1.png">
                                                <h5>JEAN Pierre</h5>
                                            </div>
                                            <div class="col-md-3 memoji">
                                                <img src="../img/memoji2.png">
                                                <h5>SAAD Maria</h5>
                                            </div>
                                            <div class="col-md-3 memoji">
                                                <img src="../img/memoji3.png">
                                                <h5>DIAKITE Tiemokodjan</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br><br>
                </div>
            </div>
        </div>
        <script>
   
</script>
    </body>
</html>