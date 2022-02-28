<?php
//open session and loading the composer
session_start();
require_once("vendor/autoload.php");

if (!isset($_SESSION["is_visited"])){
    $_SESSION["is_visited"] = true;
    Counter::addVisit();
}

//output
$count = Counter::getcount();
echo "Counted unique visitors : ".$count;

