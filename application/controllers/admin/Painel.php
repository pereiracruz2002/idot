<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Painel extends CI_Controller
{
    var $data = array();

    public function __construct() 
    {
        parent::__construct();
        if(!$this->session->userdata('operador')){
            redirect('meu-painel-wvtodoz');
        }
    }

    public function index() 
    {
		//$this->load->model('empresas_model','empresas');
		//$this->data['empresas'] = $this->empresas->getTotalCadastros();
		$this->load->view('painel/painel', $this->data);
    }
}
