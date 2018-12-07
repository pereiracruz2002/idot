<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Nivel_model extends My_Model
{
	var $id_col = 'id_nivel';
    var $fields = array(   
        'descricao' => array(
            'type' => 'text',
            'label' => 'Descrição',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
        ),
    );
}
