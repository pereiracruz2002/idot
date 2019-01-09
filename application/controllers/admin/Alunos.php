<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Alunos extends BaseCrud {


    var $modelname = 'alunos';
    var $base_url = 'admin/alunos';
    var $actions = 'CRUD';
    var $titulo = 'Alunos';
    var $tabela = 'nome';
    var $campos_busca = 'nome';
    var $upload_foto = "";

  public function __construct() 
    {

        parent::__construct();
        //verify_permiss_redirect('departamentos');
        $this->data['menu_active'] = 'alunos';
    }

     public function _filter_pre_save(&$data) 
    {
        if($data['senha']){
             $data['senha'] = md5($data['senha']);
            //$data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
        } else {
            unset($data['senha']);
        }
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

  // function _filter_pre_save(&$_data){
  //   if($this->upload_foto)
  //     $_data['foto'] = $this->upload_foto;
  //   else
  //     unset($_data['foto']);
  // }

  public function uniqlogin($login) 
  {
        $where['login'] = $login;
        if($this->uri->segment(3) == 'editar'){
            $where['admin_id !='] = $this->uri->segment(4);
        }
        $cadastro = $this->model->get_where($where)->row();
        if($cadastro){
            $this->form_validation->set_message('uniqlogin', 'Esse login já está em uso');
            return false;
        } else {
            return true;
        }
  }

  public function _filter_pos_save($data, $id) 
  {
        redirect('admin/alunos');

  }

}
