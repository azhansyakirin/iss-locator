<div class="containerPeople">


<?php

   $url = 'http://api.open-notify.org/astros.json';

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

    <table class="tablePeople">

    <thead>
        <tr class="tablePeople-head">
            <th colspan="10">People on the ISS</th>
        </tr>
    </thead>


    <?php for ($i=0; $i<10; $i++) {    ?>
            <td class="tablePeople-body">
                <?php echo $arrays -> people[$i] -> craft ?>
                <br>
                <?php echo $arrays -> people[$i] -> name ?>
            </td>

    <?php }  ?>


  </table>



</div>