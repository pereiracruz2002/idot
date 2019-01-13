<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Agendamento extends BaseCrud
{
    var $modelname = 'agendamento';
    var $base_url = 'admin/agendamento';
    var $actions = 'CRUD';
    var $titulo = 'Agendamento';
    var $tabela = 'data,vagas,curso,modulo';
    var $campos_busca = 'data';
    var $acoes_extras = array();
    var $joins = array(
         'cursos' => 'cursos.cursos_id=agendamento.curso_id',
         'modulos'=> 'modulos.modulos_id=agendamento.modulo_id'
    );
    var $selects = 'agendamento.*,cursos.titulo as curso, modulos.titulo as modulo';


    public function __construct() 
    {

        parent::__construct();
        //verify_permiss_redirect('departamentos');
        $this->data['menu_active'] = 'agendamento';
    }

     public function _filter_pre_listar(&$where, &$where_ativo)
     {


        if($this->session->userdata('admin')->tipo=="professor"){
            $where['professor_id'] = $this->session->userdata('admin')->id_professor;

            $this->actions = 'R';
            $this->acoes_extras = array(array('url'=>'admin/agendamento/ver_inscritos','title'=>'Ver Alunos','class'=>'btn btn-xs btn-info btn btn-warning'),array('url'=>'admin/agendamento/mudar_status','title'=>'Fechar Aula','class'=>'btn btn-xs btn-info btn btn-warning'));

        }

        $this->model->fields['curso'] = array(
          'label' => 'Curso',
          'type' => 'text',
          'class' => '',
        );

        $this->model->fields['modulo'] = array(
          'label' => 'Módulo',
          'type' => 'text',
          'class' => '',
        );
    }
    

    public function _filter_pre_read(&$data) 
    {
        $i = 0;
        foreach ($data as $key) {
            foreach ($key as $chave => $valor) {
                if($chave=="data"){
                    $key->data = formata_data($key->data);
                }
            }
        }

    }

    public function ver_inscritos($agenda_id){
        $this->load->model('cursos_model','cursos');
        $this->db->select('agendamento.agenda_id,agendamento.data,cursos.titulo as curso, modulos.titulo as modulo, alunos.nome,alunos.alunos_id,aluno_cursos.aluno_id,presenca.presenca_id')
        ->join('aluno_cursos','aluno_cursos.curso_id = cursos.cursos_id')
        ->join('alunos', 'alunos.alunos_id =aluno_cursos.aluno_id')
        ->join('presenca','presenca.aluno_id=alunos.alunos_id','left')
        ->join('agendamento', 'agendamento.curso_id=cursos.cursos_id')
        ->join('modulos','modulos.curso_id=cursos.cursos_id')
        ->join('professor','professor.id_professor=agendamento.professor_id');

        $this->db->group_by("agendamento.agenda_id");

         $where['professor_id'] = $this->session->userdata('admin')->id_professor;
         $where['agendamento.agenda_id'] = $agenda_id;

        $this->data['itens'] = $this->cursos->get_where($where)->result();
        $this->load->view('admin/aulas_alunos', $this->data);
    }

    public function checar_presenca($aluno_id, $agenda_id){
        $data['aluno_id'] = $aluno_id;
        $data['agenda_id'] = $agenda_id;
        if($this->db->insert('presenca',$data)){
            $this->output->set_output("ok");
        }else{
            echo $this->db->last_query();
            $this->output->set_output("erro ao inserir uma presença");
        }
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
        $where = array('curso_id'=>$cursos[0]->cursos_id);
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
