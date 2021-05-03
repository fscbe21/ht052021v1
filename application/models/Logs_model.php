<?php

class Logs_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'logs';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $logs_table = $this->db->dbprefix('logs');
        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $logs_table.id=$id";
        }

        $time1 = get_array_value($options, "login_time");
        if ($time1) {
            $where = " AND DATE(login_time) = '$time1'";
        }

        $user_id = get_array_value($options, "user_id");
        if ($user_id != '') {
            $where = " AND $logs_table.user_id=$user_id";
        }

        $sql = "SELECT $logs_table.*
        FROM $logs_table
        WHERE $logs_table.deleted=0 $where";
        return $this->db->query($sql);
    }

    function set_logout_time($user_id, $ip, $logout_time){
        $sql = "UPDATE logs SET logout_time = '$logout_time' WHERE user_id=$user_id AND ip_address='$ip' ORDER BY id DESC LIMIT 1";

        return $this->db->query($sql);
    }

}
