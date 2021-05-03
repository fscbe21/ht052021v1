<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-line-chart"></i>&nbsp; Performance Chart
    </div>
    <div id="upcoming-event-container">
    <br />
    <span style="padding: 10px">Over All Performance : %</span><br />
    <br />            
        <div id="columnchart_material" style="width: 100%; height: 300px; padding: 5px;"></div>
           
    </div>    

</div> 

<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
    <script type="text/javascript">
     google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['', '', ''],
          ['March', 1000, 400],
          ['April', 1170, 460],
          ['May', 660, 120]
        ]);

        var options = {
          chart: {
            title: ''
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>