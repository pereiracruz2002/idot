<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Avisos extends BaseCrud
{
    var $modelname = 'avisos';
    var $base_url = 'admin/avisos';
    var $actions = 'R';
    var $titulo = 'Avisos';
    var $tabela = 'mensagem,visualizado,data';
    var $campos_busca = 'data';
    var $acoes_extras = array(array('url'=>'admin/avisos/marcar_lida','title'=>'Marcar como lida','class'=>'btn btn-xs btn-info btn btn-warning'));

    // var $joins = array(
    //      'alunos' => 'alunos.alunos_id=avisos.id'
    // );
    // var $selects = 'avisos.mensagem,avisos.visualizado,avisos.data,alunos.nome as remetente';


    public function __construct() 
    {

        parent::__construct();
        //verify_permiss_redirect('departamentos');
        $this->data['menu_active'] = 'avisos';
    }

    public function _filter_pre_listar(&$where, &$where_ativo)
    {
        $where['tipo'] = 'admin';


        // $this->model->fields['remetente'] = array(
        //   'label' => 'Remetente',
        //   'type' => 'text',
        //   'class' => '',
        // );
    }


    

    public function _filter_pre_read(&$data) 
    {

       

    }


}
