<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Motorista extends CI_Controller {

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
        $this->load->model('Motoristas_model');
        $dados['motoristas'] = $this->Motoristas_model->get();
        $this->load->view('motorista/listar_motorista', $dados);
    }
    

    public function cria_motorista()
    {
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        $this->load->model('Veiculos_model');
        $data['categorias'] = $this->Veiculos_model->getCategorias();
        $this->load->library('form_validation');
		$this->load->model('Motoristas_model');
		$regras = array(
			array(
				'field' => 'nome',
				'label' => 'Nome',
				'rules' => 'required'
			),
			array(
				'field' => 'num_doc',
				'label' => 'Numero do Documento',
				'rules' => 'required'
			),
			array(
				'field' => 'tel',
				'label' => 'Telefone',
				'rules' => 'required'
            ),
            array(
				'field' => 'cat_doc',
				'label' => 'Categoria',
				'rules' => 'required'
            )
			
        );


        $this->form_validation->set_rules($regras);

		if($this->form_validation->run() == FALSE)
		{
            $data['message_error'] = validation_errors('<span class="error">', '</span>');
            
            $this->load->view('motorista/create_motorista', $data);
            
        }
        else
        {
            $dados = array(
				"nome_motorista" => $this->input->post('nome'),
				"documento_motorista" => $this->input->post('num_doc'),
				"cat_motorista" => $this->input->post('cat_doc'),
				"tel_motorista" => $this->input->post('tel'),
            );
            
            if($this->Motoristas_model->add('motorista', $dados)){
                $data['message_error'] = '<div class="alert alert-success alert-dismissible show" role="alert">
                Motorista cadastrado com sucesso no BD!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
                $this->load->view('motorista/create_motorista', $data);
            }
            else
            {
                $data['message_error'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Falha ao cadastro Motorista no BD!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
                $this->load->view('motorista/create_motorista', $data);
            }
        }


    }


    public function criar_motorista()
    {
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        $this->load->model('Veiculos_model');
        $dados['categorias'] = $this->Veiculos_model->getCategorias();
        $this->load->view('motorista/create_motorista', $dados);
    }

    public function editar_motorista()
    {
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        if(($this->uri->segment(3)) && is_numeric($this->uri->segment(3)))
		{
			$id = $this->uri->segment(3);
            $this->load->model('Motoristas_model');
            $this->load->model('Veiculos_model');
			$dados['categorias'] = $this->Veiculos_model->getCategorias();
			$motorista = $this->Motoristas_model->getMotorista($id, true);
			if($motorista)
			{
				$dados['motorista'] = $motorista;
				$dados['message_error'] = '';
                $this->load->view('Motorista/editar_motorista', $dados);
			}
		}
    }

    public function atualizar_motorista()
    {
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        $this->load->model('Veiculos_model');
        $data['categorias'] = $this->Veiculos_model->getCategorias();
        $this->load->library('form_validation');
		$this->load->model('Motoristas_model');
		$regras = array(
			array(
				'field' => 'nome',
				'label' => 'Nome',
				'rules' => 'required'
			),
			array(
				'field' => 'num_doc',
				'label' => 'Numero do Documento',
				'rules' => 'required'
			),
			array(
				'field' => 'tel',
				'label' => 'Telefone',
				'rules' => 'required'
            ),
            array(
				'field' => 'cat_doc',
				'label' => 'Categoria',
				'rules' => 'required'
            )
			
        );


        $this->form_validation->set_rules($regras);

		if($this->form_validation->run() == FALSE)
		{
            $data['message_error'] = validation_errors('<span class="error">', '</span>');
            
            $this->load->view('motorista/create_motorista', $data);
            
        }
        else
        {
            $motorista = array(
                "id_motorista" => $this->input->post('id'),
				"nome_motorista" => $this->input->post('nome'),
				"documento_motorista" => $this->input->post('num_doc'),
				"cat_motorista" => $this->input->post('cat_doc'),
				"tel_motorista" => $this->input->post('tel'),
            );

            $this->Motoristas_model->update($motorista);

            redirect('Motorista');
            
           
        }
    }

    public function excluir_motorista()
    {
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        if(($this->uri->segment(3)) && is_numeric($this->uri->segment(3)))
		{
			$id = $this->uri->segment(3);
            $this->load->model('Motoristas_model');
            $this->Motoristas_model->excluir($id);
            redirect('Motorista');
			
		}
    }

}

?>