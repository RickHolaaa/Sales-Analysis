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
        <link rel="stylesheet" href="../css/style.css"/>
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

        
        <style type="text/css">      
            #container { 
              width: 100%;
              height: 100%;
              margin: 0;
              padding: 0; 
            } 
          </style>
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
                                <a href="./index.html" class="nav-link section">
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
                              <a href="#" class="nav-link section">
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
                                <a href="#" class="nav-link section">
                                    <i class='fas fa-user-shield mr-3 fa-fw'></i>
                                          Help
                                      </a>
                            </li>
                            <li class="nav-item">
                                <a href="./settings.html" class="nav-link section">
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
                                <h2>Dashboard</h2>
                                <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
                                <p>You are now user dashboard page.</p>
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
                                    <a href="./signup.html">
                                        <img src="../img/memoji-iphone-ios-13-modified.png" style="width: 10%;"">
                                    </a>
                                    <a href="logout.php">
                                        <img class="" src="../img/logout.png" style="width: 10%;">
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
                                        <div class="row calendar pl-3 pt-3 mb-3">
                                            <div class="date-select">
                                                <p>August 2022</p>
                                                <p>< ></p>
                                            </div>
                                        </div>
                                        <!--TotalCustomer TotalRevenue TotalPRofit-->
                                        <div class="row total gy-3">
                                            <div class="col-3 total-customer pl-3 pt-3 m-3">
                                                <p style="font-size: 75%;">Total Customer</p>
                                                <p>$45.52 <span style="color: #E35835; font-size: 75%;">&nbsp;&nbsp;&nbsp;&nbsp;-2.3%</span></p>
                                            </div>
                                            <div class="col-3 total-revenue pl-3 pt-3 m-3">
                                                <div class="date-select">
                                                    <p style="font-size: 75%;">Total Revenue</p>
                                                    <p>$306.56<span style="color: #5BC68B; font-size: 75%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+4.2%</span></p>
                                                </div>
                                            </div>
                                            <div class="col-3 total-profit pl-3 pt-3 m-3">
                                                <div class="date-select">
                                                    <p style="font-size: 75%;">Total Profit</p>
                                                    <p>$158.23<span style="color: #E35835; font-size: 75%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-8.4%</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--Maquette carte representation client-->
                                    <div id="container"></div>
                                    <script>
                                    anychart.onDocumentReady(function() {
                                    anychart.data.loadJsonFile('https://gist.githubusercontent.com/shacheeswadia/47b28a4d061e415555f01f5ce48e9ae3/raw/0f7592a8048872db7b77ccd2df8907e61952a806/shippingDataInverted.json',
                                    function (data) {
                                    
                                    // set the color theme
                                    anychart.theme('darkGlamour');
                                    
                                    // set the map chart
                                    var map = anychart.map();
                                    
                                    // set the global geodata
                                    map.geoData('anychart.maps.world');


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
                                    //map.legend(true);
                                        
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
                                </div>
                            </div>
                            
                            <!--CustomerSatisfaction 3Memojis-->
                            <div class="row">
                                <!--Chart customer satisfaction-->
                                <div class="col-md-6">

                                </div>
                                <!--3Memojis-->
                                <div class="col-md-6">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>