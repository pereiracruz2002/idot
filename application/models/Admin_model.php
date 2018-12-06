<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends My_Model
{
    var $id_col = 'admin_id';
    var $fields = array(   
        'login' => array(
            'type' => 'text',
            'label' => 'Login',
            'class' => '',
            'rules' => 'required|callback_uniqlogin',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
        ),
        'senha' => array(
            'type' => 'password',
            'label' => 'Senha',
            'class' => '',
            'rules' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
        ),

    );


    public function __construct() 
    {
        parent::__construct();
    }

    public function login($login, $senha) 
    {
        $where['login'] = $login;
        $cadastro = $this->get_where($where)->row();
        if($cadastro){
            $this->load->library('encrypt');
            if(password_verify($senha,$cadastro->senha)){
                unset($cadastro->senha);
                $this->session->set_userdata('operador', $cadastro);
                $this->session->unset_userdata('cliente');
                $this->update(array('last_login' => date('Y-m-d H:i:s')), $cadastro->admin_id);
                return true;
            }
        }
        return false;
    }

}
