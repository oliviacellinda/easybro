<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Easybro_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getDataWhere($table, $where, $select = null) {
        if($select != null) {
            $this->db->select($select);
        }
        $this->db->where($where);
        $query = $this->db->get($table);

        
    }
}