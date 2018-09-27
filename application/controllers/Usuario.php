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
        $this->load->model('Users_model');
        $dados['usuarios'] = $this->Users_model->get();
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

}

?>