<?php 

require "./external/database.php";

$sql = "SELECT * FROM users WHERE points ASC";

    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();
    
    
    echo "<table id='myTable2' border='1'>";
    echo "<tr><th
    onclick=\"sortTable(0)\">Position</th><th
    onclick=\"sortTable(1)\">Name</th><th
    onclick=\"sortTable(2)\">Points</th></tr>";

    $i = 1;
    
    while($i<=5){

    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . $i . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["points"] . "</td>";
        echo "</tr>";
        $i = $i + 1;
    }
    
    }
    
    echo "</table>";