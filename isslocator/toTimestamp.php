<?php include ('header.php') ?>

<title>ISS Locator</title>

<?php 

$getTime = $_POST['issDatetime'];

$genTimestamp = strtotime($getTime);

$time = [];
$time[6] = $genTimestamp ;


for ( $j = 5; $j >= 0 ; $j--) {
  $time[$j] = $time[$j+1]-600;
  
}
for ($t = 7; $t <= 12; $t++) {
  $time[$t] = $time[$t-1]+600;
} ?>


  <div class="wrapper">

    <h1><a href="index.php">International Space Station</a></h1>
    <p>Track the ISS here</p>

    <hr>

    <?php include ('iss-locator.php'); ?>



    <div class="container">


      <?php

         $strtourl = "https://api.wheretheiss.at/v1/satellites/25544/positions?timestamps=$time[0],$time[1],$time[2],$time[3],$time[4],$time[5],$time[6],$time[7],$time[8],$time[9],$time[10],$time[11],$time[12]&units=miles";

         $url = $strtourl;

         $cURL = curl_init();
         curl_setopt($cURL, CURLOPT_URL, $url);
         curl_setopt($cURL, CURLOPT_HTTPGET, true);
         curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
         
         curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
             'Content-Type: application/json',
             'Accept: application/json'
         ));
         
         $result = curl_exec($cURL);
         curl_close($cURL);
         $arrays =  json_decode($result);

      ?>

          <table class="table100">
            <thead>
            <tr class="table100-head">
                <th>Timestamp</th> 
                <th>Id</th> 
                <th>Name</th> 
                <th>Longitude</th>
                <th>Latitude</th>
            </tr>
          </thead>


            <?php foreach ($arrays as $value){    ?>

                <tr>
                    <td><?php echo $value -> timestamp ?> </td>
                    <td id="ids"><?php echo $value -> id ?> </td> 
                    <td id="names"><?php echo $value -> name ?> </td> 
                    <td><?php echo $value -> latitude ?> </td>
                    <td><?php echo $value -> longitude ?> </td>

                </tr>

            <?php  } ?>            

        </table>

        <br>
        <p id="legend">Timestamp 7 : Selected Time & Date <br>Timestamp 0-5 : 10 minutes backward <br>Timestamp 7-12 : 10 minutes forward </p>
        <br>


    </div>

    <?php include ('issmap.php'); ?>

    <?php include ('footer.php') ?>

  </div>