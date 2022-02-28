<?php

class Counter
{
    public static function getcount()
    {
        if(file_exists(FILE_PATH)) {
            $number = file_get_contents("counter.txt");
            return intval($number);
        }
        return 0;
    }
    public static function addVisit(){
        $count =self::getcount();
        $fp = fopen("counter.txt", "w+");
        $count = $count + 1;
        fwrite($fp, $count);
        fclose($fp);
    }
}
