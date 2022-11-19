$(document).ready(function(){
  $.ajax({
    url : "http://localhost/sales-analysis/html/avisdata.php",
    type : "GET",
    success : function(data){
      console.log(data);

      var id_jours = [];
      var avis = [];

      for(var i in data) {
        id_jours.push("J - " + data[i].id_jours);
        avis.push(data[i].avis);
      }

      var chartdata = {
        labels: id_jours,
        datasets: [
          {
            label: "Reviews",
            fill: false,
<<<<<<< HEAD
            lineTension: 0.6,
=======
            lineTension: 0.4,
>>>>>>> 50fabd190e158e4a27a185082cd1cefcbdf33047
            backgroundColor: "#60C8FB",
            borderColor: "rgb(83, 181, 226)",
            pointHoverBackgroundColor: "rgb(96, 200, 251)",
            pointHoverBorderColor: "rgb(96, 200, 251)",
            data: avis
          },
        ],
      };

      const options = {
        legend: {
          display: false
        },
        responsive: true,
        tooltips: {
          mode: 'label',
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            gridLines: {
              display: true
            },
            scaleLabel: {
              display: true,
              labelString: 'by Day'
            }
          }],
          yAxes: [{
            display: true,
            gridLines: {
              display: true
            },
            scaleLabel: {
              display: true,
              labelString: 'Review (1 to 5 stars)'
            }
          }]
        }
      }

      var ctx = $("#mycanvas");

      var LineGraph = new Chart(ctx, {
        type: 'line',
        data: chartdata,
        options: options
      });

    },
    error : function(data) {

    }
  });
});