<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Admin extends BaseCrud
{
    var $modelname = 'admin';
    var $base_url = 'admin/admin';
    var $actions = 'CRUD';
    var $titulo = 'Administradores';
    var $tabela = 'login';
    var $campos_busca = 'login';

    public function __construct() 
    {

        parent::__construct();

        $this->data['menu'] = 'administradores';
    }

    public function uniqlogin($login) 
    {
        $where['login'] = $login;
        if($this->uri->segment(3) == 'editar'){
            $where['admin_id !='] = $this->uri->segment(4);
        }
        $cadastro = $this->model->get_where($where)->row();
        if($cadastro){
            $this->form_validation->set_message('uniqlogin', 'Esse login já está em uso');
            return false;
        } else {
            return true;
        }
    }

    public function _filter_pre_form(&$data) 
    {
        if($this->uri->segment(3) == 'editar'){
            $data[0]['values']['senha'] = $this->encrypt->decode($data[0]['values']['senha']);
        }
    }
}
