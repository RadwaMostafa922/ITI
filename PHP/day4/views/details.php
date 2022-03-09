<?php
    $image = explode(".",$item->Photo);
    $image = $image[0]."tz".".png";
    echo "<table border='1'>";
        echo "<tr>";
            echo "<td>"."type: ".$item->product_name."</td>";
            echo "<td>"."price: ".$item->list_price."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>"."<b>Details:</b><br>Code : ".$item->PRODUCT_code."<br>Item ID : ".$item->id."<br>Rating : ".$item->Rating."</td>";
        echo "<td><img src ='images/".$image."'></td>";
        echo "</tr>";
    echo "</table>";
?>
