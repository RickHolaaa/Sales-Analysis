$(document).ready(function(){
    $.ajax({
      url : "http://localhost/sales-analysis/html/avisdata2.php",
      type : "GET",
      success : function(data){
        console.log(data);
  
        var prenom = [];
        var avis = [];
  
        for(var i in data) {
          prenom.push("User " + data[i].prenom);
          avis.push(data[i].avis);
        }
  
        var chartdata = {
          labels: prenom,
          datasets: [
            {
              label: "Reviews",
              fill: true,
              lineTension: 0.4,
              backgroundColor: "#9CE0E5",
              borderColor: "#00ACC3",
              pointHoverBackgroundColor: "#00ACC3",
              pointHoverBorderColor: "#00ACC3",
              data: avis
            },
          ],
        };
  
  
        var ctx = $("#mycanvas");
  
        var LineGraph = new Chart(ctx, {
          type: 'line',
          data: chartdata,
        });
  
      },
      error : function(data) {
  
      }
    });
  });