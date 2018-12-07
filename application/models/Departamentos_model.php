<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Departamentos_model extends My_Model
{
    var $id_col = 'departamento_id';
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
        'tipo_trabalho' => array(
            'type' => 'select',
            'label' => 'Cálculo de horas',
            'class' => '',
            'rules' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array(
                'banco_horas' => 'Banco de Horas', 
                'horas_extras' => 'Horas Extras',
                'ambas' => 'Banco de Horas e Horas Extras',
                '' => 'Sem Cálculo de Horas'
            )
        ),
        'limite_bh' => array(
            'type' => 'text',
            'label' => 'Limite Meses Banco de Horas',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'value'=> 0
        ),
        'contar_pausa' => array(
            'type' => 'select',
            'label' => 'Contar Pausa?',
            'class' => '',
            'rules' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array('Não', 'Sim' )
        ),
        'exibir_horas' => array(
            'type' => 'select',
            'label' => 'Exibir Horas Acumuladas?',
            'class' => '',
            'rules' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array('Não', 'Sim')
        ),
        'debitar_saldo_horas' => array(
            'type' => 'select',
            'label' => 'Debitar Saldo de Horas?',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array(
                '1' => 'Sim',
                '0' => 'Não'
            )
        ),
        'contar_falta' => array(
            'type' => 'select',
            'label' => 'Contabilizar Falta?',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array(
                '1' => 'Sim',
                '0' => 'Não'
            )
        ),
        'bcc' => array(
            'type' => 'select',
            'label' => 'Receber Cópia dos Registros de Ponto?',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array('1' => 'Sim', '0' => 'Não')
        ),
        'ssid' => array(
            'type' => 'text',
            'label' => 'Rede Wifi Obrigatória',
            'class' => '',
            'rules' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
			'extra' => array('placeholder' => 'Liberado para todos (Wifi / Dados Móveis)')
        ),
        
        'inicio_fechamento' => array(
            'type' => 'select',
            'label' => 'Dia do fechamento',
            'class' => '',
            'rules' => '',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array()
        ),
        
    );
    
    public function _filter_pre_save(&$data) 
    {
        $data['empresa_id'] = $this->session->userdata('admin')->empresa_id;
    }
}
