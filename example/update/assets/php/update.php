<?php
$sID = $_POST["sID"] ?? "";
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

$update = 'UPDATE student SET name = "'.$sName.'" WHERE id = "'.$sID.'"';
try{
    $stmt = $conn->prepare($update);
    $stmt->execute();
    if($stmt->rowCount() > 0){
        echo "<h2>{學號：".$sID.", 姓名：".$sName."} 更新成功</h2>";
        exit;
    }else{
        echo "<h2>{學號：".$sID.", 姓名：".$sName."} 更新失敗</h2>";
        exit;
    }
    
}catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}
?>