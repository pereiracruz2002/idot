<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Professor_model extends My_Model{
	var $id_col="id_professor";
	var $fields= array(
		   "nome" => array("type" => "text",
				"label" => "Nome do Professor",
				"class"=> "vObrigatorio",
				"rules" => "required|min_length[3]|max_length[45]",
				'label_class' => 'col-md-2',
				'label_class' => 'col-md-2',
            	'prepend' => '<div class="col-md-3">',
            	'append' => '</div>',
			),

           'texto' => array(
                'type' => 'textarea',
                'label' => 'Mini-Currículo',
                'class' => '',
                'extra' => array('class'=>'mytextarea'),
                'rules' => 'required',
                'label_class' => 'col-md-2',
                'prepend' => '<div class="col-md-6">',
                'append' => '</div>',
            ),

		   "email" => array("type" => "text",
				"label" => "Email",
				"class" => "",
				"rules" => "required",
				'label_class' => 'col-md-2',
            	'prepend' => '<div class="col-md-3">',
            	'append' => '</div>',
			),
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
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
        ),
        'status' => array(
            'type' => 'select',
            'label' => 'Status',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array('ativo' => 'Ativo', 'inativo' => 'Inativo')
        ),

		// "foto"=> array("type" => "file",
		// 					"label" => "Foto",
		// 					"class" => "",
		// 					"rules" => "callback_upload_foto",
		// 					),

	);

	public function login($login, $senha) 
    {
        $where['login'] = $login;
        $cadastro = $this->get_where($where)->row();
        if($cadastro){
            $this->load->library('encrypt');
            if ($cadastro->senha == md5($senha)) {
            //if(password_verify($senha,$cadastro->senha)){
                unset($cadastro->senha);
                $cadastro->tipo = 'professor';
                $this->session->set_userdata('admin', $cadastro);
                $this->session->unset_userdata('cliente');
                $this->update(array('last_login' => date('Y-m-d H:i:s')), $cadastro->id_professor);
                return true;
            }
        }
        return false;
    }
}
?>
