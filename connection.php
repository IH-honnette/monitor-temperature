<?php

//create a connection to the database
$host ="localhost";
$password ="h1t5mineza";//password for the db is required!!!
$db_name ="PHP_PROJECT";//database-name is required
$user ="root";//username for the db is required!!
//create connection
$connection =mysqli_connect($host,$user,$password,$db_name);
if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
?>