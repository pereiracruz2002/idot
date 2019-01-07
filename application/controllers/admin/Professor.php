<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Professor extends BaseCrud {


    var $modelname = 'professor';
    var $base_url = 'admin/professor';
    var $actions = 'CRUD';
    var $titulo = 'Professores';
    var $tabela = 'nome';
    var $campos_busca = 'nome';
    var $upload_foto = "";

  public function __construct() 
    {

        parent::__construct();
        //verify_permiss_redirect('departamentos');
        $this->data['menu_active'] = 'professor';
    }

    public function _pre_form(&$model) 
    {
      $model->fields['login']['type'] = 'text';
      $model->fields['login']['label'] = 'Login';
      $model->fields['login']['rules'] = 'required|callback_uniqlogin';
      $model->fields['login']['label_class'] = 'col-md-2';
      $model->fields['login']['prepend'] = '<div class="col-md-3">';
      $model->fields['login']['append'] = '</div>';


    }



  function upload_foto(){
    $config['upload_path'] = FCPATH.'imagens/professor/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '10000';
    $config['max_width'] = '1024';
    $config['max_height'] = '768';
    $this->load->library('upload', $config);
    if($_FILES['foto']['name']){
      if(!$this->upload->do_upload('foto')){
        $this->form_validation->set_message('upload_foto', $this->upload->display_errors());
        return false;
      }else{
        $data = $this->upload->data();
        $this->upload_foto = $data['file_name'];
        return true;
      }
    }
  }

  function _filter_pre_save(&$_data){
    if($this->upload_foto)
      $_data['foto'] = $this->upload_foto;
    else
      unset($_data['foto']);
  }



}
