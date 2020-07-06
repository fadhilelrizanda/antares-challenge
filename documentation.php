<!DOCTYPE html>
<head>
</head>
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

<style>
.h1-judul{
    font-size:30px;
    letter-spacing:5px;
 
.card{
    font-weight: 200;

}
}
    </style>
<body>
<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <a href="index.php"><button class="btn btn-outline-success" type="button">Monitor Sensors</button></a>
    <a href="status.php" ><button class="btn btn-outline-success" type="button">Monitor and setting actuators</button></a>
    <a href="documentation.php" ><button class="btn btn-outline-success" type="button">Documentations</button></a>

  </form>
</nav>
<div class="container card mt-4 mb-5">
<p class="text-center h1-judul">Documentation</p>
<div class="row">
<table class="table">
  <thead class="black white-text">
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Utilities</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Humid</td>
      <td>(Humidity) Percentage of humidity that sensors read(in percentage)</td>
    
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Temp</td>
      <td>(Temperature) Temperature that sensors read(in celcius)</td>
    
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Moist</td>
      <td>(Moisture) Moisture that sensors read(in percentage. Bigger the value drier the soil)</td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td>TempL</td>
      <td>(Limit Temperature) Temperature that sensors read(in celcius)</td>
    
    </tr>
    <tr>
      <th scope="row">5</th>
      <td>MoistL</td>
      <td>(Limit Moisture) Mousture that sensors read(in percentage)</td>
    
    </tr>
    
  </tbody>
</table>    




</div>
<h2 class="text-center">Simple Schematics</h2>
<img class="mx-auto" src="Simple Schematics.png"/>

<h2 class="mt-5 text-center">Devices And Platform</h2>
<div class="row">
<div class="col-6">
<div class="card card-body bg-light">
<img src="antares.png" height=200px/>
<p class="text-center">Antares</p>
</div>
</div>

<div class="col-6">
<div class="card card-body bg-light">
<img src="wemos.png" height=200px/>
<p class="text-center">Wemos D1 R1</p>
</div>
</div>


</div>






<h2 class="text-center mt-5">Sensors</h2>



<div class="row">
<div class="col-4 offset-2">
<div class="card card-body bg-light">
<img src="dht11.jpeg" height=250px/>
<p class="text-center">DHT 11 Sensor</p>
</div>
</div>

<div class="col-4">
<div class="card card-body bg-light">
<img src="moisture.jpg" height=250px/>
<p class="text-center">Moisture Sensor</p>
</div>
</div>
</div>

<h2 class="text-center mt-5">Actuators</h2>
<div class="row mb-5">

<div class="col-3">
<div class="card card-body bg-light">
<img src="fan.jpg" height=200px/>
<p class="text-center">DC Fan</p>
</div>
</div>


<div class="col-3">
<div class="card card-body bg-light">
<img src="mini pump.jpg" height=200px/>
<p class="text-center">Mini DC Pump</p>
</div>
</div>


<div class="col-3">
<div class="card card-body bg-light">
<img src="LED.jpg" height=200px/>
<p class="text-center">LED</p>
</div>
</div>


<div class="col-3">
<div class="card card-body bg-light">
<img src="lcd.jpg" height=200px/>
<p class="text-center">LCD</p>
</div>
</div>
</div>


<h2 class="text-center">Github</h2>
<p>Web App Monitor</p>
<p>https://github.com/fadhilelrizanda/antares-challenge</p>
<p class="mt-5">Microcontroller Code</p>
<p>https://github.com/fadhilelrizanda/antares-challenge-micro</p>



</div>

</div>
</div>


</div>

</body>


</html>

