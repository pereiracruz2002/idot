<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Agendamento_model extends My_Model
{
	var $id_col = 'agenda_id';
    var $fields = array(   

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

        'modulo_id' => array(
            'type' => 'select',
            'label' => 'Módulos/Encontros',
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


        'data' => array(
            'type' => 'date',
            'label' => 'Data do Curso',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
        ),

        'data_segunda' => array(
            'type' => 'date',
            'label' => '',
            'class' => '',
            'rules' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
        ),

        'data_terceira' => array(
            'type' => 'date',
            'label' => '',
            'class' => '',
            'rules' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
        ),


        'dias_semana' => array(
            'type' => 'check',
            'label' => '',
            'class' => '',
            'rules' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-9">',
            'append' => '</div>',
            'values' => array('sexta manhã'=>'Sexta Manhã','sexta tarde'=>'Sexta Tarde','sábado manhã'=>'Sábado Manhã','sábado tarde'=>'Sábado Tarde','domingo manhã'=>'Domingo Manhã'),
        ),




        // 'vagas' => array(
        //     'type' => 'text',
        //     'label' => 'Vagas',
        //     'class' => '',
        //     'rules' => 'required',
        //     'label_class' => 'col-md-2',
        //     'prepend' => '<div class="col-md-3">',
        //     'append' => '</div>',
        // ),

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
        

        'encontro_id' => array(
            'type' => 'select',
            'label' => 'Submodulo',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2 hide',
            'prepend' => '<div class="col-md-3 hide">',
            'append' => '</div>',
            'values' => array(),
            
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

        

        
        
        
    );
}
