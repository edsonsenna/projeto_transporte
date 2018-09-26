<?php
class Transportes_model extends CI_Model {

    
    function __construct() {
        parent::__construct();
    }

    function add($table,$data){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;       
    }

    function get($one=false){
        $this->db->from('transporte');


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function verifica($date, $one=false){
        $query = $this->db->query(" SELECT * FROM transporte WHERE CAST(data_transporte_chegada AS DATE) = '{$date}'");
        return $query->num_rows() >= 1 ? true : false;
    }




}