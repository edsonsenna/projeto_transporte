<?php
class Motoristas_model extends CI_Model {

    
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
        $this->db->from('motorista');


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getMotorista($id, $one=false){
        $this->db->from('motorista');
        $this->db->where('id_motorista', $id);


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function update($motorista)
    {
        $this->db->replace('motorista', $motorista);
    }

    function excluir($id)
    {
        $this->db->delete('motorista', array('id_motorista' => $id));
    }




}