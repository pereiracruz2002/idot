<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Departamentos extends BaseCrud
{
    var $modelname = 'departamentos';
    var $base_url = 'admin/departamentos';
    var $actions = 'CRUD';
    var $titulo = 'Departamentos';
    var $tabela = 'titulo,tipo_trabalho';
    var $campos_busca = 'titulo';
    var $acoes_extras = array(
        array("url" => "admin/departamentos/notificacoes", "title" => "Notificações", "class" => "btn-info"),
    );


    public function __construct() 
    {

        parent::__construct();
        //verify_permiss_redirect('departamentos');
        $this->data['menu_active'] = 'departamentos';
    }

    public function _filter_pre_listar(&$where, $like) 
    {
        $where['empresa_id'] = 1;
    }

    public function _filter_pre_read(&$data) 
    {

        $tipo_trabalho = array(
                'banco_horas' => 'Banco de Horas', 
                'horas_extras' => 'Horas Extras',
                'ambas' => 'Banco de Horas e Horas Extras',
                '' => 'Sem cálculo de Horas'
        );


        foreach ($data as $item) {
            $item->tipo_trabalho= $tipo_trabalho[$item->tipo_trabalho];

        }

    }

    public function _filter_pre_form(&$data) 
    {
        $this->model->fields['inicio_fechamento']['values'][] = "--Selecione--";
        for($i = 1; $i <= 28; $i++) {
            $this->model->fields['inicio_fechamento']['values'][$i] =  "Dia " .str_pad($i,2, '0',STR_PAD_LEFT);
        }
    }

    
    public function _filter_pre_delete($id) 
    {
        $where['empresa_id'] = $this->session->userdata('admin')->empresa_id;
        $user = $this->model->get_where($where)->row();
        if($user){
            return true;
        } else {
            return false;
        }
    }

    public function _filter_pos_save($data, $id) 
    {
        if($this->uri->segment(3) == 'novo'){
            $this->load->model('nivel_model', 'nivel');
            $this->load->model('nivel_departamento_model', 'nivel_departamento');
            $dados['empresa_id'] = $this->session->userdata('admin')->empresa_id;
            $dados['descricao']  = $data['titulo'];

            $dados_nivel['id_nivel'] = $this->nivel->save($dados);
            $dados_nivel['departamento_id'] = $id;

            $this->nivel_departamento->save($dados_nivel);
        } else {
            $funcionarios = $this->db->select('funcionario_id')->get_where('funcionarios', array('departamento_id' => $id, 'status' => 'ativo'))->result_array();
            if($funcionarios){
                $where_in = array();
                foreach ($funcionarios as $item) {
                    $where_in[] = $item['funcionario_id'];
                }
                $this->db->where_in('funcionario_id', $where_in)->delete('fix_jornadas');

                $this->db->insert_batch('fix_jornadas', $funcionarios);
            }
        }

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
