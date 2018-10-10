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

    function verificaVeiculos($veiculos, $date){
        $query = $this->db->query(" SELECT * FROM transporte WHERE CAST(data_transporte_chegada AS DATE) = '{$date}'");
        foreach($query->result() as $result){
            unset($veiculos[($result->carro_transporte)-1]);
        }
        return $veiculos;
    }

    function verificaMotoristas($motoristas, $date){
        $query = $this->db->query(" SELECT * FROM `transporte` WHERE data_transporte_chegada >= DATE_SUB('{$date}', INTERVAL 8 HOUR);");
        foreach($query->result() as $result){
            unset($motoristas[($result->motorista_transporte)-1]);
        }
        return $motoristas;
    }




}