<?php
$sID = $_POST["sID"] ?? "";
if(!$sID){
    echo "請輸入學號";
    exit;
}
$sName = $_POST["sName"] ?? "";
if(!$sName){
    echo "請輸入姓名";
    exit;
}
require "db.php";

$conn = connect();
if(!$conn){
    echo "連線失敗";
    exit;
}

$query = 'SELECT s.id FROM student AS s WHERE s.id = "'.$sID.'"';
$insert = 'INSERT INTO student(id, name) VALUES ("'.$sID.'", "'.$sName.'")';
try{
    $stmt = $conn->query($query);

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    if(count($result) == 0){
        $conn->exec($insert);
        echo "本資料已新增完成。";
        exit;
    }else{
        echo "本資料已建立完成。";
        exit;
    }
}catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}
?>