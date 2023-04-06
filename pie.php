<?php
// MySQL 연결
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizza";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die("Connection failed: ". $conn->connet_error);
}

// MySQL에서 데이터 가져오기
$query = "SELECT * FROM favorite_pizza";
$result = mysqli_query($conn, $query);

// PHP 배열 형태로 데이터 저장
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = array($row['pizza_name'], (int)$row['rating']);
}

// JavaScript 배열 형태로 데이터 변환
echo '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
echo '<script type="text/javascript">';
echo 'google.charts.load("current", {packages:["corechart"]});';
echo 'google.charts.setOnLoadCallback(drawChart);';

echo 'function drawChart() {';
echo '  var options = {';
echo '    title: "내가 좋아하는 피자"';
echo '  };';

echo '  var data = google.visualization.arrayToDataTable(' . json_encode(array_merge([['피자', 'rating']], $data)) . ');';

echo '  var chart = new google.visualization.PieChart(document.getElementById("piechart"));';
echo '  chart.draw(data, options);';
echo '}';
echo '</script>';

// MySQL 연결 종료
mysqli_close($conn);
?>

<html>
  <head>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>