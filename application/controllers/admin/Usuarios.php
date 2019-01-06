<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once(dirname(__FILE__) . '/BaseCrud.php');
class Usuarios extends BaseCrud 
{
    var $acl = "acessaAdmin";
    var $upload_data = false;
    var $modelname = 'user'; /* Nome do model sem o "_model" */
    var $base_url = 'admin/usuarios';
    var $actions = 'CRUD';
    var $titulo = 'Usuarios';
    var $tabela = 'nome,status';
    var $campos_busca = 'nome,status';
    var $order = array('nome'=>"ASC");



    public function __construct() 
    {
        $this->data['menu_active'] = 'usuarios';
        parent::__construct();
    }

    public function filter_pos_save($data, $id){
        var_dump($data);
        exit();
    }

   

}
