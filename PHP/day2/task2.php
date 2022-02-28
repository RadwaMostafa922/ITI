<?php 

    $input = file("log.txt");
    foreach($input as $key=>$value){
        $file = explode(",",$value);
        echo "Visit Date : ".$file[0]."<br>";
        echo "IP Address : ".$file[1]."<br>";
        echo "Email : ".$file[2]."<br>";
        echo "Name : ".$file[3]."<br>";
        echo "<br>==================<br>";
    }
?>