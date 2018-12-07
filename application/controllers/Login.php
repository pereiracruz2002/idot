<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller
{
    var $data = array();
    public function index() 
    {
        
        $this->load->model('admin_model','admin');
        if($this->input->posts()){
            $senha = password_hash('senha', PASSWORD_DEFAULT);
            if($this->admin->login($this->input->post('login'), $this->input->post('senha'))) {
                redirect('admin/painel');
            } else {
                $this->data['msg'] = 'Login incorreto';
            }
        }
        $this->load->view('painel/login', $this->data);
    }

    public function sair() 
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
