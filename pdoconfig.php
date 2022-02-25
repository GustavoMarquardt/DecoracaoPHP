<?php
    $host = 'localhost';
    $dbname = 'decoracao';
    $username = 'root';
    $password = '';

    $link = mysqli_connect($host, $username, $password, $dbname);

        if(mysqli_connect_errno($link)){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else{
        
        }
?>