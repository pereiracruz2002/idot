<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Agendamento extends BaseCrud
{
    var $modelname = 'agendamento';
    var $base_url = 'admin/agendamento';
    var $actions = 'CRUD';
    var $titulo = 'Agendamento';
    var $tabela = 'data,vagas,curso';
    var $campos_busca = 'data';
    var $acoes_extras = array();
    var $joins = array(
         'cursos' => 'cursos.cursos_id=agendamento.curso_id',
    );
    var $selects = 'agendamento.*,cursos.titulo as curso';


    public function __construct() 
    {

        parent::__construct();
        //verify_permiss_redirect('departamentos');
        $this->data['menu_active'] = 'agendamento';
    }

     public function _filter_pre_listar(&$where, &$where_ativo)
     {

        $this->model->fields['curso'] = array(
          'label' => 'Curso',
          'type' => 'text',
          'class' => '',
        );
    }
    

    public function _filter_pre_read(&$data) 
    {

       

    }

    public function _pre_form(&$model, &$data) 
    {
        $this->load->model('cursos_model','cursos');
        $where = array('status'=>'ativo');
        $cursos = $this->cursos->get_where($where)->result();
        foreach ($cursos as $key => $value) {
            $model->fields['curso_id']['values'][$value->cursos_id] = $value->titulo;
        }

        $this->load->model('professor_model','professores');
        $where = array('status'=>'ativo');
        $professores = $this->professores->get_where($where)->result();
        foreach ($professores as $key => $value) {
            $model->fields['professor_id']['values'][$value->id_professor] = $value->nome;
        }

        $this->load->model('salas_model','salas');
        $where = array('status'=>'ativo');
        $salas = $this->salas->get_where($where)->result();
        foreach ($salas as $key => $value) {
            $model->fields['sala_id']['values'][$value->salas_id] = $value->titulo;
        }

        $this->load->model('modulos_model','modulos');
        $where = array('status'=>'ativo');
        $modulos = $this->modulos->get_where($where)->result();
        foreach ($modulos as $key => $value) {
            $model->fields['modulo_id']['values'][$value->modulos_id] = $value->titulo;
        }

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

    public function _filter_pos_save($data, $id) 
    {
        redirect('admin/agendamento');

    }

    

	public function notificacoes($departamento_id) 
	{
        $this->load->model('departamentos_model','departamentos');
		$this->load->model('departamentos_notificacoes_model','departamentos_notificacoes');
        $this->load->model('funcionarios_model', 'funcionarios');
        $posts = $this->input->posts();
        if($posts){
            if(isset($posts['email_responsavel'])){
                $this->departamentos->update(array('email_responsavel' => $posts['email_responsavel']), $departamento_id);
                $this->departamentos_notificacoes->delete(array('departamento_id' => $departamento_id));
                $save = array();
                foreach ($posts['frequencia'] as $key => $value) {
                    if($value){
                        $save[] = array(
                            'departamento_id' => $departamento_id,
                            'tipo' => $key,
                            'frequencia' => $value,
                            'dia_notificacao' => $posts['dia_notificacao'][$key]
                            );    
                    }
                }
                if($save){
                    $this->db->insert_batch('departamentos_notificacoes', $save);
                }
                $this->data['success'] = 'Dados salvos com sucesso!';
            }else{
                $this->data['error'] = 'Insira o e-mail do responsável do departamento.';
            }
        }
        $this->data['email_responsavel'] = $this->departamentos->get_where($departamento_id)->row()->email_responsavel;
        $notificacoes = $this->departamentos_notificacoes->get_where(array('departamentos_notificacoes.departamento_id' => $departamento_id))->result();
        if($notificacoes){
            foreach ($notificacoes as $key => $notificacao) {
                $this->data['notificacoes'][$notificacao->tipo] = (array) $notificacao;
            }
        }       
        $this->data['titulo'] = 'Editar Notificações';
        $this->data['jsFiles'] = array('notificacoes.js');
        $this->load->view('admin/notificacoes', $this->data);
	}

}
