<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

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
        $this->load->model('Usuarios_model');
        $dados['usuarios'] = $this->Usuarios_model->get();
        $this->load->view('usuario/listar_usuario', $dados);
    }
    
    public function cadastro_usuario(){
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        $this->load->model('Usuarios_model');
        $data['setores'] = $this->Usuarios_model->getSetores();
        $this->load->view('usuario/criar_usuario', $data);
    }

    public function cria_usuario()
    {
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        $this->load->model('Usuarios_model');
        $data['setores'] = $this->Usuarios_model->getSetores();
        $this->load->library('form_validation');
		$regras = array(
			array(
				'field' => 'login',
				'label' => 'Login',
				'rules' => 'required'
			),
			array(
				'field' => 'senha',
				'label' => 'Senha',
				'rules' => 'required'
			)
        );


        $this->form_validation->set_rules($regras);

		if($this->form_validation->run() == false)
		{
            $data['message_error'] = validation_errors('<span class="error">', '</span>');
            
            $this->load->view('Usuario/criar_usuario', $data);
            
        }
        else
        {
            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt'));
            $dados = array(
				"login_usuario" => $this->input->post('login'),
				"senha_usuario" => $this->encryption->encrypt($this->input->post('senha')),
				"setor_usuario" => $this->input->post('setor')
            );
            
            if($this->Usuarios_model->add('usuario', $dados)){
                $data['message_error'] = '<div class="alert alert-success alert-dismissible show" role="alert">
                Usuario cadastrado com sucesso no BD!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
                $this->load->view('Usuario/criar_usuario', $data);
            }
            else
            {
                $data['message_error'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Falha ao cadastro Usuario no BD!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
              $this->load->view('Usuario/criar_usuario', $data);
            }
        }


    }


    public function editar_usuario(){
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        if(($this->uri->segment(3)) && is_numeric($this->uri->segment(3)))
		{
			$id = $this->uri->segment(3);
            $this->load->model('Usuarios_model');
			$dados['setores'] = $this->Usuarios_model->getSetores();
			$usuario = $this->Usuarios_model->getUsuario($id, true);
			if($usuario)
			{
				$dados['usuario'] = $usuario;
                $dados['message_error'] = '';
                $this->load->view('Usuario/editar_usuario', $dados);
			}
		}

    }

    public function atualizar_usuario()
    {
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        $this->load->model('Usuarios_model');
        $data['setores'] = $this->Usuarios_model->getSetores();
        $this->load->library('form_validation');
		$regras = array(
			array(
				'field' => 'login',
				'label' => 'Login',
				'rules' => 'required'
			),
			array(
				'field' => 'senha',
				'label' => 'Senha',
				'rules' => 'required'
			)
        );


        $this->form_validation->set_rules($regras);

		if($this->form_validation->run() == false)
		{
            $data['message_error'] = validation_errors('<span class="error">', '</span>');
            
            $this->load->view('Usuario/criar_usuario', $data);
            
        }
        else
        {
            $usuario = array( 
                "id_usuario" => $this->input->post('id'),
                "login_usuario" => $this->input->post('login'),
                "senha_usuario" => $this->input->post('senha'),
				"setor_usuario" => $this->input->post('setor')
            );
            $this->Usuarios_model->update($usuario);

            redirect('Usuario');
        }

    }


    public function excluir_usuario()
    {
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        if(($this->uri->segment(3)) && is_numeric($this->uri->segment(3)))
		{
			$id = $this->uri->segment(3);
            $this->load->model('Usuarios_model');
            $this->Usuarios_model->excluir($id);
            redirect('Usuario');
			
		}
    }



}

?>