<?php
session_start();

require_once("vendor/autoload.php");


use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    "driver" => _driver_,
    "host" => _Host_,
    "database" => _DB_,
    "username" => _User_,
    "password" => _PASS_
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

//queries:

require_once("Model/DbClass.php");
$obj = new DbClass();
$index = (isset($_GET["index"]) && is_numeric($_GET["index"]) && $_GET["index"]>0) ? (int)$_GET["index"] : 0;
$resulted_data = $obj->get_data($index);
$resulted_record = $obj->get_record_by_id($index);

$next_index = $index + _RECORDS_PER_PAGE_;
$next_link = "http://localhost/ITI/PHP/day4/index.php?index=$next_index";
$prev_index = (($index - _RECORDS_PER_PAGE_) >= 0) ? ($index - _RECORDS_PER_PAGE_) : 0;
$prev_link= "http://localhost/ITI/PHP/day4/index.php?index=$prev_index";

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $item = Capsule::table('items')->find($id);
    require_once("views/details.php");
}
else
{
    require_once("views/table.php");
}

//require_once("views/items.php");

