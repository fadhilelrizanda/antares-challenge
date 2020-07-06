<!Doctype html>
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



</head>
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://platform.antares.id:8443/~/antares-cse/antares-id/antaresChallenge/actuatorState/la",
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

curl_close($curl);
$stateJson = json_decode($response, true);
$stateJson = $stateJson["m2m:cin"]["con"];

$actuatorStatus = json_decode($stateJson, true);

if(isset($actuatorStatus["LED"])){
$ledStatus =  $actuatorStatus["LED"];
$fanStatus = $actuatorStatus["Fan"];
$pumpStatus = $actuatorStatus["Pump"];
if($fanStatus==0){
  $limitFan = "Off";
}
else{
  $limitFan = $actuatorStatus["limitTemp"];
}
if($pumpStatus==0){
  $limitMoisture ="off";
}
else{
  $limitMoisture = $actuatorStatus['limitMoisture'];
}



if($ledStatus==0){
  $ledReport = "Off";
  $colorLedStatus ="btn-danger";
}
else if($ledStatus ==1){
$ledReport="On";
$colorLedStatus ="btn-success";
}
else{
  $ledReport = "Error";
}

if($fanStatus==0){
  $fanReport = "Off";
  $colorFanStatus ="btn-danger";
}
else if($fanStatus ==1){
$fanReport="On";
$colorFanStatus ="btn-success";
}
else{
  $fanReport = "Error";
}
if($pumpStatus==0){
  $pumpReport = "Off";
  $colorPumpStatus ="btn-danger";
}
else if($pumpStatus ==1){
$pumpReport="On";
$colorPumpStatus ="btn-success";
}
else{
  $pumpReport = "Error";
}
}
?>
<?php

$ledArray = array();
$fanArray = array();
$pumpArray = array();
$limitFanArray = array();
$limitMoistureArray = array();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://platform.antares.id:8443/~/antares-cse/antares-id/antaresChallenge/actuatorState?fu=1&ty=4",
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
$stateValue = json_decode($newValue, true);
if(isset($stateValue["LED"]) && $stateValue['Pump']<2){

$led =$stateValue["LED"];
$fan =$stateValue["Fan"];
$pump = $stateValue["Pump"];
array_push($ledArray, $led);
array_push($fanArray, $fan);
array_push($pumpArray, $pump);
$ledReverse = array_reverse($ledArray);
$fanReverse = array_reverse($fanArray);
$pumpReverse = array_reverse($pumpArray);
//$humidArray = array_reverse($humidArray);
//$tempArray = array_reverse($tempArray);
//$moistureArray = array_reverse($moistureArray);


}
else {

}
curl_close($curl);


}
?>
<body>

<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
  <a href="index.php"><button class="btn btn-outline-success" type="button">Monitor Sensors</button></a>
    <a href="status.php" ><button class="btn btn-outline-success" type="button">Monitor and setting actuators</button></a>
    <a href="documentation.php" ><button class="btn btn-outline-success" type="button">Documentations</button></a>
  </form>
</nav>
<div class="container well">

<h1 class="text-center mb-5 mt-5">Monitoring Actuator Status</h1>
<div class="row  card card-body bg-light mt-4">
<div class="col-12">
<canvas class="mychart" id="lineChart"></canvas>
</div>
</div>
<div class=" card card-body bg-light mt-4">
<h3 class="mt-2 text-center">Set Actuators</h3>
<div class="row mt-5 ">
<div class="col-md-4">
<h3 class="text-center">Led Status</h3>
<button class="btn <?php echo $colorLedStatus?> btn-block " disabled ><? echo $ledReport; ?> </button>
</div>
<div class="col-md-4">
<h3 class="text-center"> Fan Status</h3>
<button class="btn  <?php echo $colorFanStatus?> btn-block" disabled ><? echo $fanReport; ?> </button>
</div>
<div class="col-md-4">
<h3 class="text-center">Pump Status</h3>
<button class="btn  <?php echo $colorPumpStatus?> btn-block"disabled ><? echo $pumpReport; ?> </button>
</div>
</div>
<div class="row mt-3">
<div class="col-6">

<button class="btn btn-info btn-block">Current Limit Maximum Temperatur: <?php echo $limitFan;?></button>

</div>
<div class="col-6">

<button class="btn btn-info btn-block">Current Limit Maximum Moisture: <?php echo $limitMoisture?></button>

</div>  
</div>


<form method="get" action="sending.php">
<div class="row mt-5">
<div class="col-md-4">
<p>Set LED State</p>
  <input type="radio" id="male" name="ledState" value="1" required>
  <label for="male">ON</label><br>
  <input type="radio" id="female" name="ledState" value="0">
  <label for="female">OFF</label><br>


</div>

<div class="col-md-4">
<p>Set Fan State</p>
  <input type="radio" id="male" name="fanState" value="1" required>
  <label for="male">ON</label><br>
  <input type="radio" id="female" name="fanState" value="0">
  <label for="female">OFF</label><br>
<!-- Material input -->
<div class="md-form">
  <input name="limitTemp" type="text" id="form1" class="form-control" placeholder="ex: 30" required>
  <label for="form1">Limit Maximum Temperatur</label>
</div>



</div>

<div class="col-md-4">
<p>Set Pump State</p>
  <input type="radio" name="pumpState" value="1" required>
  <label for="male">ON</label><br>
  <input type="radio" id="female" name="pumpState" value="0">
  <label for="female">OFF</label><br>
  <div class="md-form">
  <input name="limitMoisture" type="text" id="form1" class="form-control" placeholder="ex:80" required>
  <label for="form1">Limit Minimum Moisture</label>
</div>

</div>

</div>
<div class="row">
<div class="col-12">
<input class="btn btn-info btn-block myBtn" type="submit" value="Submit">
</div></div>



</form>


</div>
</div>

</body>
<script>
var ctxL1 = document.getElementById("lineChart").getContext('2d');
var myLineChart = new Chart(ctxL1, {
type: 'line',
data: {
labels: [<?php foreach($ledReverse as $key=>$value){
  echo $key+1;
  echo ",";
}?>],
datasets: [{
label: "LED State",
data: [
  <?php foreach($ledReverse as $humid){
    echo $humid;
    echo ",";
  
  } ?>
],
backgroundColor: [
'rgba(205, 29, 29, 0.4)',
],
borderColor: [
'rgba(205, 29, 29, 0.81)',
],
borderWidth: 4
},{

label: "Fan State",
data: [
  <?php foreach($fanReverse as $humid){
    echo $humid;
    echo ",";
  
  } ?>
],
backgroundColor: [
'rgba(33, 130, 228, 0.63)',
],
borderColor: [
'rgba(33, 130, 228, 0.9)',
],
borderWidth: 4
},
{
label: "Pump State",
data: [
  <?php foreach($pumpReverse as $humid){
    echo $humid;
    echo ",";
  
  } ?>
],
backgroundColor: [
'rgba(228, 228, 33, 0.59)',
],
borderColor: [
'rgba(228, 228, 33, 0.91)',
],
borderWidth: 4
}

]
},
options: {
responsive: true
}
});

</script>









