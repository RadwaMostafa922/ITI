<?php
interface DbHandler {
    public function connect();
    public function get_data($index);
    public function disconnect();
    public function get_record_by_id($id);
}