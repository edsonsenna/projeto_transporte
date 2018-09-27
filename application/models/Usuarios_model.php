<?php
class Usuarios_model extends CI_Model {

    
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
        $this->db->from('usuario');


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    public function check_credentials($login) {
        $this->db->where('login_usuario', $login);
        $this->db->limit(1);
        return $this->db->get('usuario')->row();
    }

    function getSetores($one=false){
        $this->db->from('setor');


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
}