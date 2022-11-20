<!DOCTYPE html>
<html>
  <head>
    <title>ChartJS - Graph</title>
    <style>
      .chart-container {
        width: 640px;
        height: auto;
      }
    </style>
  </head>
  <body>
    <div class="chart-container">
      <canvas id="mycanvas"></canvas>
  </div>
      <?php
      include('config.php');
      include("auth_session.php");
       echo $_SESSION['jours'] ?>
    <!-- javascript -->
    <script type="text/javascript" src="./jquery.min.js"></script>
    <script type="text/javascript" src="./Chart.min.js"></script>
    <script type="text/javascript" src="./linegraph2.js"></script>
  </body>
</html>