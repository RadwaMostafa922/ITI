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

require_once("Model/DbHandler.php");
$obj = new DbHandler();
$index = (isset($_GET["index"]) && is_numeric($_GET["index"]) && $_GET["index"]>0) ? (int)$_GET["index"] : 0;
$resulted_data = $obj->get_data($index);
$resulted_record = $obj->get_record_by_id($index);


require_once("views/table.php");
require_once("views/items.php");


