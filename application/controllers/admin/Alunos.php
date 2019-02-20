<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Alunos extends BaseCrud {


    var $modelname = 'alunos';
    var $base_url = 'admin/alunos';
    var $actions = 'CRUD';
    var $titulo = 'Alunos';
    var $tabela = 'nome,curso';
    var $campos_busca = 'nome';
    var $upload_foto = "";
    //var $group = array('aluno_id'=>'aluno_id');
    var $joins = array('aluno_cursos' => array('aluno_cursos.aluno_id=alunos.alunos_id','left'),
         'cursos'=> array('cursos.cursos_id=aluno_cursos.curso_id','left')
    );
    var $selects = 'alunos.*,cursos.titulo as curso';
    var $acoes_extras = array(
        array("url" => "admin/aluno_cursos/novo", "title" => "Relacionar com Cursos", "class" => "btn-info"),
        //array("url" => "admin/aluno_cursos/index", "title" => "Ver Cursos Relacionados", "class" => "btn-info"),
    );

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

    public function _filter_pre_listar(&$where, &$where_ativo)
    {
      $this->model->fields['curso'] = array(
          'label' => 'Curso',
          'type' => 'text',
          'class' => '',
        );
    }

    public function _pre_form(&$model, &$data) 
    {
      
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
            $where['alunos_id !='] = $this->uri->segment(4);
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
      
        // $save_cursos[]= array('curso_id' => 0, 'aluno_id' => $id);
        // $this->db->insert_batch('aluno_cursos', $save_cursos);

        redirect('admin/alunos');

  }


  public function associar_cursos($aluno_id, $ok=false){
        $this->load->model('cursos_model','cursos');
        $this->load->model('aluno_cursos_model','aluno_cursos');

        $where['aluno_id'] = $aluno_id;

        $this->data['permissoes'] = array();
        $this->db->select('cursos.*');
        $this->db->join('cursos','cursos.cursos_id=aluno_cursos.curso_id');
        $permissoes = $this->aluno_cursos->get_where($where)->result();
        foreach ($permissoes as $item) {
            $this->data['permissoes'][] = $item->cursos_id;
        }
   
        $this->data['aluno_id'] = $aluno_id;
        unset($where['aluno_id']);
        $this->data['cursos'] = $this->cursos->get_where($where)->result();

        $this->load->view('admin/associar_alunos_cursos',$this->data);
    }



    public function add_cursos(){
        $this->load->model('aluno_cursos_model','aluno_cursos');

        if($this->input->posts()){
            $nivel_permissoes = $save_depto = array();
            $aluno_id = $this->input->post('aluno_id');
            $this->db->delete('aluno_cursos', array('aluno_id' => $aluno_id));
           
            if($this->input->post('cursos') and !empty($this->input->post('cursos'))){
                foreach ($this->input->post('cursos') as $curso) {
                    $save_cursos[] = array('curso_id' => $curso, 'aluno_id' => $aluno_id);
                }
            }
            
            if($save_cursos){
                $this->db->insert_batch('aluno_cursos', $save_cursos);
            }
        }
        redirect('admin/alunos');
    }

}
