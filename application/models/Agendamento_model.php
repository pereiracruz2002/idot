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
            'label' => 'Descrição',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-6">',
            'append' => '</div>',
        ),

        'professor_id' => array(
            'type' => 'select',
            'label' => 'Status',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array('ativo' => 'Ativo', 'inativo' => 'Inativo')
        ),
        'curso_id' => array(
            'type' => 'select',
            'label' => 'Cursos',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array('ativo' => 'Ativo', 'inativo' => 'Inativo')
        ),
        'modulo_id' => array(
            'type' => 'select',
            'label' => 'Módulos',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array('ativo' => 'Ativo', 'inativo' => 'Inativo')
        ),
        'sala_id' => array(
            'type' => 'select',
            'label' => 'Salas',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array('ativo' => 'Ativo', 'inativo' => 'Inativo')
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
            'from' => array('model' => 'salas', 'value' => 'titulo', 'where' => array('status' => 'ativo'))
        ),    
    );
}
