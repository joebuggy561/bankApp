<?php

$dbConnect = mysqli_connect('localhost', 'root', '', 'bankapp');

if(!$dbConnect){
    echo "Failed to connect to MYSQL: " . mysqli_connect_error();
    exit();
}else{
    echo "Connected to MYSQL";
}
?>