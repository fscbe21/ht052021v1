<?php
/*AG040321 - INITIAL CREATION */
class Empgroup_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'empgroup';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $empgroup_table = $this->db->dbprefix('empgroup');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $empgroup_table.id=$id";
        }

        $sql = "SELECT $empgroup_table.*
        FROM $empgroup_table
        WHERE $empgroup_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
