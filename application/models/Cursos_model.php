<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cursos_model extends My_Model
{
	var $id_col = 'cursos_id';
    var $fields = array(  
        'nivel' => array(
            'type' => 'select',
            'label' => 'Nível',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array('1' => 'Nível 1', '2' => 'Nível 2','3' => 'Nível 3','4' => 'Nível 4','5' => 'Nível 5')
        ), 
        'titulo' => array(
            'type' => 'text',
            'label' => 'Título',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
        ),

        'descricao' => array(
            'type' => 'text',
            'label' => 'Descrição',
            'class' => '',
            'extra' => array('class'=>'mytextarea'),
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-6">',
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
    );
}
