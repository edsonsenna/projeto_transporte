<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Veiculo extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        $this->load->model('Veiculos_model');
        $dados['veiculos'] = $this->Veiculos_model->get();
        $this->load->view('veiculo/listar_veiculos', $dados);
    }

    public function cadastrar_veiculo(){
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        $this->load->model('Veiculos_model');
        $dados['categorias'] = $this->Veiculos_model->getCategorias();
        $dados['message_error'] = '';
        $this->load->view('veiculo/create_veiculo', $dados);
    }

    public function cadastro_veiculo(){
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        $this->load->library('form_validation');
		$this->load->model('Veiculos_model');
		$regras = array(
			array(
				'field' => 'modelo',
				'label' => 'Modelo',
				'rules' => 'required'
			),
			array(
				'field' => 'fabricante',
				'label' => 'Fabricante',
				'rules' => 'required'
			),
			array(
				'field' => 'ano',
				'label' => 'Ano',
				'rules' => 'required|number'
            ),
            array(
				'field' => 'num_pass',
				'label' => 'Número de Passageiros',
				'rules' => 'required|number'
            ),
            array(
				'field' => 'categoria',
				'label' => 'Categoria',
				'rules' => 'required|number'
			)
			
        );
        
        $this->form_validation->set_rules($regras);

		if($this->form_validation->run() == FALSE)
		{
            $data['message_error'] = validation_errors('<span class="error">', '</span>');

			$this->load->view('veiculo/create_veiculo', $data);
        }
        else
        {
            $dados = array(
				"nome_veiculo" => $this->input->post('modelo'),
				"marca_veiculo" => $this->input->post('fabricante'),
				"placa_veiculo" => $this->input->post('placa'),
				"cat_veiculo" => $this->input->post('categoria'),
				"qtd_pas_veiculo" => $this->input->post('num_pass')
            );
            
            if($this->Veiculos_model->add('veiculos', $dados)){
                $data['message_error'] = '<span class="error"> Veículos cadastrado com sucesso! </span>';
                redirect('System/cadastrar_veiculo', $data);
            }
            else
            {
                $data['message_error'] = '<span class="error"> Falha ao cadastrar veículo no BD! </span>';
                redirect('System/cadastrar_veiculo', $data);
            }
        }
    }


    public function verifica_disponibilidade(){

        $date = $this->input->post('data');
        $this->load->model('Transportes_model');
        $disponivel = $this->Transportes_model->verifica($date);
        
        if($disponivel == true){
            $json = array('result' => true, 'message' => 'Já existe viagem neste dia!');
            echo json_encode($json);
        }else{
            $json = array('result' => false, 'message' => $date . $disponivel);
            echo json_encode($json);
        }

        
    }
}

?>