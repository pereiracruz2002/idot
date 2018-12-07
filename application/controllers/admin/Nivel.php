<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Nivel extends BaseCrud
{
    var $modelname = 'nivel';
    var $base_url = 'admin/nivel';
    var $actions = 'CRUD';
    var $titulo = 'Associar Departamentos';
    var $tabela = 'descricao';
    var $campos_busca = 'descricao';
    var $acoes_extras = array(array('url'=>'admin/nivel/associar_departamento','title'=>'Associar Departamentos','class'=>'btn-xs btn-info btn btn-success'));

    public function __construct() 
    {
        parent::__construct();
        //verify_permiss_redirect('departamentos');
        $this->data['menu_active'] = 'departamentos';
    }

    public function _filter_pre_listar(&$where, &$where_ativo)
    {
        $where['id_nivel >'] = 1; 
        $where['empresa_id'] = 1;
    }

    public function _filter_pre_save(&$data)
    {
        
        $data['empresa_id'] = 1;
    }

    public function associar_departamento($id_nivel, $ok=false){
        $this->load->model('departamentos_model','departamentos');
        $this->load->model('nivel_departamento_model','nivel_departamento');

        $where['departamentos.empresa_id'] = 1;
        $where['id_nivel'] = $id_nivel;

        $this->data['permissoes'] = array();
        $this->db->join('departamentos','departamentos.departamento_id=nivel_departamento.departamento_id')
                ->join('empresas','empresas.empresa_id=departamentos.empresa_id');
        $permissoes = $this->nivel_departamento->get_where($where)->result();

        foreach ($permissoes as $item) {
            $this->data['permissoes'][] = $item->departamento_id;
        }

        $this->data['id_nivel'] = $id_nivel;
        unset($where['id_nivel']);
        $this->data['departamentos'] = $this->departamentos->get_where($where)->result();

        $this->data['nivel_permissoes'] = array();
        $nivel_permissoes = $this->db->get_where('nivel_permissoes', array('id_nivel' => $id_nivel))->row();
        if($nivel_permissoes){
            $this->data['nivel_permissoes'] = json_decode($nivel_permissoes->config);
        }
        $this->data['funcionalidades'] = array('painel' => 'Painel', 'relatorio' => 'Relatório', 'locais' => 'Locais', 'turnos' => 'Turnos', 
                                               'departamentos' => 'Departamentos', 'cargos' => 'Cargos', 
                                               'funcionarios' => 'Funcionários', 'ausencias' => 'Ausências', 'configuracoes' => 'Configurações', 
                                               'indicacoes' => 'Indicações', 'historico' => 'Histórico');

        if($ok){
            $this->data['success'] = 'Dados salvos com sucesso!';
        }
        $this->load->view('admin/associar_departamentos',$this->data);
    }

    public function add_departamentos(){
        $this->load->model('nivel_departamento_model','nivel_departamento');

        if($this->input->posts()){
            $nivel_permissoes = $save_depto = array();
            $id_nivel = $this->input->post('id_nivel');
            $this->db->delete('nivel_permissoes', array('id_nivel' => $id_nivel));
            foreach ($this->input->posts() as $key => $value) {
                if ($value == 'on') {
                    $nivel_permissoes[] = $key;
                }
            }
            if($nivel_permissoes){
                $save_nivel_permissoes = array('id_nivel' => $id_nivel, 'config' => json_encode($nivel_permissoes));
                $this->db->insert('nivel_permissoes', $save_nivel_permissoes);
            }
            
            $has_permissao = $this->nivel_departamento->get_where(array('id_nivel' => $id_nivel))->result();

            if(count($has_permissao) > 0){
                $this->db->delete('nivel_departamento', array('id_nivel' => $has_permissao[0]->id_nivel));
            }

            if($this->input->post('departamento')){
                foreach ($this->input->post('departamento') as $depto) {
                    $save_depto[] = array('departamento_id' => $depto, 'id_nivel' => $id_nivel);
                }
            }
            
            if($save_depto){
                $this->db->insert_batch('nivel_departamento', $save_depto);
            }
        }
        redirect('admin/nivel/associar_departamento/'.$id_nivel.'/ok');
    }
}
