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
        <?php
            echo "<link rel='stylesheet' href='../css/style.css'/>";
        ?>
        
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
        </style>

        <style>
            <?php include('../css/style.css'); ?>
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

    <body style="background-color:#181921;">
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
                                                <p style="font-weight:bold;">August 2022</p>
                                                <div class="arrows">
                                                    <a><</a>
                                                    <a>></a>
                                                </div>
                                            </div>
                                            <!-- Mo Tu We Th Fri Sa-->
                                            <br>
                                            <div class="row jour">
                                                <p>Mo</p>
                                                <p>Tu</p>
                                                <p>We</p>
                                                <p>Th</p>
                                                <p>Fri</p>
                                                <p>Sa</p>
                                                <p>Su</p>
                                                <p>Mo</p>
                                            </div>
                                            <!-- 24 25 26 27 28 29-->
                                            <div class="row jour-num">
                                                <p class="actual-day">24</p>
                                                <p class="day">25</p>
                                                <p class="day">26</p>
                                                <p class="day">27</p>
                                                <p class="day">28</p>
                                                <p class="day">29</p>
                                                <p class="day">30</p>
                                                <p class="day">01</p>
                                            </div>
                                        </div>
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
                                                <p style="font-size: 100%;">Total <br> Revenue</p>
                                                <div class="total-rev">
                                                    <p>$306.56</p>
                                                    <p class="pourc">+4.2%</p>
                                                </div>
                                            </div>
                                            <div class="col-3 total-profit pl-3 pt-3 pb-3">
                                                <p style="font-size: 100%;">Total <br> Profit</p>
                                                <div class="total-prof">
                                                    <p>$158.23</p>
                                                    <p class="pourc">-8.4%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--Maquette carte representation client-->
                                    <h5>Sales Mapping by Country</h5>
                                    <div id="map"></div>
                                </div>
                            </div>
                            <br>
                            <br><br>
                            <!--CustomerSatisfaction 3Memojis-->
                            <div class="container">
                                <div class="row">
                                    <!--Chart customer satisfaction-->
                                    <div class="col-md-6" style="margin-top:-15px;">
                                        <h3>Customer satisfaction</h3>
                                    </div>
                                    <!--3Memsojis-->
                                    <div class="col-md-6" style="margin-top:50px;">
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
                    <br><br><br><br>
                </div>
            </div>
        </div>
    </body>
</html>