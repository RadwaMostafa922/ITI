<?php
echo "<table border='1'>";
$record_index1 = 0;
foreach ($resulted_record as $item1){
    if($record_index1 === 0)
    {
        echo "<tr>";
        echo "<td>Item ID</td>";
        echo "<td>Name</td>";
        echo "</tr>";
    }
    echo "<tr>";
    echo "<td>".$item1->id."</td>";
    echo "<td>".$item1->product_name."</td>";
    echo "</tr>";
    $record_index1 ++;
}
echo "</table>";
