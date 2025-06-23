<?php

include "../components/connect.php";

$query = "SELECT * FROM REGISTER";
$response = mysqli_query($dbConnect, $query);
// $result = mysqli_fetch_all($response);
$result = mysqli_fetch_all($response, MYSQLI_ASSOC);
print_r($result);
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
    <?php 
    foreach($result as $rez){
        echo $rez['first_name'] . " " . $rez['last_name'];
    }
        
    ?>
 </body>
 </html>