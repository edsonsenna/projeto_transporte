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
            $json = array('result' => false, 'message' => 'teste'.validation_errors());
            echo json_encode($json);
        }
        else {
            $login = $this->input->post('login');
            $password = $this->input->post('senha');
            $this->load->model('Usuarios_model');
            $user = $this->Usuarios_model->check_credentials($login);

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

    public function requisitar_viagem(){
        $dados['message_error'] = '';
        //$this->load->view('viagem/requisitar_viagem');
        redirect('System/testePDF');
        //$this->load->view('viagem/teste_requisitar_viagem', $dados);
    }

   

    public function gerar_relatorio()
    {
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
            $html = '';

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


