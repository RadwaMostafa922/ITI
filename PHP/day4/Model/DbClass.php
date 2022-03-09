<?php
use Illuminate\Database\Capsule\Manager as Capsule;

include_once("DbHandler.php");
class DbClass implements DbHandler
{
    public function connect()
    {
        $conn =  mysqli_connect(_Host_,_User_,_PASS_);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }

    public function disconnect()
    {
        $conn = $this->connect();
        mysqli_close($conn);
    }

    public function get_record_by_id($id)
    {
        return Capsule::table("items")->where("id",$id)->get();
    }

    public function get_data($index)
    {
        return Capsule::table("items")->skip($index)->take(_RECORDS_PER_PAGE_)->get();
    }
}