<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Encontros_model extends My_Model
{
	var $id_col = 'encontros_id';
    var $fields = array(  
        'modulo_id' => array(
            'type' => 'hidden',
            'label' => '',
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
            'type' => 'textarea',
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
