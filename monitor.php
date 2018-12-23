<?php
include("./include/sess_start.php");
include("./include/pycalls.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>TerraPi - Control Panel and Sensor Readings:</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <style>
  tr {width:10%;text-align:left;}
  td {border: 1px solid black;}
  </style>
</head>
<body>
<h2>TerraPi: Control Panel and Sensor Readings:</h2>
<div class="container">

<!-- On/Off button's picture -->
<h3>Button Controls:</h3>
<?php
include("./include/switches.php")
?>

</div>

<!-- javascript for BUTTONS ABOVE! -->
<script src="script.js"></script>
<hr />
<h3>Current Sensor Readings:</h3>
<table>
 <tr>
   <th>Sensor Reading:</th>
   <th>Value: </th>
 </tr>
 <tr>
   <td>Temperature [C] </td>
   <td><?php echo $_SESSION["temp"]; ?></td>
 </tr>
 <tr>
   <td>Moisure Level [%]</td>
   <td><?php echo $_SESSION["moist"]; ?></td>
 </tr>
 <tr>
   <td>Electrical Conductivity [&#x00B5;S/cm ]</td>
   <td><?php echo $_SESSION["ec"]; ?></td>
 </tr>
 <tr>
   <td>Total Dissolved Solids [ppm]</td>
   <td><?php echo $_SESSION["ppm"]; ?></td>
 </tr>
 <tr>
   <td>Salinity [PSU]</td>
   <td><?php echo $_SESSION["salt"]; ?></td>
 </tr>
</table>
<hr />
<h3>Sensor Readings: Last 24 hours: </h3>

<!-- 24HR TEMP GRAPH -->
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
      var data = google.visualization.arrayToDataTable([
          ['Time', 'Temperature [C]', ], <?php include("./include/sqltempcall.php"); ?> ]);

    	var options = {
    	title: 'Temperature Last 24Hrs',
    	curveType: 'function',
    	legend: { position: 'none' },
      hAxis: { format: 'LL/dd hh:mm' }};

      var chart = new google.visualization.LineChart(document.getElementById('chart_temp'));
      chart.draw(data, options);
    }
    </script>

    <!-- 24HR Moisture GRAPH -->
    <script type="text/javascript">
          google.load("visualization", "1", {packages:["corechart"]});
          google.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Time', 'Moisture [%]', ], <?php include("./include/sqlmoisturecall.php"); ?> ]);

    	var options = {
    	title: 'Moisture Level Last 24Hrs',
    	curveType: 'function',
    	legend: { position: 'none' },
    	hAxis: { format: 'LL/dd hh:mm'},
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_moist'));
            chart.draw(data, options);
          }
        </script>

        <!-- One Month Electrical Conductivity Graph -->
        <script type="text/javascript">
              google.load("visualization", "1", {packages:["corechart"]});
              google.setOnLoadCallback(drawChart);
              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Time', 'Electrical Conductivity [uS/cm]', ], <?php include("./include/sqleccall.php"); ?> ]);

        	var options = {
        	title: 'Electrical Conductivity Level Last 30 Days',
        	curveType: 'function',
        	legend: { position: 'none' },
        	hAxis: { format: 'LL/dd hh:mm' },
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_cond'));
                chart.draw(data, options);
              }
            </script>

        <!-- One Month Total Dissolved Solids Graph  -->
        <script type="text/javascript">
              google.load("visualization", "1", {packages:["corechart"]});
              google.setOnLoadCallback(drawChart);
              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Time', 'Total Dissolved Solids [ppm]'], <?php include("./include/sqltdscall.php"); ?> ]);

        	var options = {
        	title: 'Total Dissolved Solids Level Last 30 Days',
        	curveType: 'function',
        	legend: { position: 'none' },
        	hAxis: { format: 'LL/dd hh:mm' },
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_tds'));
                chart.draw(data, options);
              }
            </script>
        <!-- One Month Salinity Graph  -->
        <script type="text/javascript">
              google.load("visualization", "1", {packages:["corechart"]});
              google.setOnLoadCallback(drawChart);
              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Time', 'Salinity [PSU]', ], <?php include("./include/sqlsaltcall.php"); ?>  ]);

        	var options = {
        	title: 'Salinity Level Last 30 Days',
        	curveType: 'function',
        	legend: { position: 'none' },
        	hAxis: { format: 'LL/dd hh:mm' },
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_salt'));
                chart.draw(data, options);
              }
            </script>

    <h4> Temperature:</h4>
    <div id="chart_temp" style="width: auto; height: 400px; width: 600px;"></div>
    <br />
    <h4> Moisture:</h4>
    <div id="chart_moist" style="width: auto; height: 400px; width: 600px;"></div>
    <br />
    <h4> Electrical Conductivity:</h4>
    <div id="chart_cond" style="width: auto; height: 400px; width: 600px;"></div>
    <br />
    <h4> Total Dissolved Solids:</h4>
    <div id="chart_tds" style="width: auto; height: 400px; width: 600px;"></div>
    <br />
    <h4> Salinity:</h4>
    <div id="chart_salt" style="width: auto; height: 400px; width: 600px;"></div>
    <br />
</body>
</html>

<?php
include("./include/sess_end.php");
 ?>
