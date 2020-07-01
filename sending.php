<?php header("location:status.php"); ?>
<?php
// menangkap data nama dengan method nama
$ledState = $_GET['ledState'];
$fanState = $_GET['fanState'];
$pumpState = $_GET['pumpState'];

$limitFan = $_GET['limitTemp'];
$limitMoisture = $_GET['limitMoisture'];




$url = "{\r\n  \"m2m:cin\": {\r\n    \"con\": \"{\\\"LED\\\":".$ledState.",\\\"Fan\\\":".$fanState.",\\\"Pump\\\":".$pumpState.",\\\"limitTemp\\\":".$limitFan.",\\\"limitMoisture\\\":".$limitMoisture."}\"\r\n  }\r\n}";


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://platform.antares.id:8443/~/antares-cse/antares-id/antaresChallenge/actuatorState",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>$url,
  CURLOPT_HTTPHEADER => array(
    "X-M2M-Origin: 017c7e810b75e05b:0932f32db0c81348",
    "Content-Type: application/json;ty=4",
    "Accept: application/json"
  ),
));

$response = curl_exec($curl);

curl_close($curl);



?>
   
