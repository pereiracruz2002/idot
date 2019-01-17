<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Agendamento_model extends My_Model
{
	var $id_col = 'agenda_id';
    var $fields = array(   
        'data' => array(
            'type' => 'date',
            'label' => 'Data',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
        ),

        'vagas' => array(
            'type' => 'text',
            'label' => 'Vagas',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
        ),

        'professor_id' => array(
            'type' => 'select',
            'label' => 'Professor',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array(),
        ),
        'curso_id' => array(
            'type' => 'select',
            'label' => 'Cursos',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'empty' => '--Selecine um status--',
            'values' => array(),
        ),
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

        'encontro_id' => array(
            'type' => 'select',
            'label' => 'Encontros',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2 hide',
            'prepend' => '<div class="col-md-3 hide">',
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

        'sala_id' => array(
            'type' => 'select',
            'label' => 'Salas',
            'rules' => 'required',
            'class' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array(),
            // 'from' => array('model' => 'cursos', 'value' => 'titulo', 'where' => array('status' => 'ativo'))
        ),    
    );
}
