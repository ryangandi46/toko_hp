<?php
    $db_host="localhost"; // database server name
    $db_username="root"; // database username
    $db_password="";  // database password
    $db_name="toko_hp"; // database name

    //connert to mysql, if error will stop program (die)
    $db_connection = mysqli_connect($db_host,$db_username,$db_password) or die;

    // select active database
    mysqli_select_db($db_connection,$db_name);
?>