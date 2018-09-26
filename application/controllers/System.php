<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System extends CI_Controller {

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
		$this->load->view('index');
    }
    
    public function login()
    {
        
        
        $this->load->view('login');

    }

    public function verifica_login()
    {
        header('Access-Control-Allow-Origin: '.base_url());
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type');
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('login','Login','required|trim');
        $this->form_validation->set_rules('senha','Senha','required|trim');
        if ($this->form_validation->run() == false) {
            $json = array('result' => false, 'message' => validation_errors());
            echo json_encode($json);
        }
        else {
            $login = $this->input->post('login');
            $password = $this->input->post('senha');
            $this->load->model('users_model');
            $user = $this->users_model->check_credentials($login);

            if($user){

                $this->load->library('encryption');
                $this->encryption->initialize(array('driver' => 'mcrypt'));
                $password_stored =  $this->encryption->decrypt($user->senha_usuario);

                if($password == $password_stored){
                    $session_data = array('nome' => $user->login_usuario, 'id' => $user->id_usuario,'permissao' => $user->priv_usuario , 'logado' => TRUE);
                    $this->session->set_userdata($session_data);
					$json = array('result' => true);
					$data = array();
					$data['message_success'] = $json;
					echo json_encode($json);
					//$this->load->view('admin/home', $data);
                }
                else{
                    $json = array('result' => false, 'message' => 'Os dados de acesso estão incorretos. u:'.$user->login_usuario.' l: '.$login.' p:'.$password. ' ps:' .$password_stored);
                    echo json_encode($json);
                }
            }
            else{
                $json = array('result' => false, 'message' => 'Usuário não encontrado, verifique se suas credenciais estão corretass.');
                echo json_encode($json);
            }
        }
        die();
    }

    public function cadastro_usuario(){
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        $this->load->view('servidor/create_servidor');
    }
    
    public function listar_usuarios(){
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        $this->load->model('Users_model');
        $dados['usuarios'] = $this->Users_model->get();
        $this->load->view('servidor/listar_servidor', $dados);
    }

    public function requisitar_transporte(){
        $this->load->model('Transportes_model');
        $dados['transportes'] = $this->Transportes_model->get();
        $dados['message_error'] = '';
        $this->load->view('calendar', $dados);
    }



    public function requisitar_viagem(){
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        $dados['message_error'] = '';
        //$this->load->view('viagem/requisitar_viagem');
        $this->load->view('viagem/teste_requisitar_viagem', $dados);
    }

    public function listar_veiculos(){
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


    public function listar_motoristas()
    {
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        $this->load->model('Motoristas_model');
        $dados['motoristas'] = $this->Motoristas_model->get();
        $this->load->view('motorista/listar_motorista', $dados);
    }


    public function gerar_relatorio()
    {
        if((!session_id() === "") || (!$this->session->userdata('logado'))){
            redirect('System/login');
        }
        $this->load->view('relatorio/gerar_relatorio');
    }







    public function testePDF(){

        $nome = $this->input->post('nome');
        $data = $this->input->post('data');
        $carro = $this->input->post('veiculo');
       
        $this->load->library('Pdf');
    



        // create new PDF document
            $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Nicola Asuni');
            $pdf->SetTitle('TCPDF Example 021');
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

            // set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 021', PDF_HEADER_STRING);

            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set font
            $pdf->SetFont('helvetica', '', 9);

            // add a page
            $pdf->AddPage();

            // create some HTML content
            $html = '<h1>Requisição de Viagem</h1><p>O usuário '. $nome .' requisita viagem para a data: '. $data.' com o carro: '. $carro .'</p>';

            // output the HTML content
            $pdf->writeHTML($html, true, 0, true, 0);

            // reset pointer to the last page
            $pdf->lastPage();

            // ---------------------------------------------------------

            //Close and output PDF document
            $pdf->Output('example_021.pdf', 'I');

    }
    
    public function sair(){
		$this->session->sess_destroy();
        redirect('System');
	}
}

?>