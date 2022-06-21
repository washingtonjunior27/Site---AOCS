<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "testing";

    $connect = new PDO('mysql:host='.$servername.';dbname='.$database.'', $username, $password);

    if (!$connect) {
        echo "Connection Failed.";
    }
?>