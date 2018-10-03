<?php
    session_start();
    if(!empty($_SESSION['username'])){
        require 'data.php';
        $conn = new PDO("mysql:host=$servername; dbname=$db", $username, $password);
        $query = $conn->prepare("SELECT * FROM tbl_studentinfo");
        $tbl = $query->execute();
        
        for each ($tbl as $table){
            echo $table;
        }
    }
?>

