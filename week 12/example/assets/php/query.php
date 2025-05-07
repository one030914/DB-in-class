<?php
require "db.php";

$dbname = $_POST["id"] ?? "";
$query = $_POST["query"] ?? "";
$conn = connect($dbname);
if(!$conn){
    echo "沒有此學號的資料庫名稱";
    exit;
}

try{
    $stmt = $conn->query($query);

    echo "<h1>查詢結果</h1><table border='1'>";
    $first = true;
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
    }
    echo "</table>";
}catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}
?>