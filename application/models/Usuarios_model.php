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
        $this->db->join('privilegio', 'usuario.priv_usuario = privilegio.id_privilegio');
        $this->db->join('setor', 'usuario.setor_usuario = setor.id_setor');
        $this->db->order_by('id_usuario','ASC');

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

    function getUsuario($id, $one=false){
        $this->db->from('usuario');
        $this->db->join('privilegio', 'usuario.priv_usuario = privilegio.id_privilegio');
        $this->db->join('setor', 'usuario.setor_usuario = setor.id_setor');
        $this->db->where('id_usuario', $id);
        $this->db->order_by('id_usuario','ASC');


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function update($usuario)
    {
        $this->db->replace('usuario', $usuario);
    }

    function excluir($id)
    {
        $this->db->delete('usuario', array('id_usuario' => $id));
    }
}