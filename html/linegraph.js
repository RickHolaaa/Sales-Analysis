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
            label: "Avis",
            fill: false,
            lineTension: 0.6,
            backgroundColor: "#60C8FB",
            borderColor: "rgb(83, 181, 226)",
            pointHoverBackgroundColor: "rgb(96, 200, 251)",
            pointHoverBorderColor: "rgb(96, 200, 251)",
            data: avis
          },
        ]
      };

      var ctx = $("#mycanvas");

      var LineGraph = new Chart(ctx, {
        type: 'line',
        data: chartdata
      });
    },
    error : function(data) {

    }
  });
});