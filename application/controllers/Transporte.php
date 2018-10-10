<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transporte extends CI_Controller {

	

    public function requisitar_transporte(){
        $this->load->model('Transportes_model');
        $dados['transportes'] = $this->Transportes_model->get();
        $dados['message_error'] = '';
        $this->load->view('calendar', $dados);
    }


    public function cria_transporte(){
        $this->load->model('Transportes_model');

        $data_saida = $this->input->post('dia').' '.$this->input->post('saida');
        $data_chegada = $this->input->post('dia').' '.$this->input->post('chegada');
        $doc_req = $this->input->post('doc');
        $nome_req = $this->input->post('nome');
        $motorista = $this->input->post('motorista');
        $veiculo = $this->input ->post('veiculo');


        $dados = array(
            "doc_requisitante" => $doc_req,
            "data_transporte_saida" => $data_saida,
            "data_transporte_chegada" => $data_chegada,
            "carro_transporte" => $veiculo,
            "motorista_transporte" => $motorista
        );

        if($this->Transportes_model->add('transporte', $dados)){
            $data['message_error'] = '<div class="alert alert-success alert-dismissible show" role="alert">
            Transporte cadastrado com sucesso no BD!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
            $this->load->view('calendar', $data);
        }
        else
        {
            $data['message_error'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Falha ao cadastro Transporte no BD!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
            $this->load->view('calendar', $data);
        }
    }

    public function verifica_disponibilidade_veiculo(){

        $date = $this->input->post('data');
        $this->load->model('Transportes_model');
        $this->load->model('Veiculos_model');
        $veiculos = $this->Veiculos_model->get();
        $disponivel = $this->Transportes_model->verifica($date);
        $vec_dp = $this->Transportes_model->verificaVeiculos($veiculos, $date);
        if(count($vec_dp) == 0){
            $json = array('result' => false, 'message' => 'Não existem veículos disponíveis nesta data!');
            echo json_encode($json);
        }else{
            $json = array('result' => true, 'message' => '', 'veiculos' => $vec_dp);
            echo json_encode($json);
        }

        
    }

    public function verifica_disponibilidade_motorista(){

        $date = $this->input->post('data');
        $this->load->model('Transportes_model');
        $this->load->model('Motoristas_model');
        $motoristas = $this->Motoristas_model->get();
        $disponivel = $this->Transportes_model->verifica($date);
        $mot_dp = $this->Transportes_model->verificaMotoristas($motoristas, $date);
        if(count($mot_dp) == 0){
            $json = array('result' => false, 'message' => 'Não existem motoristas disponíveis nesta data!');
            echo json_encode($json);
        }else{
            $json = array('result' => true, 'message' => '', 'motoristas' => $mot_dp);
            echo json_encode($json);
        }

        
    }
}


?>


