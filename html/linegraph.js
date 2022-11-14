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
            lineTension: 0.1,
            backgroundColor: "rgba(59, 89, 152, 0.75)",
            borderColor: "rgba(59, 89, 152, 1)",
            pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
            pointHoverBorderColor: "rgba(59, 89, 152, 1)",
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