<?php
include("BaseCrud.php");
class Professor extends BaseCrud {

  var $modelname = 'professor'; //Nome da model sem o "_model"
  var $titulo = 'Professor';
  var $campos_busca = 'nome'; //Campos para filtragem
  var $base_url = 'admin/professor';
  var $actions = 'CRUD';// C: CREATE; R:READ; U:UPDATE; D:DELETE
  var $delete_fields = '';
  var $tabela = 'nome'; //Campos que aparecerão na tabela de listagem

  var $upload_foto = "";

  function __construct(){
    
    parent::__construct();
    if(!$this->session->userdata('operador')){
        redirect('meu-painel-wvtodoz');
    }
  }

  public function _pos_form()
  {
    $this->load->model('curso_model','cursos');
    $in_cursos = array();
    if($this->uri->segment(3)){
      $this->load->model('curso_professor_model','curso_professor');
      $meus_cursos = $this->curso_professor->get_where(array('id_professor' => $this->uri->segment(3)))->result();
      foreach ($meus_cursos as $item)
        $in_cursos[] = $item->id_curso;
    }
    
    $this->db->select('curso.id_curso, 
                       curso.nome')
            ->order_by('nome', 'asc');
    $cursos = $this->cursos->get_where(array('curso.ativo' => 1))->result();
    $select = '<label for="cursos" class="Textarea"><span>Cursos</span><select name="id_curso[]" size="30" style="font-size:11px;" multiple>';
    foreach ($cursos as $item)
      $select .= '<option value="'.$item->id_curso.'" '.(in_array($item->id_curso, $in_cursos) ? 'selected' : '').'>'.$item->nome.'</option>';
    
    $select .= '</select></label>';

    print $select;
  }

  public function _filter_pos_save(&$data) 
  {
    $this->load->model('curso_professor_model','curso_professor');
    $this->curso_professor->delete(array('id_professor' => $data['id_professor']));
    $save = array();
    foreach ($this->input->post('id_curso') as $item) {
      $save[] = array('id_professor' => $data['id_professor'],
                      'id_curso' => $item 
                     );
    }
    $this->db->insert_batch('curso_professor', $save);
  }

 

  public function login_unico($login) 
  {
    if($login){
      $where['login'] = $login;
      if($this->uri->segment(2) == 'editar')
        $where['id_professor != '] = $this->uri->segment(3);
      $this->load->model('professor_model','professor');
      $existe = $this->professor->get_where($where)->num_rows();
      if($existe){
        $this->form_validation->set_message('login_unico', 'Esse Login já está sendo usado');
        return false;
      }else{
        if(!$this->input->post('senha')){
        $this->form_validation->set_message('login_unico', 'Por favor, digite uma senha para o professor');
          return false;
        }
        return true;
      }
    }else{
      return true;
    }
  }

  function _cursos($id_professor){
    $this->load->model("curso_professor_model", "curso_professor");
    $this->db->select("curso.id_curso, curso.nome as curso");
    $this->db->join("curso", "curso.id_curso=curso_professor.id_curso");
    $aulas = $this->curso_professor->get_where(array("curso_professor.id_professor" => $id_professor))->result();
    $this->load->library('table', false, 'tabelas');
    $this->tabelas->set_heading(array('Cursos Presentes','Remover'));

    foreach($aulas as $aula)
      $this->tabelas->add_row(array($aula->curso, '<a href="'.site_url("professor/remover_curso/{$id_professor}/{$aula->id_curso}").'" class="excluir cell_remove">Remover</a>'));

    print $this->tabelas->generate();
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

  public function relacionar($id_aula){
    $this->load->model('aula_professor_model', 'aula_professor');
    $this->load->model('professor_model', 'professor');

    if($this->input->posts()){
      $save['id_aula'] = $id_aula;
      switch($this->input->post('acao')){
        case "add":
          foreach ($this->input->post('id_professor') as $item){
            $save['id_professor'] = $item;
            if($this->aula_professor->get_where($save)->num_rows() == 0)
              $this->aula_professor->save($save);
          }
          break;
        case "remove":
          foreach ($this->input->post('id_professor') as $item){
            $save['id_professor'] = $item;
            $this->aula_professor->delete($save);
          }
          break;
      }
    }

    $this->db->select("professor.nome, professor.id_professor")
      ->order_by("nome")
      ->join("professor", "aula_professor.id_professor=professor.id_professor");
    $data['professores'] = $this->aula_professor->get_where(array("id_aula" => $id_aula))->result();
    $this->db->order_by("nome");
    $data['todos_professores'] = $this->professor->get_where(array("ativo" => 1))->result();
    $data['modal'] = true;
    $this->load->view('admin/aula_professor', $data);
  }

}
