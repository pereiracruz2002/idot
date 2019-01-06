<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Aulas_model extends My_Model
{
	var $id_col = 'aulas_id';
    var $fields = array(   
        'titulo' => array(
            'type' => 'text',
            'label' => 'Título',
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
    );
}
