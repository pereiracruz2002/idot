<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Painel extends CI_Controller
{
    var $data = array();

    public function __construct() 
    {
        parent::__construct();
    }

    public function index() 
    {
        $this->load->model('avisos_model','avisos');
        $where['tipo'] = $this->session->userdata('admin')->tipo;
        $where['visualizado'] ='nao';
        if($where['tipo']=="admin"){
            $where['id'] = $this->session->userdata('admin')->admin_id;
        }elseif($where['tipo']=="professor"){
            $where['id'] = $this->session->userdata('admin')->id_professor;
        }else{
            $where['id'] = $this->session->userdata('admin')->alunos_id;
        }
		$notificacoes = $this->avisos->get_where($where)->result();
        if($notificacoes){
            $this->data['notificacoes'] = $notificacoes;
        }
		$this->load->view('admin/painel', $this->data);
    }
}
