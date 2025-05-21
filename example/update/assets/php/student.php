<?php
$sID = $_POST["sID"] ?? "";
if(!$sID){
    echo "請輸入學號";
    exit;
}

require "db.php";
$conn = connect();
if(!$conn){
    echo "連線失敗";
    exit;
}

$query = 'SELECT s.id, s.name FROM student AS s WHERE s.id = "'.$sID.'"';
try{
    $stmt = $conn->query($query);

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    if(count($result) == 0){
        echo "<h2>查無此資料。請確認學號是否正確。</h2>";
        exit;
    }else{
        echo '<h1>資料庫操作系統</h1>';
        echo "<h2>學生</h2><table border='1'>";
        $first = true;
        foreach($result as $row){
            if($first){
                echo "<tr>";
                foreach($row as $col => $_) echo "<th>$col</th>";
                echo "</tr>";
                $first = false;
            }
            echo "<tr>";
            foreach($row as $val) echo "<td>".htmlspecialchars($val)."</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo '<h2>修改學生</h2>
        <h3>輸入姓名</h3>
        <form action="update.php" method="POST">
            <input type="hidden" name="sID" value="'.$sID.'" />
            <input type="text" name="sName" required />
            <button type="submit">提交</button>
        </form>';
        exit;
    }
}catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}
?>