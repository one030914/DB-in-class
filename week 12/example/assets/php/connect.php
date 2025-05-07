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

$query = 'SELECT s.id, s.name AS "學生姓名", c.name AS "課程名稱", c.credits FROM grade AS g, student AS s, course AS c WHERE s.id = g.s_id AND c.id = g.c_id AND s.id = "'.$sID.'"';
try{
    $stmt = $conn->query($query);

    echo "<h1>查詢結果</h1><table border='1'>";
    $first = true;
    $found = false;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($first){
            echo "<tr>";
            foreach($row as $col => $_) echo "<th>$col</th>";
            echo "</tr>";
            $first = false;
        }
        echo "<tr>";
        foreach($row as $val) echo "<td>".htmlspecialchars($val)."</td>";
        echo "</tr>";
        $found = true;
    }
    if(!$found){
        echo "<tr><td colspan='4'>查無資料</td></tr>";
    }
    echo "</table>";
}catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}
?>

<!-- <h1>資料庫查詢</h1>
<form action="query.php" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($dbname) ?>">
    <textarea name="query" rows="5" cols="60"></textarea>
    <button type="submit">執行</button>
</form> -->