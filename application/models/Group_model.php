<?php 

class Group_model extends MY_Model {

    public function get_all_clients() {
        $this->db->select('*');
        $this->db->from('client');
        $this->db->order_by("name", "ASC");
        $Q = $this->db->get();
        $return = $Q->result();
  
        return $return;
    }


    public function get_all_company() {
        $this->db->select('*');
        $this->db->from('Company');
         $this->db->order_by("Name", "ASC");
        $Q = $this->db->get();
        $return = $Q->result();
  
        return $return;
    }
    public function get_all_paid() {
        $this->db->select('*');
        $this->db->from('status_paid');
         $this->db->order_by("description_paid", "ASC");
        $Q = $this->db->get();
        $return = $Q->result();
  
        return $return;
    }


    public function get_all_products() {
        $this->db->select('*');
        $this->db->from('product');
         $this->db->join('group_taxes', 'product.id_grouptax = group_taxes.id_grouptax');
 
        $Q = $this->db->get();
        $return = $Q->result();
  
        return $return;
    }
}
  