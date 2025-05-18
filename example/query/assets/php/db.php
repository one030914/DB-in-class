<?php
function connect(){
    $servername = "localhost";
    $dbname = "u1224051";
    $username = "root";
    $password = "";
    $conn = null;

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }catch (PDOException $e){
        return false;
    }
}
?>