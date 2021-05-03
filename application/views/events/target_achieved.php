<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bullseye"></i>&nbsp; Target Achieved
    </div>
    <div id="upcoming-event-container">
            <div id="donutchart" style="width: 100%; height: 100%;"></div>
    </div>
</div> 

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Achieved', 'Balance'],
          ['Achieved',     100250],
          ['Balance',      23254]
         
        ]);

        var options = {
          pieHole: 0.4,
          legend :{position: 'top', textStyle: {color: 'black', fontSize: 10}},
          colors: ['#27ae60', '#d63031']
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>