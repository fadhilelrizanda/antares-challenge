<!DOCTYPE html>
<head>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
<style>
.container{
  background-color:rgb(248,249,252);
}
  </style>

<?php

$humidArray = array();
$tempArray = array();
$moistureArray = array();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://platform.antares.id:8443/~/antares-cse/antares-id/antaresChallenge/sensors?fu=1&ty=4",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "X-M2M-Origin: 017c7e810b75e05b:0932f32db0c81348",
    "Accept: application/json"
  ),
));

$responseId = curl_exec($curl);

curl_close($curl);


$response2Id = json_decode($responseId,true);
//print_r($response2);
$valueId = $response2Id["m2m:uril"];



foreach($valueId as $dataUrl){
$url = "https://platform.antares.id:8443/~".$dataUrl;

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "X-M2M-Origin: 017c7e810b75e05b:0932f32db0c81348",
    "Content-Type: application/json;ty=4",
    "Accept: application/json"
  ),
));


$response = curl_exec($curl);
$response2 = json_decode($response,true);
//print_r($response2);
$newValue = $response2["m2m:cin"]["con"];
$sensorValue = json_decode($newValue, true);
if(isset($sensorValue["Humidity"])){

$humid =$sensorValue["Humidity"];
$temp =$sensorValue["Temperature"];
$mois = $sensorValue["Moisture"];
array_push($humidArray, $humid);
array_push($tempArray, $temp);
array_push($moistureArray, $mois);
$humidReverse = array_reverse($humidArray);
$tempReverse = array_reverse($tempArray);
$moistureReverse = array_reverse($moistureArray);
//$humidArray = array_reverse($humidArray);
//$tempArray = array_reverse($tempArray);
//$moistureArray = array_reverse($moistureArray);
$tempMax = max($tempReverse);
$humidMax = max($humidReverse);
$moisMax = max($moistureReverse);

$tempMin = min($tempReverse);
$humidMin = min($humidReverse);
$moisMin = min($moistureReverse);

$tempAverage = array_sum($tempReverse)/count($tempReverse);
$humidAverage = array_sum($humidReverse)/count($humidReverse);
$moistureAverage = array_sum($moistureReverse)/count($moistureReverse);

$lastTemp = end($tempReverse);
$lastHumid = end($humidReverse);
$lastMois = end($moistureReverse);

}
else {
}
curl_close($curl);
}
?>
</head>

<body>
<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <a href="index.php"><button class="btn btn-outline-success" type="button">Monitor Sensors</button></a>
    <a href="status.php" ><button class="btn btn-outline-success" type="button">Monitor and setting actuators</button></a>
  </form>
</nav>

<div class="container wells ">
<h1 class="mt-5 text-center">Monitor Sensors</h1>
<h3 class="text-center mt-5">Humidity Sensors</h3>
<div class="row mt-5">
<div class="col-3">
<button class="btn btn-info btn-block">Max: <?php echo $humidMax; ?></button>
</div>

<div class="col-3">
<button class="btn btn-info btn-block">Min: <?php echo $humidMin;?></button>
</div>

<div class="col-3">
<button class="btn btn-info btn-block">Average: <?echo $humidAverage;?></button>
</div>
<div class="col-3">
<button class="btn btn-info btn-block">Last: <?php echo $lastHumid;?></button>
</div>
</div>
<div class="row">
<div class="col-12 card card-body bg-light mt-4"><canvas class="chart" id="lineChart"></canvas>
</div></div>
<h3 class="text-center mt-5">Temperature Sensors</h3>
<div class="row mt-5">
<div class="col-3">
<button class="btn btn-info btn-block">Max: <?php echo $tempMax;?></button>
</div>

<div class="col-3">
<button class="btn btn-info btn-block">Min: <?php echo $tempMin;?></button>
</div>

<div class="col-3">
<button class="btn btn-info btn-block">Average: <?php echo $tempAverage;?></button>
</div>
<div class="col-3">
<button class="btn btn-info btn-block">Last: <?php echo $lastTemp;?></button>
</div>
</div>
<div class="row">
<div class="col-12 card card-body bg-light mt-4"><canvas id="lineChart2"></canvas>
</div></div>
<h3 class="text-center mt-5">Moisture Sensors</h3>
<div class="row mt-5">
<div class="col-3">
<button class="btn btn-info btn-block">Max: <?php echo $moisMax; ?></button>
</div>

<div class="col-3">
<button class="btn btn-info btn-block">Min: <?php echo $moisMin;?></button>
</div>

<div class="col-3">
<button class="btn btn-info btn-block">Average: <?php echo $moistureAverage; ?></button>
</div>

<div class="col-3">
<button class="btn btn-info btn-block">Last: <?php echo $lastMois ;?></button>
</div>
</div>
<div class="row">
<div class="col-12 card card-body bg-light mt-4"><canvas id="lineChart3"></canvas>
</div></div>



</div>




</body>


<script>
var ctxL1 = document.getElementById("lineChart").getContext('2d');
var myLineChart = new Chart(ctxL1, {
type: 'line',
data: {
labels: [<?php foreach($humidReverse as $key=>$value){
  echo $key+1;
  echo ",";
}?>],
datasets: [{
label: "Humidity",
data: [
  <?php foreach($humidReverse as $humid){
    echo $humid;
    echo ",";
  
  } ?>
],
backgroundColor: [
'rgba(105, 0, 132, .2)',
],
borderColor: [
'rgba(200, 99, 132, .7)',
],
borderWidth: 4
},


]
},
options: {
responsive: true
}
});








//line
var ctxL = document.getElementById("lineChart2").getContext('2d');
var myLineChart = new Chart(ctxL, {
type: 'line',
data: {
labels: [<?php foreach($humidReverse as $key=>$value){
  echo $key+1;
  echo ",";
}?>],
datasets: [
{
label: "Temperature",
data: [<?php foreach($tempReverse as $temp)
{
  echo $temp;
  echo ",";

}?>],
backgroundColor: [
'rgba(0, 137, 132, .2)',
],
borderColor: [
'rgba(0, 10, 130, .7)',
],
borderWidth: 2
}

]
},
options: {
responsive: true
}
});


//chart 3
var ctxL1 = document.getElementById("lineChart3").getContext('2d');
var myLineChart = new Chart(ctxL1, {
type: 'line',
data: {
labels: [<?php foreach($humidReverse as $key=>$value){
  echo $key+1;
  echo ",";
}?>],
datasets: [{
label: "Moisture",
data: [
  <?php foreach($moistureReverse as $humid){
    echo $humid;
    echo ",";
  
  } ?>
],
backgroundColor: [
'rgba(69, 232, 129, 0.7)',
],
borderColor: [
'rgba(200, 99, 132, .7)',
],
borderWidth: 4
},


]
},
options: {
responsive: true
}
});








function startRefresh() {
    $.get('', function(data) {
        $(document.body).html(data);    
    });
}
$(function() {
    setTimeout(startRefresh,5000);
});


</script>

</html>
