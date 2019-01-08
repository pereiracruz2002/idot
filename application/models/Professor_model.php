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
		   "texto"=> array("type" => "text",
				"label" => "Mini-Currículo",
				'extra' => array('class'=>'mytextarea'),
				"rules" => "required",
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
}
?>
