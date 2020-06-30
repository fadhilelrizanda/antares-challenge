
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

</head>

<body>
<canvas id="lineChart"></canvas>






</body>








<?php
$chart = array();
$chart2 = array();


// ini_set('display_errors', 1);
//error_reporting(E_ALL && ~E_NOTICE);

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




$response = curl_exec($curl);

curl_close($curl);
// echo $response;
$new = json_decode($response, true);
//print_r($new);
foreach($new['m2m:uril'] as $dataId){
//  echo $dataId;
  echo "<br>";
$urlData = "https://platform.antares.id:8443/~".$dataId ;
//echo $urlData;


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $urlData,
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




$response = curl_exec($curl);
curl_close($curl);
$new2 = json_decode($response,true);
$dataReal =  $new2["m2m:cin"]["con"];
$dataReal2 = json_decode($dataReal,true);
$pressure = $dataReal2["Humidity"];
array_push($chart, $pressure);
//data temperature
$temp = $dataReal2["Temperature"];
array_push($chart2, $temp);


}


?>











<script>
//line
var ctxL = document.getElementById("lineChart").getContext('2d');
var myLineChart = new Chart(ctxL, {
type: 'line',
data: {
labels: [<?php foreach($chart as $key=>$value) {
    echo $key;
    echo ",";
}?>],
datasets: [{
label: "My First dataset",
data: [<?php foreach($chart as $hasil){
  echo $hasil;
  echo ",";
}?>],
backgroundColor: [
'rgba(105, 0, 132, .2)',
],
borderColor: [
'rgba(200, 99, 132, .7)',
],
borderWidth: 2
},
{
label: "My Second dataset",
data: [<?php foreach($chart2 as $hasil){
  echo $hasil;
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
</script>




</html>