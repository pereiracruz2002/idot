<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Cursos extends BaseCrud
{
    var $modelname = 'cursos';
    var $base_url = 'admin/cursos';
    var $actions = 'CRUD';
    var $titulo = 'Cursos';
    var $tabela = 'titulo,status';
    var $campos_busca = 'titulo';
    //var $acoes_extras = array(array('url'=>'admin/modulos/listar','title'=>'Adicionar Módulos','class'=>'btn btn-xs btn-info btn btn-warning'));


    public function __construct() 
    {

        parent::__construct();
        //verify_permiss_redirect('departamentos');
        $this->data['menu_active'] = 'cursos';
    }


    public function listar(){
        $this->load->model('cursos_model','cursos');
        $where = array('cursos.status'=>'ativo');
        $this->data['itens'] = $this->cursos->get_where($where)->result();
       $this->load->view('admin/listar_cursos',$this->data);
    }

    public function _filter_pre_listar(&$where, &$like) 
    {

        // $this->db->select('cursos.nivel');
        // $this->load->model('cursos_model','cursos');
        // $where = array('cursos_id >'=>10);
        // $result = $this->cursos->get_where($where)->row(); 
        // var_dump($result->nivel);
        //  if($result->nivel==2){

        //     $url = "admin/encontros/listar";
        //     $this->acoes_extras = array(array('url'=>$url,'title'=>'Adicionar Encontros','class'=>'btn btn-xs btn-info btn btn-warning'));
            
        // }else{
        //     $this->acoes_extras = array(array('url'=>'admin/modulos/listar','title'=>'Adicionar Módulos','class'=>'btn btn-xs btn-info btn btn-warning'));
        // }
    
        // var_dump($this->acoes_extras);
        

    
    }

    public function _filter_pre_read(&$data) 
    {
        // foreach ($data as $key) {

            
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
        
        redirect('admin/cursos');

    }

    public function return_cursos($nivel){
        $this->load->model('cursos_model','cursos');
        $where = array('nivel'=>$nivel);
        $this->db->select('cursos.*');
        $this->db->order_by("titulo", 'ASC');
        $result = $this->cursos->get_where($where)->result();
;
        $json = json_encode($result);
        $this->output->set_header('content-type: application/json');
        $this->output->set_output($json);
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
