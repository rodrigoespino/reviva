<?php 

class Load_combos extends MY_Model {

    public function get_all_clients() {
        $this->db->select('*');
        $this->db->from('client');
        $this->db->order_by("sort_order", "ASC");
        $this->db->order_by("description", "ASC");
        $Q = $this->db->get();
 
            $return = $Q->result();
 
        $Q->free_result();
        return $return;
    }

    public function get_all_paid() {
        $this->db->select('*');
        $this->db->from('status_paid');
        $this->db->order_by("sort_order", "ASC");
        $this->db->order_by("description_paid", "ASC");
        $Q = $this->db->get();
 
            $return = $Q->result();
 
        $Q->free_result();
        return $return;
    }
    public function get_all_company() {
        $this->db->select('*');
        $this->db->from('company');
        $this->db->order_by("sort_order", "ASC");
        $this->db->order_by("name", "ASC");
        $Q = $this->db->get();
 
            $return = $Q->result();
 
        $Q->free_result();
        return $return;
    }


}