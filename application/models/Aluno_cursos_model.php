<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Aluno_cursos_model extends My_Model
{
    var $id_col = 'aluno_cursos_id';

    var $fields= array(

    	'aluno_id' => array(
	            'type' => 'hidden',
	            'label' => 'Aluno',
	            'class' => '',
	            'rules' => 'required',
	            'label_class' => 'col-md-2',
	            'prepend' => '<div class="col-md-3">',
	            'append' => '</div>',
	        ),

	    'turma' => array(
	            'type' => 'select',
	            'label' => 'Nº da Turma',
	            'class' => '',
	            'rules' => 'required',
	            'label_class' => 'col-md-2',
	            'prepend' => '<div class="col-md-3">',
	            'append' => '</div>',
	            'values' => array()
	        ),

	        
	        // 'historico' => array(
	        //     'type' => 'select',
	        //     'label' => 'Nível',
	        //     'class' => '',
	        //     'rules' => '',
	        //     'label_class' => 'col-md-2',
	        //     'prepend' => '<div class="col-md-3">',
	        //     'append' => '</div>',
	        //     'values' => array('1' => 'Nível 1', '2' => 'Nível 2-3','4' => 'Nível 4','5' => 'Nível 5')
	        // ),

	        'curso_id' => array(
	            'type' => 'select',
	            'label' => 'Nível',
	            'class' => '',
	            'rules' => 'required',
	            'label_class' => 'col-md-2',
	            'prepend' => '<div class="col-md-3">',
	            'append' => '</div>',
	            'empty' => '--Selecine um status--',
	            'values' => array(),
        ),

        // 'submodulo_id' => array(
        //     'type' => 'select',
        //     'label' => 'Submodulo',
        //     'class' => '',
        //     'rules' => '',
        //     'label_class' => 'col-md-2 hide',
        //     'prepend' => '<div class="col-md-3 hide">',
        //     'append' => '</div>',
        //     'values' => array(),
            
        // ),

        'modulo_id' => array(
            'type' => 'select',
            'label' => 'Módulos',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array(),
        ),

        'sala_id' => array(
            'type' => 'select',
            'label' => 'Salas',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array(),
        ),

	);
}
