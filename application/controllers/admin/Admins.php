<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Admins extends BaseCrud 
{
    var $modelname = 'admin';
    var $base_url = 'admin/admins';
    var $actions = 'CRUD';
    var $titulo = 'Administradores';
    var $tabela = 'login';
    var $campos_busca = 'login';

    public function _filter_pre_save(&$data) 
    {
        if($data['senha']){
             $data['senha'] = md5($data['senha']);
            //$data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
        } else {
            unset($data['senha']);
        }
    }
    public function _filter_pre_form(&$data) {
        if($this->uri->segment(3) == 'editar'){
            $data[0]['values']['senha'] = '';
        }
    }

    public function uniqlogin() 
    {
        $where = array(
            'login' => $this->input->post('login'),
        );
        if($this->uri->segment(3) == 'editar'){
            $where['admin_id !='] = $this->uri->segment(4);
        }
        $admin = $this->model->get_where($where)->row();
        if($admin){
            $this->form_validation->set_message('uniqlogin', 'Esse login já existe');
            return false;
        } else {
            return true;
        }
    }

    public function _filter_pos_save($data, $id) 
    {
        redirect('admin/admins');

    }
}
