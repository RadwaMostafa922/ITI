<?php
echo "<table border='1'>";
    $record_index = 0;
    foreach ($resulted_data as $item){
        if($record_index === 0)
        {
            echo "<tr>";
            echo "<td>Item ID</td>";
            echo "<td>Name</td>";
            echo "</tr>";
        }
        echo "<tr>";
        echo "<td>".$item->id."</td>";
        echo "<td>".$item->product_name."</td>";
        echo "</tr>";
        $record_index ++;
    }
echo "</table>";

echo "=======================";
