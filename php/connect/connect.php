<?php
     $host = "localhost";
     $user = "jmj9703";
     $pw = "wjsalswn11!";
     $dbName = "jmj9703";
     $dbConnect = new mysqli($host, $user, $pw, $dbName);
     $dbConnect -> set_charset("utf8");
     if(mysqli_connect_errno()){
        echo "database connect false";
     } else {
        //echo "database connect true";
     }
?>