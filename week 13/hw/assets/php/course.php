<?php
$cID = $_POST['cID'];
if(!$cID){
    echo "請輸入課程代碼。";
    exit;
}
$cName = $_POST['cName'];
if(!$cName){
    echo "請輸入課程名稱。";
    exit;
}
$credit = $_POST['credit'];
if(!$credit){
    echo "請輸入學分數。";
    exit;
}

require "db.php";

$conn = connect();
if(!$conn){
    echo "連線失敗";
    exit;
}

$query = 'SELECT c.id FROM course AS c WHERE c.id = "'.$cID.'"';
$insert = 'INSERT INTO course(id, name, credits) VALUES ("'.$cID.'", "'.$cName.'", "'.$credit.'")';
try{
    $stmt = $conn->query($query);

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    if(count($result) == 0){
        $conn->exec($insert);
        echo "{課程代碼：".$cID.", 名稱：".$cName.", 學分數：".$credit."}已建立資料~";
        exit;
    }else{
        echo "本筆資料已建立，無法再輸入資料~";
        exit;
    }
}catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}
?>