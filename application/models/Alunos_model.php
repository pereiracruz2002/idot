<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alunos_model extends My_Model{
	var $id_col="alunos_id";
	var $fields= array(
		   "nome" => array("type" => "text",
				"label" => "Nome do Aluno",
				"class"=> "vObrigatorio",
				"rules" => "required|min_length[3]|max_length[45]",
				'label_class' => 'col-md-2',
				'prepend' => '<div class="col-md-3">',
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
		   'matricula' => array(
	            'type' => 'text',
	            'label' => 'Matrícula <br />(dd/mm/aaaa-0000)',
	            'class' => '',
	            'rules' => '',
	            'label_class' => 'col-md-2',
	            'prepend' => '<div class="col-md-3">',
	            'append' => '</div>',
                'extra'=> array('class'=>'matricula')
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

        // 'data_cadastro' => array(
        //     'type' => 'date',
        //     'label' => 'Data de Cadastro',
        //     'class' => '',
        //     'rules' => '',
        //     'label_class' => 'col-md-2',
        //     'prepend' => '<div class="col-md-3">',
        //     'append' => '</div>',
        // ),
        'endereco' => array(
            'type' => 'text',
            'label' => 'Endereço',
            'class' => '',
            'rules' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
        ),
        'cep' => array(
            'type' => 'text',
            'label' => 'CEP',
            'class' => '',
            'rules' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'extra'=> array('class'=>'cep')
        ),
        'bairro' => array(
            'type' => 'text',
            'label' => 'Bairro',
            'class' => '',
            'rules' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
        ),
        'complemento' => array(
            'type' => 'text',
            'label' => 'Complemento',
            'class' => '',
            'rules' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
        ),
        'telefone' => array(
            'type' => 'text',
            'label' => 'Telefone',
            'class' => '',
            'rules' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'extra'=> array('class'=>'telefone')
        ),
        'celular' => array(
            'type' => 'text',
            'label' => 'Celular',
            'class' => 'celular',
            'rules' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'extra'=> array('class'=>'celular')
        ),
        
        

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
                $cadastro->tipo = 'aluno';
                $this->session->set_userdata('admin', $cadastro);
                $this->session->unset_userdata('cliente');
                $this->update(array('last_login' => date('Y-m-d H:i:s')), $cadastro->alunos_id);
                return true;
            }
        }
        return false;
    }
}

?>
