<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Aluno_cursos extends BaseCrud
{
    var $modelname = 'aluno_cursos';
    var $base_url = 'admin/aluno_cursos';
    var $actions = 'CRUD';
    var $titulo = 'Associar Cursos';
    var $tabela = 'turma,historico,modulo';
    var $campos_busca = 'turma';
    var $joins = array(
         'modulos'=> 'modulos.modulos_id=aluno_cursos.modulo_id'
    );
    var $selects = 'aluno_cursos.*,modulos.titulo as modulo';
    


    public function __construct() 
    {

        parent::__construct();
        //verify_permiss_redirect('departamentos');
        $this->data['menu_active'] = 'agendamento';
    }

    

    public function _filter_pre_listar(&$where, &$where_ativo)
    {
        $where['aluno_id'] = $this->uri->segment(4);
        $this->model->fields['modulo'] = array(
          'label' => 'Módulo',
          'type' => 'text',
          'class' => '',
        );

    }
    

    public function _filter_pre_read(&$data) 
    {

    

    }

   

    



 

    public function _pre_form(&$model, &$data) 
    {
        $model->fields['aluno_id']['label'] = '';
        $model->fields['aluno_id']['value'] = $this->uri->segment(4);

        $this->load->model('cursos_model','cursos');
        $where = array('status'=>'ativo');
        $cursos = $this->cursos->get_where($where)->result();
        $model->fields['curso_id']['values'][''] = '--Selecione um Curso--';
        foreach ($cursos as $key => $value) {
            $model->fields['curso_id']['values'][$value->cursos_id] = $value->titulo;
        }

        
        for ($i=1; $i <=50; $i++) {
            $model->fields['turma']['values'][$i] = $i;
        }
       

        // $this->load->model('modulos_model','modulos');
        // $where = array('status'=>'ativo');
        // $where = array('curso_id'=>$cursos[0]->cursos_id);
        // if($cursos[0]->nivel==2){
        //     $model->fields['modulo_id']['values'][''] = '--Selecione um Encontro--';
        //      $model->fields['modulo_id']['label'] = 'Encontros';
        // }else{
        //     $model->fields['modulo_id']['values'][''] = '--Selecione um Módulo--';
        //      $model->fields['modulo_id']['label'] = 'Módulos';
        // }
        
        
      

    }

    public function _filter_pos_save($data, $id) 
    {
        
        redirect('admin/alunos');

    }

    

    
    // public function _filter_pre_delete($id) 
    // {
    //     // $where['empresa_id'] = $this->session->userdata('admin')->empresa_id;
    //     // $user = $this->model->get_where($where)->row();
    //     // if($user){
    //     //     return true;
    //     // } else {
    //     //     return false;
    //     // }
    // }
    
   


}
