<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Agendamento extends BaseCrud
{
    var $modelname = 'agendamento';
    var $base_url = 'admin/agendamento';
    var $actions = 'CRUD';
    var $titulo = 'Curso';
    var $tabela = 'turma,curso,modulo,data,sala,professor';
    var $campos_busca = 'curso';
    var $acoes_extras = array();
    var $joins = array(
         'cursos' => 'cursos.cursos_id=agendamento.curso_id',
         'modulos'=> 'modulos.modulos_id=agendamento.modulo_id',
         'salas' =>'salas.salas_id=agendamento.sala_id',
         'professor'=>'professor.id_professor=agendamento.professor_id'
    );
    var $selects = 'agendamento.*,cursos.titulo as curso, CONCAT(modulos.titulo," - ",modulos.descricao) as modulo, salas.titulo as sala, professor.nome as professor';


    public function __construct() 
    {

        parent::__construct();
        //verify_permiss_redirect('departamentos');
        $this->data['menu_active'] = 'agendamento';
    }

    public function _filter_pre_save(&$data)
    {
        // $days = '';
        // foreach($data['dias_semana'] as $dias){
        //     $days = $dias.",";
        // }
        // $values = trim($days,",");

        // $data['dias_semana'] = $days;

        $data['dias_semana'] = serialize($data['dias_semana']);

    
    }

     public function _filter_pre_listar(&$where, &$where_ativo)
     {


        if($this->session->userdata('admin')->tipo=="professor"){
            $where['professor_id'] = $this->session->userdata('admin')->id_professor;

            $this->actions = 'R';
            $this->acoes_extras = array(
                    array('url'=>'admin/agendamento/ver_inscritos','title'=>'Ver Alunos','class'=>'btn btn-xs btn-info btn btn-warning'),
                    array('url'=>'admin/agendamento/mudar_status','title'=>'Fechar Aula','class'=>'btn btn-xs btn-info btn btn-warning change_status'));

        }elseif($this->session->userdata('admin')->tipo=="aluno"){
            $this->actions = 'R';
            $this->joins = array('cursos' => 'cursos.cursos_id=agendamento.curso_id',
             'modulos'=> 'modulos.modulos_id=agendamento.modulo_id',
             'aluno_cursos'=>'aluno_cursos.curso_id=cursos.cursos_id',
             'alunos'=>'alunos.alunos_id=aluno_cursos.aluno_id');
               
            $where['alunos.alunos_id'] = $this->session->userdata('admin')->alunos_id;

            // $this->acoes_extras = array(
            //     array('url'=>'admin/agendamento/rever_aula','title'=>'Rever Aula','class'=>'btn btn-xs btn-info btn btn-warning rever_aula'),
            //     array('url'=>'admin/agendamento/repor_aula','title'=>'Repor Aula','class'=>'btn btn-xs btn-info btn btn-warning repor_aula'));
        }

        $this->model->fields['status'] = array(
          'label' => 'Status da Aula',
          'type' => 'text',
          'class' => '',
        );

        $this->model->fields['curso'] = array(
          'label' => 'Nível',
          'type' => 'text',
          'class' => '',
        );

        $this->model->fields['modulo'] = array(
          'label' => 'Módulo',
          'type' => 'text',
          'class' => '',
        );

        $this->model->fields['sala'] = array(
          'label' => 'Salas',
          'type' => 'text',
          'class' => '',
        );

        $this->model->fields['professor'] = array(
          'label' => 'Professor',
          'type' => 'text',
          'class' => '',
        );
    }
    

    public function _filter_pre_read(&$data) 
    {


        $i = 0;
        $data_formatada = '';
        foreach ($data as $val => $key) {

            foreach ($key as $chave => $valor) {

                if($chave == "modulo"){
                    $key->modulo = strip_tags($key->modulo);
                }

                if($chave=="data"){
                    $days_of_week = ' <b>';
                    foreach(unserialize($data[$val]->dias_semana) as $days){
                        $days_of_week.=$days.",";
                    }
                    $days_of_week = trim($days_of_week,",");
                    $days_of_week.="</b>";

                    $key->data = formata_data($key->data);

                    if($key->data_segunda !=='0000-00-00'){
                        $key->data.= ', '.formata_data($key->data_segunda);
                    }

                    if($key->data_terceira !=='0000-00-00'){
                        $key->data.= ', '.formata_data($key->data_terceira);
                    }

                    $key->data.=$days_of_week;
                    
                }
                if($this->session->userdata('admin')->tipo=="aluno"){

                }
                // if($chave=='status'){
                //     echo $key->data;
                //     echo "<br />";
                //     if($key->data=="aberto"){
                //          $this->acoes_extras = array();

                //     }else{
                //         $this->acoes_extras = array(
                //             array('url'=>'admin/agendamento/rever_aula','title'=>'Rever Aula','class'=>'btn btn-xs btn-info btn btn-warning rever_aula'),
                //             array('url'=>'admin/agendamento/repor_aula','title'=>'Repor Aula','class'=>'btn btn-xs btn-info btn btn-warning repor_aula'));
                //     }
                // }
            }
        }

    }

    public function ver_inscritos($agenda_id){
        $this->load->model('agendamento_model','agendamento');
        //$this->load->model('cursos_model','cursos');
        // $this->db->select('agendamento.agenda_id,agendamento.status as status_agendamento,agendamento.data,cursos.titulo as curso, modulos.titulo as modulo, alunos.nome,alunos.alunos_id,aluno_cursos.aluno_id')
        // ->join('aluno_cursos','aluno_cursos.curso_id = cursos.cursos_id')
        // ->join('alunos', 'alunos.alunos_id =aluno_cursos.aluno_id')
        // ->join('presenca','presenca.aluno_id=alunos.alunos_id')
        // ->join('agendamento', 'agendamento.curso_id=cursos.cursos_id')
        // ->join('modulos','modulos.curso_id=cursos.cursos_id')
        // ->join('professor','professor.id_professor=agendamento.professor_id');

        //$this->db->group_by("agendamento.agenda_id");



        $this->db->select('agendamento.agenda_id,agendamento.data,cursos.titulo as curso,modulos.titulo as modulo,alunos.nome,alunos.alunos_id as aluno_id,presenca.presente as presenca, presenca.tipo as tipo')
        ->join('presenca','presenca.agenda_id=agendamento.agenda_id')
        ->join('alunos','alunos.alunos_id=presenca.aluno_id')
        ->join('cursos','cursos.cursos_id=agendamento.curso_id')
        ->join('modulos','modulos.modulos_id=agendamento.modulo_id')
        ->join('professor','professor.id_professor=agendamento.professor_id');

        //$this->db->group_by("agendamento.agenda_id");

         $where['professor_id'] = $this->session->userdata('admin')->id_professor;
         $where['agendamento.agenda_id'] = $agenda_id;
         //$where['presenca.tipo !='] = 'confirmar';
         $this->db->where_in("presenca.tipo", array('normal','reposicao','revisao'));

        $this->data['itens'] = $this->agendamento->get_where($where)->result();




        // $this->load->model('presenca_model','presenca');
        // $array_presenca = array();
        // $this->db->select('agenda_id,presente');
        // foreach($this->data['itens'] as $itens){
        //     $where_presenca['aluno_id'] = $itens->aluno_id;
        //     $where_presenca['agenda_id'] = $itens->agenda_id;
        //     $result = $this->presenca->get_where($where_presenca)->row();
        //     if($result){
        //         $array_presenca[$result->agenda_id] = $result->presente;
        //     }

        // }
        // $this->data['presenca'] = $array_presenca;

        $this->load->view('admin/aulas_alunos_professor', $this->data);
    }

     public function ver_minha_agenda(){

        $this->load->model('agendamento_model','agendamento');
        $this->load->model('presenca_model','presenca');

        // $where_mesas = 
        // $this->data['mesas_ocupadas'] = $this->agendamento->get_where($where)->result();

        $this->db->select('agendamento.agenda_id,agendamento.turma,professor.nome as professor,agendamento.data,agendamento.data_segunda,agendamento.data_terceira,agendamento.sala_id, agendamento.dias_semana,cursos.titulo as curso,cursos.cursos_id,CONCAT(modulos.titulo," - ",modulos.descricao) as modulo,modulos.modulos_id,alunos.nome,alunos.alunos_id as aluno_id,alunos.status,presenca.presente as presenca, presenca.presenca_id,presenca.tipo')
        ->join('presenca','presenca.agenda_id=agendamento.agenda_id')
        ->join('alunos','alunos.alunos_id=presenca.aluno_id')
        ->join('cursos','cursos.cursos_id=agendamento.curso_id')
        ->join('modulos','modulos.modulos_id=agendamento.modulo_id')
        ->join('professor','professor.id_professor=agendamento.professor_id');

        //$this->db->group_by('cursos.cursos_id');

         $where['alunos.alunos_id'] = $this->session->userdata('admin')->alunos_id;


        $this->data['itens'] = $this->agendamento->get_where($where)->result();
        if(count($this->data['itens']) > 0){
            $consulta = unserialize($this->data['itens'][0]->dias_semana);
        }
       


        $aulas = array();
        $mesas_ocupadas = array();
        foreach($this->data['itens'] as $itens){

            $this->db->select('presenca.presente as presente, presenca.presenca_id,presenca.agenda_id, modulos.modulos_id')
            ->join('presenca','presenca.agenda_id=agendamento.agenda_id')
            ->join('alunos','alunos.alunos_id=presenca.aluno_id')
            ->join('modulos','modulos.modulos_id=agendamento.modulo_id');
            $where_alunos['agendamento.agenda_id'] = $itens->agenda_id;
            $where_alunos['agendamento.modulo_id'] = $itens->modulos_id;
            
            $where_alunos['alunos.alunos_id'] = $this->session->userdata('admin')->alunos_id;

            $this->db->where_in('presenca.tipo', array('normal','confirmar'));
            $resultados = $this->agendamento->get_where($where_alunos)->result(); 


            

            foreach($resultados as $resultado){
                $aulas[$resultado->modulos_id] = $resultado->presente;
                $this->db->select('presenca.*');
                

                $meu_agendamento = $this->presenca->get_where(array('agenda_id'=>$resultado->agenda_id))->row();
                $this->db->select('agendamento.*,presenca.*')
                ->join('agendamento','agendamento.agenda_id =presenca.agenda_id');
                $my_agendamento = $this->presenca->get_where(array('presenca.agenda_id'=>$resultado->agenda_id,'aluno_id'=>$this->session->userdata('admin')->alunos_id))->row();
                $this->db->select('presenca.mesa');
                $mesas_ocupadas[$resultado->agenda_id] = $this->presenca->get_where(array('agenda_id'=>$resultado->agenda_id,'data_dia'=>$my_agendamento->data_dia,'dia_semana'=>$my_agendamento->dia_semana))->result();

            } 
            if(count($my_agendamento > 0)){
                $this->data['meu_agendamento'] = $my_agendamento;
            }
            

           
            $this->data['mesas_ocupadas'] = $mesas_ocupadas;
           
            
        }

 
        $this->data['aulas'] = $aulas;
      

    
        

        $this->load->view('admin/aulas_alunos', $this->data);
    }


    public function trocarData(){
        $this->load->model('presenca_model','presenca');
        $post = $this->input->posts();
        $where['data_dia'] = $post['data_dia'];
        $where['dia_semana'] = $post['dias_semana'];
        $where['agenda_id'] = $post['agenda_id'];
        $where['aluno_id'] = $post['aluno_id'];
        $result = $this->presenca->get_where($where)->row();
        $msg['status'] = 0;
        if(count($result)>0){
           $msg['status'] = 1;
        }

        $json = json_encode($msg);
        $this->output->set_header('content-type: application/json');
        $this->output->set_output($json);
    }


    public function returnVagas(){
        $this->load->model('presenca_model','presenca');
        $post = $this->input->posts();
        $where['data_dia'] = $post['data_dia'];
        $where['dia_semana'] = $post['dias_semana'];
        $where['agenda_id'] = $post['agenda_id'];


        $this->db->select('presenca.mesa');
        $result =$mesas_ocupadas[] = $this->presenca->get_where($where)->result();
        $json = json_encode($result);
        $this->output->set_header('content-type: application/json');
        $this->output->set_output($json);

    }



    public function checar_presenca(){

        $post = $this->input->posts();

        $data['aluno_id'] = $post['aluno_id'];
        $data['agenda_id'] = $post['agenda_id'];
        $data_dia = $post['data_dia'];
        $dia_semana = $post['dias_semana'];
        $mesa = $post['mesa'];
        $presente = $post['presente'];

        if($presente == 1){
             $this->db->set('presente', 'sim');
             $this->db->set('mesa',$mesa);
             $this->db->set('data_dia',$data_dia);
             $this->db->set('dia_semana',$dia_semana);
        }else{
             $this->db->set('presente', 'nao');
             $this->db->set('mesa',$mesa);
             $this->db->set('data_dia',$data_dia);
             $this->db->set('dia_semana',$dia_semana);
        }

        $this->db->where($data);
        if($this->db->update('presenca')){

            $this->output->set_output("ok");
        }else{
           $this->output->set_output("erro ao inserir uma presença"); 
        }

    }

    public function mudar_status($agenda_id){
        $this->db->set('status', 'fechado');
        $this->db->where('agenda_id', $agenda_id);
        if($this->db->update('agendamento')){
            $this->output->set_output("ok");
        }else{
            echo $this->db->last_query();
            $this->output->set_output("erro ao atualizar o agendamento");  
        }
    }

    public function reagendamento($presenca_id, $tipo){

        $this->load->model('presenca_model','presenca');
        $this->load->model('avisos_model','avisos');
        $this->load->model('agendamento_model','agendamento');

        $this->db->select('alunos.nome,alunos.email,alunos.matricula, cursos.titulo as curso, agendamento.data as data_agenda,presenca.agenda_id')
                 ->join('alunos','alunos.alunos_id=presenca.aluno_id')
                 ->join('agendamento','agendamento.agenda_id=presenca.agenda_id')
                 ->join('cursos','cursos.cursos_id=agendamento.curso_id');

        $where['presenca.presenca_id'] = $presenca_id;

        $resultado = $this->presenca->get_where($where)->row(); 

        

        if($tipo=="reposicao"){
            $txt_tipo = "Reposição";
        }else{
           $txt_tipo = "Revisão"; 
        }        

        $msg = "Aluno:".$resultado->nome." email:".$resultado->email." (matrícula:". $resultado->matricula."), confirmou a ".$txt_tipo." para o dia ". formata_data($resultado->data_agenda) ." do curso ". $resultado->curso ;


        $this->db->select('count(*) as vagas');
        $this->db->where_in("presenca.tipo", array('reposicao','revisao'));

        $where_vagas['agenda_id'] = $resultado->agenda_id;
        $qtd_reposicao = $this->presenca->get_where($where_vagas)->row();
        
        $vagas_prenchidas = $qtd_reposicao->vagas;

        $this->db->select('agendamento.vagas');
        $vagas_agenda = $this->agendamento->get_where(array('agenda_id'=>$resultado->agenda_id))->row();
        echo $this->db->last_query();
        $vagas_disponivel = $vagas_agenda->vagas;

        echo "VAgas".$vagas;
        echo "<br />";
        echo "Vagas disponíveis";
        echo $vagas_disponivel;

        if($vagas_prenchidas == $vagas_disponivel){
            $this->output->set_output("O número de vagas disponível já encerrou");
        }else{
            $this->db->set('tipo', $tipo);
            $this->db->where('presenca_id', $presenca_id);
            if($this->db->update('presenca')){

                $this->avisos->save_aviso(FALSE,'admin',$msg,"Confirmação  de {$txt_tipo}");

                $this->output->set_output("ok");
            }else{
                echo $this->db->last_query();
                $this->output->set_output("erro ao atualizar a presenca");  
            }
        }
    }

 

    public function _pre_form(&$model, &$data) 
    {


        $this->load->model('cursos_model','cursos');
        $where = array('status'=>'ativo');
        $cursos = $this->cursos->get_where($where)->result();
        $model->fields['curso_id']['values'][''] = '--Selecione um Curso--';

        for ($i=1; $i <=50; $i++) {
            $model->fields['turma']['values'][$i] = $i;
        }


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
        if($cursos[0]->nivel==2){
            $model->fields['modulo_id']['values'][''] = '--Selecione um Encontro--';
             $model->fields['modulo_id']['label'] = 'Encontros';
        }else{
            $model->fields['modulo_id']['values'][''] = '--Selecione um Módulo--';
             $model->fields['modulo_id']['label'] = 'Módulos';
        }
        
        
        // $modulos = $this->modulos->get_where($where)->result();
        // foreach ($modulos as $key => $value) {
        //     $model->fields['modulo_id']['values'][$value->modulos_id] = $value->titulo;
        // }

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
        
        $this->load->model('aluno_cursos_model','aluno_cursos');
        $this->load->model('presenca_model','presenca');
        $this->load->model('avisos_model','avisos');


        if($this->uri->segment(3) != 'editar'){

            $this->db->select('aluno_cursos.aluno_id, alunos.nome')
            ->join('alunos','alunos.alunos_id =aluno_cursos.aluno_id');

            $where['aluno_cursos.curso_id'] = $data['curso_id'];



            $msg = "Há uma nova aula agendada para você no dia ".formata_data($data['data']);

            

            $alunos = $this->aluno_cursos->get_where($where)->result();





             if($alunos){
                foreach($alunos as $aluno){
                    $this->db->select('presenca.aluno_id')
                     ->join('agendamento','agendamento.agenda_id =presenca.agenda_id')
                     ->join('modulos','modulos.modulos_id=agendamento.modulo_id');

                     $where_presenca['presenca.aluno_id'] = $aluno->aluno_id;
                     $where_presenca['agendamento.modulo_id'] = $data['modulo_id'];

                     $presenca = $this->presenca->get_where($where_presenca)->result();
                     if(count($presenca) == 0){
                        $dados['aluno_id'] = $aluno->aluno_id;
                        $dados['agenda_id'] = $id;
                        $this->db->insert('presenca',$dados);

                        $this->avisos->save_aviso($aluno->aluno_id,'aluno',$msg,'Novo aviso de aula');



                     }elseif(count($presenca ==1)){
                        $dados['aluno_id'] = $aluno->aluno_id;
                        $dados['agenda_id'] = $id;
                        $dados['tipo'] ='confirmar';
                        $this->db->insert('presenca',$dados);

                        // $msg = "Há uma aula agendada para o dia ".formata_data($data->$data) ." caso queira assistir, por favor confirme sua presença";

                        // $this->avisos->save_aviso($aluno->aluno_id,'aluno',$msg,'Novo aviso de aula');
                     }
                }
             }

             $this->avisos->save_aviso($data['professor_id'],'professor',$msg,'Novo aviso de aula');
        }

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


    public function returnDadosDia(){
        $days_of_week[0] = 'domingo';
        $days_of_week[1] = 'segunda';
        $days_of_week[2] = 'terca';
        $days_of_week[3] = 'quarta';
        $days_of_week[4] = 'quinta';
        $days_of_week[5] = 'sexta';
        $days_of_week[6] = 'sábado';

        $posts = $this->input->posts();
        $data_dia = $posts['data_dia'];
        $data_semana = date('w', strtotime($data_dia));
        echo $days_of_week[$data_semana];
    }

}
